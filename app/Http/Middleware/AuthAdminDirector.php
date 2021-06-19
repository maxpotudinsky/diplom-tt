<?php

namespace App\Http\Middleware;

use App\RoleTask;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdminDirector
{
//проверка доступа пользователя к панели администратора и к редактированию задач от лица постановщик
    public function handle($request, Closure $next)
    {
        $access = RoleTask::where([
            'user_id' => Auth::user()->id, 'role_id' => 1, 'task_id' => $request->id
        ])->first();

        if (Auth::check()) {
            if ((int)Auth::user()->admin === 1 or $access != null) {
                return $next($request);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
}
