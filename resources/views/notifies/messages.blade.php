@if(Request::is('login') || Request::is('home') )
    @if(Session::has('flash'))
        <div class="alert alert-warning" role="alert">
            {{ Session::get('flash') }}
        </div>
    @endif
    {{Session::forget('flash')}}
@else
    @if(Session::has('flash'))
        <div class="alert alert-success" role="alert">
            {{Session::get('flash')}}
        </div>
    @endif
@endif

@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
    </div>
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif


