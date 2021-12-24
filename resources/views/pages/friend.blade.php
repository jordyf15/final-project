@extends('layout.profileLayout')
@section('page')
    <div id='friend-side'>
        <div id="friend-title" class="mb-3">
            <h2>Friends</h2>
        </div>
        <div class="mb-3">
            <form action="/friends" method='POST'>
                @csrf
                <h3 id="friend-title">Add Friend</h3>
                <div id="friend-form">
                    <div>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div id="friend-add-btn">
                        <button class="btn" id="add-btn" type="submit">Add</button>
                    </div>
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
        </div>
        <div>
            <h3 id="friend-title">Incoming Friend Request</h3>
            @if(count($incomingFriendRequest)==0)
                <p>There is no incoming friend request</p>
            @else
            <div id='incomingfriendrequests-container'>
                @for($i=0;$i<count($incomingFriendRequest);$i++)
                    <div class='incomingfriendrequests-items'>
                        <div class='incomingfriendrequests-items-top'>
                            <div class='incomingfriendrequests-items-top-left'>
                                <p class='incomingfriendrequests-item-username'>{{$incomingFriendRequest[$i]->sender->username}} <span class='incomingfriendrequests-item-level'>{{$incomingFriendRequest[$i]->sender->level}}</span></p>
                                <p>{{$incomingFriendRequest[$i]->sender->role}}</p>
                            </div>
                            @if($incomingFriendRequest[$i]->sender->profile_picture == '')
                                <img class='incomingfriendrequests-item-profpic' src={{asset('/images/profile.png')}} alt="profile picture">
                            @else
                                <img class='incomingfriendrequests-item-profpic' src={{Storage::url($incomingFriendRequest[$i]->sender->profile_picture)}} alt="{{$incomingFriendRequest[$i]->sender->username}}'s profile picture">
                            @endif
                        </div>
                        <div class='incomingfriendrequests-items-bottom'>
                            <form action="/friendRequests/{{$incomingFriendRequest[$i]->friend_request_id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class='incomingfriendrequests-items-bottom-accept' type="submit">Accept</button>
                            </form>
                            <form action="/friendRequests/{{$incomingFriendRequest[$i]->friend_request_id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Reject</button>
                            </form>
                        </div>
                    </div>
                @endfor
            </div>
            @endif
        </div>
        <div>
            <h3 id="friend-title">Pending Friend Request</h3>
            @if(count($pendingFriendRequest)==0)
                <p>There is no pending friend request</p>
            @else
            <div id='pendingfriendrequests-container'>
                @for($i=0;$i<count($pendingFriendRequest);$i++)
                    <div class='pendingfriendrequests-items'>
                        <div class='pendingfriendrequests-items-top'>
                            <div class='pendingfriendrequests-items-top-left'>
                                <p class='pendingfriendrequests-item-username'>{{$pendingFriendRequest[$i]->receiver->username}} <span class='pendingfriendrequests-item-level'>{{$pendingFriendRequest[$i]->receiver->level}}</span></p>
                                <p>{{$pendingFriendRequest[$i]->receiver->role}}</p>
                            </div>
                            @if ($pendingFriendRequest[$i]->receiver->profile_picture == '')
                                <img class='pendingfriendrequests-item-profpic' src={{asset('/images/profile.png')}} alt="profile picture">
                            @else
                                <img class='pendingfriendrequests-item-profpic' src="{{Storage::url($pendingFriendRequest[$i]->receiver->profile_picture)}}" 
                                alt="{{$pendingFriendRequest[$i]->receiver->username}}">
                            @endif
                        </div>
                        <div class='pendingfriendrequests-items-bottom'>
                            <form action="/friendRequests/{{$pendingFriendRequest[$i]->friend_request_id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Cancel</button>
                            </form>
                        </div>
                    </div>
                @endfor
            </div>  
            @endif
        </div>
        <div>
            <h3 id="friend-title">Your Friends</h3>
            @if(count($friendDetails)==0)
                <p>There is no friend</p>
            @else
            <div id='friends-container'>
                @for($i=0;$i<count($friendDetails);$i++)
                    <div class='friends-items'>
                        <div class='friends-items-left'>
                            <p class='friends-items-username'>{{$friendDetails[$i]->user->username}} <span class='friends-items-level'>{{$friendDetails[$i]->user->level}}</span></p>
                            <p>{{$friendDetails[$i]->user->role}}</p>
                        </div>
                        @if ($friendDetails[$i]->user->profile_picture == '')
                            <img class='friends-items-profpic' src={{asset('/images/profile.png')}} alt="profile picture">
                        @else
                            <img class='friends-items-profpic' src="{{Storage::url($friendDetails[$i]->user->profile_picture)}}" alt="">
                        @endif
                    </div>
                @endfor
            </div>
            @endif
        </div>
    </div>
@endsection
