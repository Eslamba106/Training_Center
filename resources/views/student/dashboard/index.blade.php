@extends('layouts.dashboard.dashboard')

@section('title')
    لوحة التحكم
@endsection

@section('home_route')
    {{ route('student.dashboard') }}
@endsection

@section('logout_route')
    {{ route('student.logout') }}
@endsection
@section('page_name')
    الرئيسية
@endsection

@section('content')
    
@endsection