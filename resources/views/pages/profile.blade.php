@extends('layout.profileLayout')
@section('page')
<div>
    <h2>{{$user->username}} Profile</h2>
    <p>This information will be displayed publicly so be careful what you share.</p>
    <form action="/profile/{{$user->user_id}}" method="POST">
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
        <img src={{Storage::url($user->profile_picture)}} alt="">
    </div>
    </form>
</div>
@endsection