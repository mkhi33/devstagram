<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index () {
        return view('auth.register');
    }

    public function store( Request $request) {

        // Modificar en el request
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'name' => 'required|string|max:30',
            'username' => 'required|string|max:20|unique:users|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autenticar al usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // Otra forma de autenticar
        auth()->attempt($request->only(['email', 'password']));

        // redireccionar al usuario
        return redirect()->route('posts.index');
    }


}
