<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
  {{-- header kyknya pake master form blade apa gitu --}}
    <h2>Top Games</h1>
    @if (count($games)>0)
        @for ($i = 0; $i < count($games); $i++)
            <div>
                <a href="/gameAdult/{{$games[$i]->game_id}}">
                    <img src={{Storage::url($games[$i]->cover)}} alt={{$games[$i]->name}}>
                </a>
                <p>{{$games[$i]->name}}</p>
                <p>{{$games[$i]->category}}</p>
            </div>
        @endfor
    @else
        <p>No Game can be displayed</p>
    @endif  

</body>
</html>