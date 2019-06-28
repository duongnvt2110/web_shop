@extends('layouts.app')
@section('content')
    <admin-view-activity :data="{{ $activities }}"></admin-view-activity>
@endsection
