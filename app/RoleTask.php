<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleTask extends Model
{
    protected $table = 'roles_tasks';

    protected $fillable = [
        'user_id', 'role_id', 'task_id',
    ];
}
