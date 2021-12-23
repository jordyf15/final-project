@extends('layout.layout')
@section('content')
<main id='profileLayout-main'>
    <div id='profileLayout-container'>
        <div id='side-tab'>
            @auth
                <a href="/profile">Profile</a>
                @if (Auth::user()->role == 'member')
                    <a href="/friends">Friends</a>
                    <a href="/transactionhistory">Transaction History</a>
                @endif   
            @endauth
        </div>
        @yield('page')
    </div>
</main>
@endsection