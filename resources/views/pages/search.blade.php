@extends('layout.layout')
@section('content')
<main>
    <h1>Search Games</h1>
    @if (count($games)>0)
    @for ($i = 0; $i < count($games); $i++)
        <a href='/game/{{$games[$i]->game_id}}'>
            <div>
                <img src={{Storage::url($games[$i]->cover)}} alt={{$games[$i]->name}}>
                <p>{{$games[$i]->name}}</p>
                <p>{{$games[$i]->category}}</p>
            </div>
        </a>
    @endfor
    @else
        <p>No Game can be displayed</p>
    @endif  
</main>
@endsection