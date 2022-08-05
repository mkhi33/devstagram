@extends('layouts.app')

@section('title')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action={{ route('profile.store') }} method="POST" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase  text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario" class="border  p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ auth()->user()->username }}">  
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase  text-gray-500 font-bold">Imagen Perfil</label>
                    <input id="image" name="image" type="file" accept=".jpg, .jpeg, .png" class="border  p-3 w-full rounded-lg">  
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase  text-gray-500 font-bold">Tu correo</label>
                    <input id="email" name="email" type="text" placeholder="Tu correo" class="border  p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ auth()->user()->email }}">  
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password"  class="mb-2  block uppercase  text-gray-500 font-bold">Contraseña actual</label>
                    <input id="password" name="password" type="password" placeholder="Password de registro" class="border  p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                    @enderror
                    @if (session('message'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{session('message')}}</p>
                    @endif
    
                </div>
                <div class="mb-5">
                    <label for="update_password"  class="mb-2  block uppercase  text-gray-500 font-bold">Nueva contraseña</label>
                    <input id="update_password" name="update_password" type="password" placeholder="Tu nueva contraseña" class="border  p-3 w-full rounded-lg @error('update_password') border-red-500 @enderror">
                    @error('update_password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                    @enderror
                </div>
                <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection