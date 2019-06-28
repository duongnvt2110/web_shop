<div class="wrapper">
<div class="parallax filter-gradient blue" data-color="blue">
    <div class="parallax-background">
        <img class="parallax-background-image" src="{{asset('storage/bg3.jpg')}}">
    </div>
    @if( ! Request::is('login') && ! Request::is('register'))
    <div class="container">
        <div class="row">
            <div class="col-md-12 hidden-xs">
                <div id="description-carousel" class="carousel fade parallax-carousel" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item">
                            <img src="{{asset('storage/logo.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item active">
                            <img src="{{asset('storage/logo.jpg')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('storage/logo.jpg')}}" alt="">
                        </div>
                    </div>
                    <ol class="carousel-indicators">
                        <li data-target="#description-carousel" data-slide-to="0" class=""></li>
                        <li data-target="#description-carousel" data-slide-to="1" class="active"></li>
                        <li data-target="#description-carousel" data-slide-to="2" class=""></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@include('notifies.messages')
<flash message="{{ session('flash') }}"></flash>
@if( ! Request::is('login') && ! Request::is('register'))
<div class="section section-category">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-6 row-category ">
                <img class="rounded " src="{{asset('storage/bg3.jpg')}}" />
                <div class="content">
                    <a class="centered text-category">Category</a>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6 row-category ">
                <img class="rounded " src="{{asset('storage/bg3.jpg')}}" />
                <div class="content">
                    <a class="centered text-category">Category</a>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6 row-category ">
                <img class="rounded" src="{{asset('storage/bg3.jpg')}}" />
                <div class="content">
                    <a class="centered text-category">Category</a>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6 row-category ">
                <img class="rounded" src="{{asset('storage/bg3.jpg')}}" />
                <div class="content">
                    <span class="centered text-category">Category</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="section section-product">
    @if(Request::is('login') || Request::is('register') || Request::is('admin/login') || Request::is('admin/register'))
    <main class="py-4">
        @yield('content')
    </main>
    @else
    <div class="py-4 container-fluid">
        <div class="row">
            @if(Auth::guard('admin')->check())
            <div class="col-6 col-md-2">
                <nav-page></nav-page>
            </div>
            <div class="col-6 col-md-10">
                @yield('content')
            </div>
            @else
            <div class="col col-md-12">
                @yield('content')
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
<footer class="footer bgf">
    <div class="container">
        <nav class="pull-left">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ isset($prefix) ? route('admin'):route('home') }}">
                        {{__('Home')}}
                    </a>
                </li>
            </ul>
        </nav>
        <div class="social-area pull-right">
            <a class="btn btn-social btn-facebook btn-simple">
                <i class="fab fa-facebook-square"></i>
            </a>
        </div>
        <div class="copyright">
            @ Make 2019
        </div>
    </div>
</footer>
</div>
