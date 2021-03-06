<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //public function login(Request $request)
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        // метод attempt() выполняет аутентификацию пользователя. Вернет тру если успешно аутентифицирован, иначе вернет фолс
		//attempt() берет все поля кроме пароля, по ним находит сущность в БД.. в таблице юзерс..затем шифрует пароль и потом проверяет правильный пароль или нет
		if (Auth::attempt($credentials)) {
            return response(true);
        }

        return response(false, 401); //если не получилось авторизоваться
    }

    public function logout()
    {
        Auth::logout();

        return response(true);
    }
	
	public function home()
    {
        return response(Auth::user()); //авторизованный пользователь
    }
}