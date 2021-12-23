@extends('layout.profileLayout')
@section('page')
<div id='profile-side'>
    <h2>{{$user->username}} Profile</h2>
    <p>This information will be displayed publicly so be careful what you share.</p>
    <form enctype="multipart/form-data" action="/profile" method="POST">
    @csrf
    @method('PUT')
    <div id='profile-form-outer-container'>
        <div id='profile-form-outer-container-left'>
            <div id='profile-form-inner-container-left'>
                <div id='profile-form-username-container'>
                    <p id='profile-form-username-label'>Username</p>
                    <p id='profile-form-username-input'>{{$user->username}}</p>
                </div>
                <div id='profile-form-level-container'>
                    <p id='profile-form-level-label'>Level</p>
                    <p id='profile-form-level-input'>{{$user->level}}</p>
                </div>
            </div>
            <div id='profile-form-inner-container-right'>
                <label id='profile-form-fullname-label' for="fullname">Full Name</label>
                <input class='profile-form-fullname-input' type="text" id='fullname' name="fullname" value="{{Auth::user()->fullname}}">
            </div>
        </div>
        <div id='profile-form-outer-container-right'>
            <label for="photo">Photo</label>
            <div id='profile-photo-container'>
                @if(Auth::user()->profile_picture == '')
                <img src={{asset('/images/profile.png')}} alt="profile picture">
                @else
                    <img src={{Storage::url($user->profile_picture)}} alt="profile picture">
                @endif
                <input class='profile-input-photo' type="file" id="photo" name="photo">
            </div>
        </div>
    </div>
    <div id='profile-currentpassword-container'>
        <label for="currentPassword">Current Password</label>
        <input type="password" id="currentPassword" name="currentPassword">
        <p>Fill out this field to check if you are authorized</p>
    </div>
    <div id='profile-newpassword-container'>
        <label for="newPassword">New Password</label>
        <input type="password" id="newPassword" name="newPassword">
        <p>Only if you want to change your password</p>
    </div>
    <div id='profile-confirmpassword-container'>
        <label for="confirmNewPassword">Confirm New Password</label>
        <input type="password" id="newPassword_confirmation" name="newPassword_confirmation">
        <p>Only if you want to change your password</p>
    </div>
    <div id='profile-button-container'>
        <button type="submit">Update Profile</button>
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
    </form>
    @if(session()->has('successMessage'))
    <div id="game-detail-success-container">
        <div id="game-detail-show-success">
            <div id="game-detail-success-content">
                <p>{{session()->get('successMessage')}}</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection