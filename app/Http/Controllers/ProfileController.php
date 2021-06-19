<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //Метод редактирования профиля пользователя
    public function update(ProfileRequest $request)
    {
        $user = User::find(Auth::user()->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->hasfile('photo')) {
            $photo = $request->file('photo');
            $name = $photo->getClientOriginalName();
            $photo->move(public_path() . '/img/profiles/' . $user->name .'/photo/', $name);
            $user->update([
                'photo' => '/img/profiles/' . $user->name .'/photo/'. $name,
            ]);
        }
        if (Hash::check($request->password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back()->with('message-success', 'Ваши данные успешно обновлены!');
        } else {
            return back()->withErrors('Неверный пароль!');
        }
    }

    //Метод подключения страницы профиля пользователя
    public function index()
    {
        $user = User::find(Auth::user()->id);

        return view('profile.profile', compact('user'));
    }
}
