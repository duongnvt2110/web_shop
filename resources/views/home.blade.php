@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <home-product :products="{{ $products }}"></home-product>
            {{-- <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
