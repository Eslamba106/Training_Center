@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("general.dashboard") }}
@endsection

@section('home_route')
    {{ route('moderator.dashboard') }}
@endsection

@section('logout_route')
    {{ route('moderator.logout') }}
@endsection
@section('page_name')
{{ __("general.home") }}
@endsection

@section('content')
<h1>
  {{ __("general.welcome") }} {{ auth()->guard('moderator')->user()->name }} {{ __("general.in_section") }} {{ $section->name }}

</h1>
<br><br>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ count($student_section) }}</h3>
                <p>{{ __("moderator.count_student") }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
                {{-- <i class="ion ion-bag"></i> --}}
              </div>
              {{-- <a href="#" class="small-box-footer">More info 
                <i class="fas fa-arrow-circle-right"></i>
            </a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ count($seniors) }}</h3>
                <p>{{ __("moderator.count_graduated") }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ count($attendance) }}</h3>

                <p>{{ __("moderator.count_presence") }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ count($excused) }}</h3>

                <p>{{ __("moderator.count_absence") }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div>








      {{-- نسبة مؤية --}}
      {{-- <sup style="font-size: 20px">%</sup> --}}
@endsection