@extends('layouts.app')
@section('title')
    Página principal
@endsection
@section('content')
    <x-post-list :posts="$posts"/>
    

@endsection

