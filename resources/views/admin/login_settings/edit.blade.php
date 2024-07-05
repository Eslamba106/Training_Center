@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("settings.edit_settings") }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    {{ __("settings.edit_settings") }}
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <h3>Error Occured!</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.login_settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <lable class="" for="">{{ __("general.name") }}</lable>
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="text" name="name" class="form-control mt-2"
                    value="{{ old('name', $user->name) }}" />
            </div>
            <div class="form-group">
                <lable class="" for="">{{ __("general.email") }}</lable>
                <input type="text" name="email" class="form-control mt-2"
                    value="{{ old('email', $user->email) }}" />
            </div>
            <div class="form-group">
                <lable class="" for="">{{ __("general.password") }}</lable>
                <input type="password" name="password" class="form-control mt-2"
                    value="{{ old('pasword', $user->pasword) }}" />
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ __("general.save") }}</button>
            </div>
        </form>
    </div>
@endsection
