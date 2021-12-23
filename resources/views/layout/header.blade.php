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
                    <a href="/manageGame">Manage Game</a>
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
    
        <div id="auth" class="dropdown">
            @auth
                @if(Auth::user()->role == 'admin')
                <button data-bs-toggle="dropdown" type="button" id="btn">
                    @if(Auth::user()->profile_picture == '')
                        <img src={{asset('/images/profile.png')}} alt="profile picture">
                    @else
                        <img src={{Storage::url(Auth::user()->profile_picture)}} alt="profile picture">
                    @endif
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/profile">Profile</a></li>
                    <li><a class="dropdown-item" href="/logout">Sign Out</a></li>
                </ul>
                @endif
            @endauth
        </div>
    
        <div id="auth-member">
            @auth
                @if(Auth::user()->role == 'member')
                <div id="cart">
                    <a href='/cart'><img src="/images/cart.png" alt=""></a>
                </div>
                <div id="dropdown" class="dropdown">
                    <button data-bs-toggle="dropdown" type="button" id="btn">
                        @if(Auth::user()->profile_picture == '')
                            <img src={{asset('/images/profile.png')}} alt="profile picture">
                        @else
                            <img src={{Storage::url(Auth::user()->profile_picture)}} alt="profile picture">
                        @endif
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="/friend">Friends</a></li>
                        <li><a class="dropdown-item" href="/transactionhistory">Transaction History</a></li>
                        <li><a class="dropdown-item" href="/logout">Sign Out</a></li>
                    </ul>
                </div>
                @endif
            @endauth
        </div>
    </div>
</header>