<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index() {
        return view('profile.index');
    }

    public function store(Request $request) {
        // Modificar en el request
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required', 'string', 'max:20', 'unique:users,username,'.auth()->user()->id, 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->user()->id],
            'password' => ['required', 'string', 'min:8'],
            'update_password' => ['required', 'string', 'min:8'],
        ]);
        
        if($request->image) {
            $image = $request->file('image');
            $nameImage = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $serverImage = Image::make($image);
            $serverImage->fit(1000, 1000);
            $imagePath = public_path('profiles') . '/' . $nameImage;
            $serverImage->save($imagePath);
        }


        if( !auth()->attempt($request->only('email', 'password'), $request->remember) ) {
            return back()->with(
                'message', 'Usuario o contraseña incorrectos'
            );
        }

        // Guardar cambios
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $nameImage ?? auth()->user()->image ?? null;
        $user->email = $request->email;
        $user->password = Hash::make($request->update_password);
        
        $user->save();

        // Redireccionar
        return redirect()->route('posts.index', auth()->user()->username);


    }
}
