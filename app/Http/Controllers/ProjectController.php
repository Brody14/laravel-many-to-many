<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //creazione vista cestino
        $trashed = $request->input('trashed');

        if ($trashed) {
            $projects = Project::onlyTrashed()->get();
        } else {
            $projects = Project::all();
        }

        //numero elementi nel cestino
        $in_trash = Project::onlyTrashed()->count();

        return view('projects.index', compact('projects', 'in_trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::orderBy('name')->get();

        return view('projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']);

        $new_project = Project::create($validated);
        return to_route('projects.show', $new_project)->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('name')->get();

        return view('projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        if ($validated['title'] !== $project->title) {
            $validated['slug'] =  Str::slug($validated['title']);
        }

        $project->update($validated);

        return to_route('projects.show', $project)->with('update', 'Project updated');
    }

    public function restore(Project $project)
    {
        if ($project->trashed()) {
            $project->restore();
        }

        return back()->with('success', 'Project restored successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->trashed()) {
            $project->forceDelete();
            return to_route('projects.index')->with('message', 'Project deleted');
        }

        $project->delete();
        return back()->with('moved', 'Project moved to trash');
    }
}
