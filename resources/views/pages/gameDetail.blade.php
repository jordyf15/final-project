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
        <div id="detail-game-bottom-container">
            <div id="game-price-container-left">
                <div id="price-left">Buy {{$game->name}}</div>
            </div>
            @guest
                <div id="game-price-container-right">
                    <div id="price-right">
                        <a href="/login">Rp. {{$game->price}} | Add to cart</a>
                    </div>
                </div>
            @endguest
            @auth
                @php
                    $own = false;
                    $user_library = Auth::user()->gameLibrary;
                    $user_games = $user_library->gameLibraryDetails;
                    for($i = 0;$i<count($user_games);$i++){
                        if($user_games[$i]->game_id==$game->game_id){
                            $own = true;
                        }
                    }
                @endphp
                @if (Auth::user() && Auth::user()->role == 'member' && $own == false)
                    <div id="game-price-container-right">
                        <div id="price-right">
                            <a href='/cart/{{$game->game_id}}'>Rp. {{$game->price}} | Add to cart</a>
                        </div>
                    </div>
                @endif  
            @endauth
        </div>
        <div id="detail-game-description">
            <div id="detail-game-description-title"><p>ABOUT THIS GAME</p></div>
            <div id="detail-game-line"></div>
            <div id="detail-game-description-desc"><p>{{$game->description_long}}</p></div>
        </div>
        @if ($errors->any())
            <div id="game-detail-error-container">
                <div id="game-detail-show-error">
                    <div id="game-detail-show-error-title">
                        There were error with your submission
                    </div>
                    <div id="game-detail-show-error-desc">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('successMessage'))
        <div id="game-detail-success-container">
            <div id="game-detail-show-success">
                <div id="game-detail-success-content">
                    <p>{{session()->get('successMessage')}}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection