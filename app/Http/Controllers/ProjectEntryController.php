<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Project;
use Illuminate\Http\Request;

class ProjectEntryController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param App\Entry $entry
     * @param App\Project $project
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
     * @param App\Entry $entry
     * @param App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Entry $entry)
    {
        abort_if($entry->project_id !== $project->getKey(), 404);

        $entry->delete();

        return response()->json(['message' => 'Entry deleted']);
    }
}
