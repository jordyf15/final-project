@extends('layout.layout')
@section('content')
<main>
    <div id="creategame-container">
        <div id="creategame-title">
            <h1>Create Games</h1>
        </div>
        
        <form enctype="multipart/form-data" class="mb-4" action="{{url()->current()}}" method="POST">
            @csrf
            <div>
                <label for="name">Game Name</label>
                <input class="form-control mt-1" type="text" id="name" name="name">
            </div>
            <div>
                <label class="mt-3" for="description">Game Description</label>
                <input class="form-control mt-1" type="text" id="description" name="description">
            </div>
            <div>
                <label class="mt-3" for="description_long">Game Long Description</label>
                {{-- <input class="form-control" type="text" id="description_long" name="description_long"> --}}
                <textarea class="form-control mt-1" type="text" name="description_long" id="description_long" cols="30" rows="7"></textarea>
            </div>
            <div>
                <label class="mt-3" for="category">Game Category</label>
                <select class="form-select mt-1" name="category" id="category">
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
                <label class="mt-3" for="developer">Game Developer</label>
                <input class="form-control mt-1" type="text" id="developer" name="developer">
            </div>
            <div>
                <label class="mt-3" for="publisher">Game Publisher</label>
                <input class="form-control mt-1" type="text" id="publisher" name="publisher">
            </div>
            <div>
                <label class="mt-3" for="price">Game Price</label>
                <input class="form-control mt-1" type="number" id="price" name="price">
            </div>
            <div id="creategame-input-container">
                <label class="mt-3" for="cover">Game Cover</label>
                <input class="creategame-input mt-1" type="file" id="cover" name="cover">
            </div>
            <div>
                <label class="mt-3" for="trailer">Game Trailer</label>
                <input  class="creategame-input mt-1" type="file" id="trailer" name="trailer">
            </div>
            <div>
                <input class="mt-3" class="form-check-input" type="checkbox" id="adult" name="adult">
                <label for="adult">Only for adult ?</label>
            </div>
            <div class="mt-3" id="creategame-button-container">
                <button class="btn" id="creategame-cancel" type="reset">Cancel</button>
                <button class="btn" id="creategame-save" type="submit">Save</button>
            </div>
        </form>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif
    </div>
</main>
@endsection