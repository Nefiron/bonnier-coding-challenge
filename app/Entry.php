<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'task','start', 'end'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
