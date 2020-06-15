<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table ='tasks';
    protected $fillable = ['task_title','project_id','status'];
    public $timestamps = true;

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
