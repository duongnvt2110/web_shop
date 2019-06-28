@extends('layouts.app')
@section('content')
    <show-product :categories="{{ $categories }}" v-cloak></show-product>
@endsection
