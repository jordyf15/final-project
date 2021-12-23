@extends('layout.layout')
@section('content')
<main>
    <div id='side-tab'>
        @auth
            <a href="/profile">Profile</a>
            @if (Auth::user()->role == 'member')
                <a href="/friends">Friends</a>
                <a href="/transactionHistory">Transaction History</a>
            @endif   
        @endauth
    </div>
    @yield('page')
</main>
@endsection