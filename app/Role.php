<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'roles_tasks', 'role_id', 'task_id');
    }
}
