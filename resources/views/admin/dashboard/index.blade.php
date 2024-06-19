@extends('layouts.dashboard.dashboard')

@section('title')
    لوحة التحكم
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    الرئيسية
@endsection

@section('content')
    
@endsection