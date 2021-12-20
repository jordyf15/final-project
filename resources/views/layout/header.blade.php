<header>
    <div id="header-container">

        <div id="logo-rexsteam">
            <img src="/images/rexsteam.png" alt="rexsteam logo">
        </div>

        <div id="rexsteam">
            Rexsteam
        </div>

        <div id="home-header">
            <a href="/">Home</a>
        </div>
        
        <div id="manage-game-header">
            @auth
                @if(Auth::user()->role == 'admin')
                    <a href="/managegame">Manage Game</a>
                @endif
            @endauth
        </div>
    
        <div id="search-header">
            <form action="/search" method="POST">
                @csrf
                <input class="form-control me-5" type="text" id='search' name='search' placeholder="Search">
            </form>
        </div>
        
        <div id="login-register-guest">
            @guest
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endguest
        </div>
    
        <div id="auth">
            @auth
                @if(Auth::user()->role == 'admin')
                <div>
                    <ul>
                        <button>Profile Dropdown</button>
                        <li><a href="/profile">Profile</a></li>
                        <li><a href="/logout">Sign Out</a></li>
                    </ul>
                </div>
                @endif
            @endauth
        </div>
    
        <div id="auth">
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
        </div>
    </div>
</header>