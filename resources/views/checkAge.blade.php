<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Age</title>
</head>
<body>
    <img src={{Storage::url($game->cover)}} alt={{$game->name}}>
    <p>CONTENT IN THIS PRODUCT MAY NOT BE APPROPRIATE FOR ALL AGES, OR MAY NOT BE APPROPRIATE FOR VIEWING AT WORK</p>
    <form class="mb-4" action="{{url()->current()}}" method="POST">
        @csrf
        <p>Please enter your birth date to continue</p>
        <input type="date" name="dob" id="dob">
        <button type="submit">View Page</button>
        <button>Cancel</button>
    </form>
</body>
</html>