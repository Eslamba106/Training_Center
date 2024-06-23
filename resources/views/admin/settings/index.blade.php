@extends('layouts.dashboard.dashboard')

@section('title')
    الاعدادت
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    الاعدادت
@endsection

@section('content')
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اعدادت الموقع</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="width30">اسم الموقع</td>
                                <td>{{ $settings->web_name ?? '#' }}</td>
                            </tr>
                            <tr>
                                <td class="width30">لوجو</td>
                                <td>
                                    <div class="image" >
                                        <img width="100" height="100" src="{{ $settings->image_url }}" alt="Not" class="custom_img">
                                        
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="width30">تعديل الاعدادات</td>
                                <td>
                                    <a href="{{ route('admin.settings.edit') }}">
                                        <button class="btn btn-info">
                                            تعديل الاعدادات
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
