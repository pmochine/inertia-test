<?php

namespace Inertiatest\Browser\Tests\Unit;

use Inertiatest\Browser\Database\Seeders\BrowserDatabaseSeeder;
use Inertiatest\Browser\Models\Topic;
use Inertiatest\Course\Models\Lesson;
use Inertiatest\Tests\TestCase;


class BrowseTest extends TestCase
{

    /** @test */
    public function user_is_redirected_when_url_is_just_browse()
    {
        $this->get(route('browse.index'))
            ->assertRedirect(route('browse.show', ['category' => 'all']));
    }

    /** @test */
    public function browse_shows_all_topics()
    {
        $this->withoutExceptionHandling();
        $this->get(route('browse.show', ['category' => 'all']));
    }
}
