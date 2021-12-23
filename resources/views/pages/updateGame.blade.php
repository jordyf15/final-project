@extends('layout.layout')
@section('content')
<main>
    <div id="creategame-container">
        <div id="creategame-title">
            <h1>Update Games</h1>
        </div>
        
        <form enctype="multipart/form-data" class="mb-4" action="/updateGame/{{$game->game_id}}" method="POST">
            @csrf
            @method('PUT');
            <div>
                <label for="description">Game Description</label>
                <input class="form-control mt-1" type="text" name='description' id='description' value="{{$game->description}}">
                <p>Write a single sentence about the game</p>
            </div>
            <div>
                <label for="description_long">Game Long Description</label>
                <input class="form-control mt-1" type="text" name='description_long' id='description_long' value="{{$game->description_long}}">
                <p>Write a few sentences about the game</p>
            </div>
            <div>
                <label for="category">Game Category</label>
                <select class="form-select mt-1" name="category" id="category" value="{{$game->category}}">
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
            <div class="mt-3">
                <label for="price">Game Price</label>
                <input class="form-control mt-1" type="number" name='price' id='price' value="{{$game->price}}">
            </div>
            <div class="mt-3">
                <label for="cover">Game Cover</label>
                <input class="creategame-input mt-1" type="file" id="cover" name="cover">
            </div>
            <div class="mt-3">
                <label for="trailer">Game Trailer</label>
                <input class="creategame-input mt-1" type="file" id="trailer" name="trailer">
            </div>
            <div class="mt-3" id="creategame-button-container">
                <button class="btn" id="creategame-cancel" type='reset'>Cancel</button>
                <button class="btn" id="creategame-save" type="submit">Save</button>
            </div>
        </form>
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
    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif --}}
</main>
@endsection