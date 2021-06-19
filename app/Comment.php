<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //наименование таблицы в БД
    protected $table = 'comments';

    //разрешенные заполняемые поля модели Comment
    protected $fillable = [
        'text', 'user_id', 'task_id',
    ];

    //связь модели Comment многие к одному с моделью Task
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    //связь модели Comment многие к одному с моделью User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
