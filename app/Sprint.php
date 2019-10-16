<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $guarded = [];

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
