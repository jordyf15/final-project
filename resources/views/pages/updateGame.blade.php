@extends('layout.layout')
@section('content')
<h1>Update Games</h1>
<form enctype="multipart/form-data" class="mb-4" action="/updateGame/{{$game->game_id}}" method="POST">
    @csrf
    @method('PUT');
    <div>
        <label for="description">Game Description</label>
        <input type="text" name='description' id='description' value="{{$game->description}}">
        <p>Write a single sentence about the game</p>
    </div>
    <div>
        <label for="description_long">Game Long Description</label>
        <input type="text" name='description_long' id='description_long' value="{{$game->description_long}}">
        <p>Write a few sentences about the game</p>
    </div>
    <div>
        <label for="category">Game Category</label>
        <select name="category" id="category" value="{{$game->category}}">
            <option value="Idle">Idle</option>
            <option value="Strategy">Strategy</option>
            <option value="Horror">Horror</option>
            <option value="Role-Playing">Role-Playing</option>
            <option value="Adventure">Adventure</option>
            <option value="Puzzle">Puzzle</option>
            <option value="Action">Action</option>
            <option value="Simulation">Simulation</option>
            <option value="Sports">Sports</option>
        </select>
    </div>
    <div>
        <label for="price">Game Price</label>
        <input type="number" name='price' id='price' value="{{$game->price}}">
    </div>
    <div>
        <label for="cover">Game Cover</label>
        <input type="file" id="cover" name="cover">
    </div>
    <div>
        <label for="trailer">Game Trailer</label>
        <input type="file" id="trailer" name="trailer">
    </div>
    <button type='reset'>Cancel</button>
    <button type="submit">Save</button>
</form>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
@endsection