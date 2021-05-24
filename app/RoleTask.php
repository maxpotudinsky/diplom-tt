<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleTask extends Model
{
    protected $table = 'roles_tasks';

    protected $fillable = [
        'user_id', 'role_id', 'task_id', 'project_id', 'company_id',
    ];

    public function rolesTasks()
    {
        return $this->belongsToMany(Role::class, 'roles_tasks', 'task_id', 'role_id');
    }
}
