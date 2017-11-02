<nav class="navbar navbar-light justify-content-between">

    @section('back-link')
        <a class="navbar-brand" href="/">Blackboard</a>
    @show

    @if(Auth::check())
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ Auth::user()->thumbnail }}" alt="" class="img-avatar">
                    <span class="badge badge-primary badge-pill">1</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Projects</a>
                    <a class="dropdown-item" href="#">Tickets</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form"
                          action="{{ url('/logout') }}"
                          method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
    @else

        <a href="{{ route('login') }}" class="navbar-link">Login</a>
    @endif

</nav>
