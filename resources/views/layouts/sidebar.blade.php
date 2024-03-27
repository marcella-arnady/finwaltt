<ul class="sidebar navbar-nav">
    <div class="text-center m-4 mb-5">
        <a href="/">
            <img src="{{ asset('images/logo-finwalt.png') }}" class="img-fluid" style="max-width: 150px">
        </a>
    </div>

    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link text-white m-1 ms-4" href="/">
            <i class="bi bi-house-fill"></i>
            <span>Home</span>
        </a>
    </li>

    @if(auth()->check() && auth()->user()->role == 'User')
    <li class="nav-item {{ Request::is('indexUserwallet', 'editUserwallet/*', 'addUserwallet', 'detailUserwallet/*') ? 'active' : '' }}">
        <a class="nav-link text-white m-1 ms-4" href="/indexUserwallet">
            <i class="bi bi-wallet"></i>
            <span>Wallet</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('indexTransaction', 'addTransaction', 'editTransaction/*') ? 'active' : '' }}">
        <a class="nav-link text-white m-1 ms-4" href="/indexTransaction">
            <i class="bi bi-arrow-left-right"></i>
            <span>Transaction</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('indexBudget', 'addBudget', 'editBudget/*') ? 'active' : '' }}">
        <a class="nav-link text-white m-1 ms-4" href="/indexBudget">
            <i class="bi bi-calculator"></i>
            <span>Budget</span>
        </a>
    </li>
    <li class="nav-item {{ Request::is('indexGoal', 'addGoal', 'editGoal/*') ? 'active' : '' }}">
        <a class="nav-link text-white m-1 ms-4" href="/indexGoal">
            <i class="bi bi-bullseye"></i>
            <span>Goal</span>
        </a>
    </li>
    @endif
    <li class="nav-item {{ Request::is('indexProfile', 'editProfile') ? 'active' : '' }}" style="position: absolute; bottom: 0; width: 100%">
        <a class="nav-link text-white m-1 ms-4" href="/indexProfile">
            <i class="bi bi-person-circle"></i>
            <span>Profile</span>
        </a>
    </li>
</ul>