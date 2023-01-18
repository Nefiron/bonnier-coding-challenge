<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function start(Request $request, Project $project)
    {
        $entry = $project->entries()->create([
            'start' => Carbon::now(),
            'end' =>  Carbon::now()->addSecond(),
        ]);

        return response()->json($entry);
    }

    public function stop(Project $project, Entry $entry)
    {
        $stopEntry = $project->entries()->find($entry->id);

        $stopEntry->end = Carbon::now();

        $stopEntry->save();

        $entries = $project->entries()->orderBy('start', 'desc')->get();

        return response()->json($entries);
    }
}
