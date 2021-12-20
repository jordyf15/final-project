<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Detail</title>
</head>
<body>
    <h2>{{$game->name}}</h2>
    <img src={{Storage::url($game->cover)}} alt={{$game->name}}>
    <p>{{$game->description}}</p>
    <p>Genre: {{$game->category}}</p>
    <p>Release Date: {{$game->release_date}}</p>
    <p>Developer: {{$game->developer}}</p>
    <p>Publisher: {{$game->publisher}}</p>
    <button>Rp. {{$game->price}} | Add to cart</button>
    <video width='600px' height="400px">
        <source src={{Storage::url($game->trailer)}} type="video/webm">
    </video>
    <p>ABOUT THIS GAME</p>
    <p>{{$game->description_long}}</p>
</body>
</html>