<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.email' => 'Некорректный email',
            'required' => 'Обязательна к заполнению',
            'password.min' => 'Минимальная длина 6 символов',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        if(!Auth::attempt($validator->validated())) {
            return back()->withErrors(['invalid' => 'Неверный логин или пароль']);
        }

        if(Auth::user()->role === 0) {
            Auth::logout();
            return redirect()->route('blocked');
        }

        return redirect(route('index.index'));

    }

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:password_r',
            'password_r' => 'required',
        ], [
            'required' => 'Обязательна к заполнению',
            'email.unique' => 'Данный email уже зарегистрирован',
            'email.email' => 'Некорректный email',
            'password.min' => 'Минимальная длина 6 символов',
            'password.same' => 'Пароли не совпадают',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $user = User::query()->create(
            ['password' => Hash::make($request['password'])] + $validator->validated(),
        );

        Auth::login($user);
        return redirect(route('index.index'));

    }

    public function logout() {
        Auth::logout();
        return redirect(route('index.index'));
    }
}
