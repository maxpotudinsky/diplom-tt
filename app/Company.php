<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //наименование таблицы в БД
    protected $table = 'companies';

    //разрешенные заполняемые поля модели Company
    protected $fillable = [
        'name', 'is_active', 'code',
    ];

    //связь модели Company один ко многим с моделью User
    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    //связь модели Company один ко многим с моделью Project
    public function projects()
    {
        return $this->hasMany(Project::class, 'company_id');
    }
}
