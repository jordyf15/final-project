<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Game</title>
</head>
<body>
    <h1>Create Games</h1>
    <form enctype="multipart/form-data" class="mb-4" action="{{url()->current()}}" method="POST">
        @csrf
        <div>
            <label for="name">Game Name</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="description">Game Description</label>
            <input type="text" id="description" name="description">
        </div>
        <div>
            <label for="description_long">Game Long Description</label>
            <input type="text" id="description_long" name="description_long">
        </div>
        <div>
            <label for="category">Game Category</label>
            <select name="category" id="category">
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
            <label for="developer">Game Developer</label>
            <input type="text" id="developer" name="developer">
        </div>
        <div>
            <label for="publisher">Game Publisher</label>
            <input type="text" id="publisher" name="publisher">
        </div>
        <div>
            <label for="price">Game Price</label>
            <input type="number" id="price" name="price">
        </div>
        <div>
            <label for="cover">Game Cover</label>
            <input type="file" id="cover" name="cover">
        </div>
        <div>
            <label for="trailer">Game Trailer</label>
            <input type="file" id="trailer" name="trailer">
        </div>
        <div>
            <input type="checkbox" id="adult" name="adult">
            <label for="adult">Only for adult ?</label>
        </div>
        <button type="reset">Cancel</button>
        <button type="submit">Save</button>
    </form>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}}
    @endforeach
@endif
</body>
</html>