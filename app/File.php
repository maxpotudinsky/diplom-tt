<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'name', 'task_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}

