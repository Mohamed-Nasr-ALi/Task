<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table ='projects';
    protected $fillable = ['title'];
    public $timestamps = true;

    public function tasks()
    {
        return $this->hasMany(Task::class,'project_id');
    }
}
