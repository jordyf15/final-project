@extends('layout.profileLayout')
@section('page')
    <div>
        <h2>Friends</h2>
        <div>
            <form action="/friend" method='POST'>
                @csrf
                <h3>Add Friend</h3>
                <input type="text" name="username" id="username" placeholder="Username">
                <button type="submit">Add</button>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        {{$error}}
                    @endforeach
                @endif
            </form>
        </div>
        <div>
            <h3>Incoming Friend Request</h3>
            @for($i=0;$i<count($incomingFriendRequest);$i++)
                <div>
                    
                </div>
            @endfor
        </div>
    </div>
@endsection
