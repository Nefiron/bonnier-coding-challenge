<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Project;
use Illuminate\Http\Request;

class ProjectEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $entries = $project->entries()->orderBy('start', 'desc')->get();

        return response()->json($entries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project, Entry $entry, Request $request)
    {
        abort_if($entry->project_id !== $project->getKey(), 404);

        $entry->update($request->all());

        return response()->json($entry);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
