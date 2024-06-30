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
        <form action="{{ route('admin.settings.update', $settings->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <lable class="" for="">{{ __("settings.website_name") }}</lable>
                <input type="text" name="web_name" class="form-control mt-2"
                    value="{{ old('web_name', $settings->web_name) }}" />
            </div>
            <div class="form-group">
                <lable class="" for="">{{ __("settings.logo") }}</lable>
                <input type="file" name="logo" class="form-control mt-2"
                    value="{{ old('logo', $settings->logo) }}" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ __("general.save") }}</button>
            </div>
        </form>
    </div>
@endsection
