<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TypeController extends Controller
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
            $types = Type::onlyTrashed()->get();
        } else {
            $types = Type::all();
        }

        $in_trash = Type::onlyTrashed()->count();

        return view('types.index', compact('types', 'in_trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create')->with('success', 'Type created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] =  Str::slug($validated['name']);

        $new_type = Type::create($validated);
        return to_route('types.show', $new_type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $projects = Project::where('type_id', $type->id)->get();
        return view('types.show', compact('type', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeRequest  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validated = $request->validated();
        if ($validated['name'] !== $type->name) {
            $validated['slug'] =  Str::slug($validated['name']);
        }

        $type->update($validated);
        return to_route('types.show', $type)->with('update', 'Type updated');
    }

    public function restore(Type $type)
    {
        if ($type->trashed()) {
            $type->restore();
        }

        return back()->with('success', 'Type restored successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        if ($type->trashed()) {
            $type->forceDelete();
            return to_route('types.index')->with('message', 'Type deleted');
        }

        $type->delete();
        return back()->with('moved', 'Type moved to trash');
    }
}
