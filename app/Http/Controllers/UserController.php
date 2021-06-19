<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //Метод удаления пользователя в админ панели
    public function destroy($id)
    {
        $error = 'Невозможно удалить авторизованного пользователя!';
        $success = 'Пользователь успешно удален!';
        if (Auth::user()->id == $id) {
            return redirect::route('users.index')->with('message-error', $error);
        } else {
            User::find($id)->delete();
            return redirect::route('users.index')->with('message-success', $success);
        }
    }

    //Метод редактирования пользователей в админ панели
    public function update(UserUpdateRequest $request, $id)
    {
        $success = 'Пользователь успешно отредактирован!';
        $user = User::find($id);
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ])->save();
        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            return redirect::route('users.index')->with('message-success', $success);
        } else {
            return back()->withErrors('Неверный пароль!');
        }
    }

    //Метод подключения страницы редактирования пользователей в админ панели
    public function show($id)
    {
        return view('users.update', [
            'user' => User::find($id),
        ]);
    }

    //Метод создания пользователей в админ панели
    public function store(UserRequest $request)
    {
        $success = 'Пользователь успешно добавлен!';
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => Auth::user()->company_id,
            'password' => Hash::make($request->password),
        ]);
        return redirect::route('users.index')->with('message-success', $success);
    }

    //Метод подключения страницы создания пользователей в админ панели
    public function create()
    {
        return view('users.create');
    }

    //Метод подключения страницы пользователей в админ панели
    public function index()
    {
        $users = User::where(['company_id' => Auth::user()->company_id])->paginate(4);

        return view('users.users', compact(['users']));
    }
}
