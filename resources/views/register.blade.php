<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="/css/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div id="container">
    <div id="kiri">
        <h1>Register Page</h1>
        <form class="mb-4" action="{{url()->current()}}" method="POST">
            @csrf
            <div class="mt-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mt-3">
                <label for="fullname">Fullname</label>
                <input type="text" class="form-control" id="fullname" name="fullname">
            </div>
            <div class="mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mt-3">
                <label for="role">Role</label>
                <select class="form-select" name="role" id="role">
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button class="btn btn-m btn-primary mt-3 mb-3" type="submit">Sign Up</button>
            <div>
                <a href="/login">Already have an account?</a>
            </div>
        </form>
        <div id="error">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif
        </div>
    </div>
    <div id="kanan">

    </div>
</div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>