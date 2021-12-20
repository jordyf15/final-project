<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <div>
        <h2>{{$user->username}} Profile</h2>
        <p>This information will be displayed publicly so be careful what you share</p>
        <p>Username</p>
        <p>{{$user->username}}</p>
        <p>Level</p>
        <p>{{$user->level}}</p>
        <form enctype="multipart/form-data" class="mb-4" action="/updateUser/{{$user->user_id}}" method="POST">
            @csrf
        <div>
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" value="{{$user->fullname}}">
        </div>
        <div>
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password">
            <p>Fill out this field to check if you are authorized</p>
        </div>
        <div>
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password">
            <p>Only if you want to change your password</p>
        </div>
        <div>
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
            <p>Only if you want to change your password</p>
        </div>
        <div>
            <img src={{Storage::url($user->profile_picture)}} alt="">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture">
        </div>
        <button type="submit">Update Profile</button>
        </form>
    </div>
    <div>

    </div>
    <div>

    </div>
</body>
</html>