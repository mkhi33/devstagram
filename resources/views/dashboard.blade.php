@extends('layouts.app')

@section('title')
    Perfil: {{$user->username}}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <p><img src={{ $user->image ? asset('profiles') . '/' . $user->image : asset('img/usuario.svg')}} alt="" srcset=""></p>
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10 md:items-start md:py-10">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    @auth
                        @if ( $user->id === auth()->user()->id )
                            <a class="text-gray-500 hover:text-gray-600 cursor-pointer" href={{ route('profile.index') }}>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count() )</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    <span class="font-normal">{{$user->followings->count()}} </span>
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->posts->count()}}
                    <span class="font-normal">Posts</span>
                </p>
                @auth
                    @if ( $user->id !== auth()->user()->id )

                        @if (! $user->follow(auth()->user()))
                            <form action={{ route('users.follow', $user) }} method="POST">
                                @csrf
                                <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir">
                            </form>
                            
                        @else
                            <form action={{ route('users.unfollow', $user) }} method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Dejar de seguir">
                            </form>
                        @endif

                    @endif
                @endauth

            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10 ">Publicaciones</h2>
        <x-post-list :posts="$posts"/>
    </section>
@endsection