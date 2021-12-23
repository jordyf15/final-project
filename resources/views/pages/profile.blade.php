@extends('layout.profileLayout')
@section('page')
<div>
    <h2>{{$user->username}} Profile</h2>
    <p>This information will be displayed publicly so be careful what you share.</p>
    <form enctype="multipart/form-data" action="/profile" method="POST">
    @csrf
    @method('PUT')
    <div>
        <p>Username</p>
        <p>{{$user->username}}</p>
    </div>
    <div>
        <p>Level</p>
        <p>{{$user->level}}</p>
    </div>
    <div>
        <label for="photo">Photo</label>
        @if(Auth::user()->profile_picture == '')
            <img src={{asset('/images/profile.png')}} alt="profile picture">
        @else
            <img src={{Storage::url($user->profile_picture)}} alt="profile picture">
        @endif
        <input type="file" id="photo" name="photo">
    </div>
    <div>
        <label for="fullname">Full Name</label>
        <input type="text" id='fullname' name="fullname" value="{{Auth::user()->fullname}}">
    </div>
    <div>
        <label for="currentPassword">Current Password</label>
        <input type="password" id="currentPassword" name="currentPassword">
        <p>Fill out this field to check if you are authorized</p>
    </div>
    <div>
        <label for="newPassword">New Password</label>
        <input type="password" id="newPassword" name="newPassword">
        <p>Only if you want to change your password</p>
    </div>
    <div>
        <label for="confirmNewPassword">Confirm New Password</label>
        <input type="password" id="newPassword_confirmation" name="newPassword_confirmation">
        <p>Only if you want to change your password</p>
    </div>
    <button type="submit">Update Profile</button>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
    </form>
</div>
@endsection