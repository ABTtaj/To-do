<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded=[];

    public function sprints(){
        return $this->hasMany(Sprint::class);
    }

    public function tasks(){
        return $this->hasManyThrough(Task::class,Sprint::class);
    }
}
