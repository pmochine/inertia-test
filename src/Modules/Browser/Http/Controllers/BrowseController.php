<?php

namespace Inertiatest\Browser\Http\Controllers;

use Inertiatest\Browser\Http\Requests\BrowseRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

class BrowseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return redirect()->route('browse.show', ['category' => 'all']);
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(string $category)
    {
        return Inertia::render('Browse/Show', [
            'category' => $category,
        ]);
    }
}
