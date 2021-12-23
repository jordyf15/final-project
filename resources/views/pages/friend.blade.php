@extends('layout.profileLayout')
@section('page')
    <div>
        <div id="friend-title" class="mb-3">
            <h2>Friends</h2>
        </div>
        <div class="mb-3">
            <form action="/friends" method='POST'>
                @csrf
                <h3>Add Friend</h3>
                <div id="friend-form">
                    <div>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div id="friend-add-btn">
                        <button class="btn" id="add-btn" type="submit">Add</button>
                    </div>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        {{$error}}
                    @endforeach
                @endif
            </form>
        </div>
        <div>
            <h3>Incoming Friend Request</h3>
            @if(count($incomingFriendRequest)==0)
                <p>There is no incoming friend request</p>
            @else
                @for($i=0;$i<count($incomingFriendRequest);$i++)
                    <div>
                        <p>{{$incomingFriendRequest[$i]->sender->username}} {{$incomingFriendRequest[$i]->sender->level}}</p>
                        @if($incomingFriendRequest[$i]->sender->profile_picture == '')
                            <img src={{asset('/images/profile.png')}} alt="profile picture">
                        @else
                            <img src={{Storage::url($incomingFriendRequest[$i]->sender->profile_picture)}} alt="{{$incomingFriendRequest[$i]->sender->username}}'s profile picture">
                        @endif
                        <p>{{$incomingFriendRequest[$i]->sender->role}}</p>
                            <form action="/friendRequests/{{$incomingFriendRequest[$i]->friend_request_id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit">Accept</button>
                            </form>
                            <form action="/friendRequests/{{$incomingFriendRequest[$i]->friend_request_id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Reject</button>
                            </form>
                    </div>
                @endfor
            @endif
        </div>
        <div>
            <h3>Pending Friend Request</h3>
            @if(count($pendingFriendRequest)==0)
                <p>There is no pending friend request</p>
            @else
                @for($i=0;$i<count($pendingFriendRequest);$i++)
                    <div>
                        <p>{{$pendingFriendRequest[$i]->receiver->username}} {{$pendingFriendRequest[$i]->receiver->level}}</p>
                        @if ($pendingFriendRequest[$i]->receiver->profile_picture == '')
                            <img src={{asset('/images/profile.png')}} alt="profile picture">
                        @else
                            <img src="{{Storage::url($pendingFriendRequest[$i]->receiver->profile_picture)}}" 
                            alt="{{$pendingFriendRequest[$i]->receiver->username}}">
                        @endif
                        <p>{{$pendingFriendRequest[$i]->receiver->role}}</p>
                        <form action="/friendRequests/{{$pendingFriendRequest[$i]->friend_request_id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Cancel</button>
                        </form>
                    </div>
                @endfor
            @endif
        </div>
        <div>
            <h3>Your Friends</h3>
            @if(count($friendDetails)==0)
                <p>There is no friend</p>
            @else
                @for($i=0;$i<count($friendDetails);$i++)
                    <div>
                        <p>{{$friendDetails[$i]->user->username}} {{$friendDetails[$i]->user->level}}</p>
                        @if ($friendDetails[$i]->user->profile_picture == '')
                            <img src={{asset('/images/profile.png')}} alt="profile picture">
                        @else
                            <img src="{{Storage::url($friendDetails[$i]->user->profile_picture)}}" alt="">
                        @endif
                        <p>{{$friendDetails[$i]->user->role}}</p>
                    </div>
                @endfor
            @endif
        </div>
    </div>
@endsection
