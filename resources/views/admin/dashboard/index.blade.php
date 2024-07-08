@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('general.dashboard') }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    {{ __('general.home') }}
@endsection

@section('content')
    <h1>
        {{ __('general.welcome') }} {{ auth()->guard('admin')->user()->name }}

    </h1>
    <br><br>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $sections }}</h3>
                        <p>{{ __('section.sections') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                        <i class="fa fa-users"></i>
                        <i class="fa fa-users"></i>
                        <i class="fa fa-users"></i>

                 
                        {{-- <i class="ion ion-bag"></i> --}}
                    </div>
                    <a href="{{ route('admin.section') }}" class="small-box-footer">More info 
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $student_section }}</h3>
    
                        <p>{{ __('general.students') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                        <i class="ion ion-person"></i>
                        <i class="ion ion-person"></i>
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="{{ route('admin.student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $seniors }}</h3>
                        <p>{{ __('moderator.count_graduated') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-graduation-cap"></i>
                        <i class="fa fa-graduation-cap"></i>
                        <i class="fa fa-graduation-cap"></i>
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <a href="{{ route('admin.final_graduated') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
 
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
    
        <!-- /.row (main row) -->
    </div>
    

@endsection
