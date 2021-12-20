@extends('layout.layout')
@section('content')
<main>
    <h2>{{$game->name}}</h2>
    <img src={{Storage::url($game->cover)}} alt={{$game->name}}>
    <p>{{$game->description}}</p>
    <p>Genre: {{$game->category}}</p>
    <p>Release Date: {{$game->release_date}}</p>
    <p>Developer: {{$game->developer}}</p>
    <p>Publisher: {{$game->publisher}}</p>
    @guest
    <a href="/login">Rp. {{$game->price}} | Add to cart</a>
    @endguest
    @auth
        @if (Auth::user() && Auth::user()->role == 'member')
            <a href='/cart/{{$game->game_id}}'>Rp. {{$game->price}} | Add to cart</a>
        @endif   
    @endauth
    <video width='600px' height="400px">
        <source src={{Storage::url($game->trailer)}} type="video/webm">
    </video>
    <p>ABOUT THIS GAME</p>
    <p>{{$game->description_long}}</p>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}}
    @endforeach
@endif
</main>
@endsection