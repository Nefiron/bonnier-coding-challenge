<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Entry extends Model
{
    protected $fillable = [
        'task','start', 'end'
    ];

    public function setStartDateAttribute($value)
    {
        $this->attributes['start'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
