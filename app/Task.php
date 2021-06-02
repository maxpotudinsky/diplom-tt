<?php

namespace App;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'name', 'text', 'time', 'fact_time', 'price', 'limit', 'importance', 'is_active', 'status_id', 'project_id', 'company_id',
    ];

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'task_id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_tasks', 'task_id', 'role_id')->withPivot('user_id');
    }
}
