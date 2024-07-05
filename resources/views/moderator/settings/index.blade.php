@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("settings.settings") }}
@endsection

@section('home_route')
    {{ route('moderator.dashboard') }}
@endsection

@section('logout_route')
    {{ route('moderator.logout') }}
@endsection
@section('page_name')
{{ __("settings.settings") }}
@endsection

@section('content')
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __("settings.web_settings") }}</h3>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="width30">{{ __("general.name") }}</td>
                                <td>{{ $user->name ?? '#' }}</td>
                                
                            </tr>
                            <tr>
                                <td class="width30">{{ __("general.email") }}</td>
                                <td>{{ $user->email ?? '#' }}</td>
                            </tr>
                            

                            <tr>
                                <td class="width30">{{ __("settings.edit_settings") }}</td>
                                <td>
                                    <a href="{{ route('moderator.settings.edit') }}">
                                        <button class="btn btn-info">
                                            {{ __("settings.edit_settings") }}
                                        </button>
                                    </a>
                                </td>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
