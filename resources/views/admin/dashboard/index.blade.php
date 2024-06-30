@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("general.dashboard") }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __("general.home") }}

@endsection

@section('content')
    
@endsection