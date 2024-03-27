<nav class="navbar navbar-expand-lg sticky-top" role="navigation">
    <div class="container-fluid">
        <!-- <a class="navbar-brand fw-bold" href="/">FINWALT</a> -->
        <div class="text-center m-1">
            <a href="/">
                <img src="{{ asset('images/logo-finwalt.png') }}" class="img-fluid" style="max-width: 150px">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('login') ? ' active' : '' }}" aria-current="page" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ Request::is('register') ? ' active' : '' }}" aria-current="page" href="/register">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
