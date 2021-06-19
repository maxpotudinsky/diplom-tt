<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //наименование таблицы в БД
    protected $table = 'roles';

    //связь модели Role многие ко многим с моделью Task
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'roles_tasks', 'role_id', 'task_id')->withPivot('user_id');
    }

    //отключение временных меток
    public $timestamps = false;
}
