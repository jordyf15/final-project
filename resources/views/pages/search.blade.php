@extends('layout.layout')
@section('content')
<main>
    <div id="main-container">
        <h1 id="main-title">Search Games</h1>
        <div id="game-display">
            @if (count($games)>0)
            @for ($i = 0; $i < count($games); $i++)
                <a id="home-game-link" href='/game/{{$games[$i]->game_id}}'>
                    <div id="home-game-container">
                        <img id="home-game-cover" src={{Storage::url($games[$i]->cover)}} alt={{$games[$i]->name}}>
                        <div id="home-game-detail">
                            <div id="home-game-name">{{$games[$i]->name}}</div>
                            <div id="home-game-category">{{$games[$i]->category}}</div>
                        </div>
                    </div>
                </a>
            @endfor
            @else
                <p>There are no games content that can be displayed</p>
            @endif  
        </div>
    </div>
</main>
@endsection