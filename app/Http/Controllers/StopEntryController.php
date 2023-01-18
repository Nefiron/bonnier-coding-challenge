<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StopEntryController extends Controller
{
    /**
     * Handle the incoming request to update the end time and stop the timer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param App\Entry $entry
     * @param App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Project $project, Entry $entry)
    {
        $stopEntry = $project->entries()->find($entry->id);

        $stopEntry->end = Carbon::now();

        $stopEntry->save();

        $entries = $project->entries()->orderBy('start', 'desc')->get();

        return response()->json($entries);
    }
}
