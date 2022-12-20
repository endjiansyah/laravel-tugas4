<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('login');
        }

        $email = $request->input("email");
        $password = $request->input('password');
        // dd($email, User::query()->where("email", $email)->first());
        $user = User::query()->where("email", $email)->first();

        if ($user == null) {
            return redirect()->back()->withErrors(['msg' => 'Email salah!!']);
        }
        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->withErrors(['msg' => 'Password Salah']);
        }

        if (!session()->isStarted()) session()->start();
        session()->put('logged', true);
        session()->put('siapahayo', $user->username);
        session()->put('idUser', $user->id);
        return redirect()->route('article.index');
    }

    function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
