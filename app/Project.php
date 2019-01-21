<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function path($route = ""){
    	return url('projects/'.$this->id.$route);
    }

    public function owner(){
    	return $this->belongsTo(User::class);
    }

    public function tasks(){
    	return $this->hasMany(Task::class);
    }

    public function addTask($body){
		return $this->tasks()->create(compact('body'));
    }
}
