<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $table = 'task_status';

    public function task()
    {
        return $this->belongsTo(Task::class, 'status_id');
    }
}
