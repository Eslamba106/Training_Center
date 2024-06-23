@extends('layouts.dashboard.dashboard')

@section('title')
    لوحة التحكم
@endsection

@section('home_route')
    {{ route('moderator.dashboard') }}
@endsection

@section('logout_route')
    {{ route('moderator.logout') }}
@endsection
@section('page_name')
    الرئيسية
@endsection

@section('content')
    
@endsection