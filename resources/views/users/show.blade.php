@extends('layouts.app')
@section('content')
    <show-user :user="{{ $users }}"></show-user>
@endsection
