<?php

namespace Inertiatest\Browser\Http\Requests;

use Inertiatest\Browser\Models\Category;
use Inertiatest\Browser\Models\Topic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BrowseRequest extends FormRequest
{
    /**
     * Cached categories
     *
     * @var Collection
     */
    protected $categories;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'required|string',
        ];
    }

    /**
     * Add route parameter for validation
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'category' => $this->route('category'),
        ]);
    }

    /**
     * Validate route parameter via the category model.
     * Returns 404 if not found.
     *
     * @return  void
     */
    public function validateCategory(): void
    {
        $this->categories = Cache::rememberForever('categories', fn () => Category::all());

        if ($this->categoryIsSetToAll() || $this->containsCategory($this->category)) {
            return;
        }

        abort(404);
    }

    /**
     * Returns all categories names
     *
     * @return  Collection
     */
    public function categories(): Collection
    {
        return $this->categories->pluck('name');
    }

    public function topics()
    {
        if ($this->categoryIsSetToAll()) {
            return Cache::remember('topics_all', now()->addDay(), function () {
                return Topic::withCount('lessons')->get()->map->only(['name', 'lessons_count']);
            });
        }

        return Cache::remember('topic_' . $this->category, now()->addDay(), function () {
            return Category::where('name', $this->category)->first()->topics()->withCount('lessons')->get();
        });
    }

    protected function categoryIsSetToAll(): bool
    {
        return $this->category === 'all';
    }

    protected function containsCategory(string $category): bool
    {
        return $this->categories->contains(function ($value) use ($category) {
            return $value->name === $category;
        });
    }
}
