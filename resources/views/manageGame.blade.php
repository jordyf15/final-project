<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Game</title>
</head>
<body>
    @foreach($games as $game)
    <div class="card" style="width: 400px">
        <a href='/gameAdult/{{$game->game_id}}'>
            <img src={{Storage::url($game->cover)}} alt={{$game->name}}>
        </a>
        <p>{{$game->name}}</p>
        <p>{{$game->category}}</p>
        <form class="mb-4" action="/updateGame/{{$game->game_id}}" method="GET">
            @csrf
            <button type="submit">Update</button>
        </form>
        <form action="/game/{{$game->game_id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
    @endforeach
    <form class="mb-4" action="/createGame" method="GET">
        @csrf
        <button type="submit">Create Game</button>
    </form>
</body>
</html>