<div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        {{--  <ul class="navbar-nav mr-auto">

        </ul>  --}}

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link nav-link-icon" href="{{ isset($prefix) ? route('admin'):route('home') }}">
                    <i class="fas fa-tasks"></i>
                    {{__('Dashboard')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-icon" href="{{ isset($prefix) ? route('get.login'):route('login') }}">
                    <i class="fas fa-key"></i>
                    {{ __('Login') }}
                </a>
            </li>
            @if ( ! Request::is('admin/*'))

            <li class="nav-item">
                <a class="nav-link " href="{{ route('register') }} ">
                    <i class="fas fa-user"></i>
                    {{ __('Register') }}
                </a>
            </li>
            @endif
            @else
                @if(Auth::guard('web')->check())
                    @if( ! Request::is('cart'))
                        <hover-cart></hover-cart>
                    @endif
                @endif
            <li class="nav-item dropdown">

                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if(auth::guard('web')->check())
                    <a class="dropdown-item" href="{{route('user.profile',['id'=>auth()->id()])}}">
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{route('user.profile',['id'=>auth()->id()])}}">
                        Order
                    </a>
                    @endif
                    <a class="dropdown-item" href="{{ auth()->guard('admin')->check() ? route('admin.logout'):route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ auth()->guard('admin')->check()? route('admin.logout'):route('logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</div>
