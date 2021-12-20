<header>
    <a href="/">Home</a> 
    
    @auth
        @if(Auth::user()->role == 'admin')
            <a href="/managegame">Manage Game</a>
        @endif
    @endauth

    <form action="/search" method="POST">
        @csrf
        <input type="text" id='search' name='search' placeholder="Search">
    </form>

    @guest
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    @endguest

    @auth
        @if(Auth::user()->role == 'admin')
            <button>Profile Dropdown</button>
            <div>
                <a href="/profile">Profile</a>
                <a href="/logout">Sign Out</a>
            </div>
        @endif
    @endauth

    @auth
        @if(Auth::user()->role == 'member')
            <a href='/cart'>Cart</a>
            <button>Profile Dropdown</button>
            <div>
                <a href="/profile">Profile</a>
                <a href="/friend">Friends</a>
                <a href="/transactionhistory">Transaction History</a>
                <a href="/logout">Sign Out</a>
            </div>
        @endif
    @endauth
</header>