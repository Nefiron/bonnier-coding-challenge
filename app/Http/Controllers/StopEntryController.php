<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StopEntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
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
