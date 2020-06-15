<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $table ='projects';
    protected $fillable = ['title'];
    protected $appends = ['percent','count_tasks'];
    public $timestamps = true;

    public function tasks()
    {
        return $this->hasMany(Task::class,'project_id');
    }
    public function getPercentAttribute()
    {
       $done= $this->tasks()->where('status',1)->count();
        $total= $this->tasks()->count();
        return $done / (($total === 0) ?$total=1:$total) * 100;
    }
    public function getCountTasksAttribute()
    {
        return $this->tasks()->count();
    }
}
