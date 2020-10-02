@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
    <p>Hello {{ Auth::user()->name }}</p>
@endsection


@section('plugin_css')
    
@endsection


@section('plugin_js')
    
@endsection