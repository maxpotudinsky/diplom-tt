<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name', 'is_active', 'code',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'company_id');
    }

//    public function addCompany($body, $name, $email, $user_id)
//    {
//        $this->users()->create(compact('body', 'name', 'email', 'user_id'));
//    }
//
//    public static function boot()
//    {
//        parent::boot(); // TODO: Change the autogenerated stub
//        static::creating(function ($company) {
//            $company->users()->create();
//
//        });
//    }
}