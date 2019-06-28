@include('notifies.messages')
<flash message="{{ session('flash') }}"></flash>
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
