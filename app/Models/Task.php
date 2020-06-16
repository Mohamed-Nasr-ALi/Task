<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table ='tasks';
    protected $fillable = ['task_title','project_id','status'];
    public $timestamps = true;
    protected $appends = ['project_tasks'];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
    public function getProjectTasksAttribute()
    {
        return $this->project->title;
    }
}
