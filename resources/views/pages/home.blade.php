@extends('layout.layout')
@section('content')
<main>
    <h1>Top Games</h1>
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
            <p>No Game can be displayed</p>
        @endif  
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif
    </div>
</main>
@endsection