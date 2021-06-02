<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function isUserDestroyError()
    {
        return redirect::route('users.index')->with('message-error', 'Невозможно удалить авторизованного пользователя!');
    }

    public function isUserDestroySuccess($id)
    {
        User::find($id)->delete();
        return redirect::route('users.index')->with('message-success', 'Пользователь успешно удален!');
    }

    public function destroy($id)
    {
//        dd(User::find($id)->id);
//        Auth::user()->id == $id ? $this->isUserDestroyError() : $this->isUserDestroySuccess($id);
        if (Auth::user()->id == $id) {
            return $this->isUserDestroyError();
        } else {
            return $this->isUserDestroySuccess($id);
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
//dd($request->password);
        $user->fill([
            'name' => $request->name,
//            'email' => $request->email,
            'phone' => $request->phone,
        ])->save();
        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            return redirect::route('users.index')->with('message-success', 'Пользователь успешно отредактирован!');
        }
    }

    public function show($id)
    {
        return view('users.update', [
            'user' => User::find($id),
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => Auth::user()->company_id,
            'password' => Hash::make($request->password),
        ]);
        return redirect::route('users.index')->with('message-success', 'Пользователь успешно добавлен!');
    }

    public function create()
    {
        return view('users.create');
    }

    public function index()
    {
        $users = User::where(['company_id' => Auth::user()->company_id])->paginate(4);

        return view('users.users', compact(['users']));
    }
}
