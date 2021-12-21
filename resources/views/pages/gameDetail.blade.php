@extends('layout.layout')
@section('content')
<main>
    <div id="game-detail-container">
        <div id="bread-container">
            <div id="bread">
                <ol style="--bs-breadcrumb-divider: '>';" class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><img src="/images/home.png" alt=""></a></li>
                    <li class="breadcrumb-item">{{$game->category}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$game->name}}</li>
                </ol>
            </div>
        </div>
        <div id="detail-game">
            <div id="video-container">
                <video width='900px' height="506px" controls>
                <source src={{Storage::url($game->trailer)}} type="video/webm">
                </video>
            </div>
            <div id="detail-game-container">
                <div id="game-img-container"><img src={{Storage::url($game->cover)}} alt={{$game->name}}></div>
                <div id="game-title-container"><h2>{{$game->name}}</h2></div>
                <div><p>{{$game->description}}</p></div>
                <div id="game-de-container"><p>Genre:</p>{{$game->category}}</div>
                <div id="game-de-container"><p>Release Date: </p>{{$game->release_date}}</div>
                <div id="game-de-container"><p>Developer: </p>{{$game->developer}}</div>
                <div id="game-de-container"><p>Publisher: </p>{{$game->publisher}}</div>
            </div>
        </div>
        <div>

        </div>
    </div>
    
    
    
    
   
    
    
    @guest
    <a href="/login">Rp. {{$game->price}} | Add to cart</a>
    @endguest
    @auth
        @if (Auth::user() && Auth::user()->role == 'member')
            <a href='/cart/{{$game->game_id}}'>Rp. {{$game->price}} | Add to cart</a>
        @endif   
    @endauth
    <p>ABOUT THIS GAME</p>
    <p>{{$game->description_long}}</p>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
</main>
@endsection