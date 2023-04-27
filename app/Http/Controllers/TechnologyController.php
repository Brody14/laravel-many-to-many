<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trashed = $request->input('trashed');

        if ($trashed) {
            $technologies = Technology::onlyTrashed()->get();
        } else {
            $technologies = Technology::all();
        }

        $in_trash = Technology::onlyTrashed()->count();

        return view('technologies.index', compact('technologies', 'in_trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('technologies.create')->with('success', 'Technology created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTechnologyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] =  Str::slug($validated['name']);

        $new_tec = Technology::create($validated);
        return to_route('technologies.show', $new_tec);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $tecnology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTechnologyRequest  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $validated = $request->validated();
        if ($validated['name'] !== $technology->name) {
            $validated['slug'] =  Str::slug($validated['name']);
        }

        $technology->update($validated);
        return to_route('technologies.show', $technology)->with('update', 'Technology updated');
    }

    public function restore(Technology $technology)
    {
        if ($technology->trashed()) {
            $technology->restore();
        }

        return back()->with('success', 'Technology restored successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        if ($technology->trashed()) {
            $technology->forceDelete();
            return to_route('technologies.index')->with('message', 'Technology deleted');
        }

        $technology->delete();
        return back()->with('moved', 'Technology moved to trash');
    }
}
