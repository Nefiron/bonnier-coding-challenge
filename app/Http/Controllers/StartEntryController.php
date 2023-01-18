<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StartEntryController extends Controller
{
    /**
     * Handle the incoming request to create an entry and start a timer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Project $project)
    {
        $entry = $project->entries()->create([
            'task' => 'New Task',
            'start' => Carbon::now(),
            'end' =>  Carbon::now()->addSecond(),
        ]);

        return response()->json($entry);
    }
}
