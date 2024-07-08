@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("student.the_student") }}  : {{ $student->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __("student.the_student") }} : {{ $student->name }}
@endsection

@section('content')
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">     {{ __("student.the_student") }}  : {{ $student->name }}

                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="width30">{{ __("general.name") }} </td>
                                <td>{{ $student->name }}</td>
                            </tr>
                            <tr>
                                <td class="width30">{{ __("attendance.from_date") }} </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($section_students->from)->format('Y-m-d') ?? '' }}

                                </td>
                            </tr>
                            <tr>
                                <td class="width30">{{ __("section.to") }} </td>
                                <td>

                                    {{ \Carbon\Carbon::parse($section_students->to)->format('Y-m-d') ?? '' }}
                                </td>
                            </tr>
                            <tr>

                            </tr>
                            @foreach ($allRates as $title => $degree)
                                <tr>
                                    <td class="width30">{{ $title }}</td>
                                    <td>{{ $degree }}</td>
                                    {{-- @if ($degree < 1.5 )
                                <td>{{ __("rates.poor") }} </td>
                                @elseif ($degree < 2.5 && $degree >= 1.5)
                                <td>{{ __("rates.good") }} </td>
                                @elseif ($degree < 3.5 && $degree >= 2.5)
                                <td>{{ __("rates.very") }} </td>
                                @elseif ($degree < 4.1 && $degree >= 3.5)
                                <td>{{ __("rates.excellent") }} </td>
                                @endif --}}

                                </tr>
                            @endforeach
                            <tr>
                                <td class="width30">
                                    {{ __('rates.finalrate') }}
                                </td>
                                <td>
                                    @if ($finalRate->percentage <= 64)
                                        {{ __('rates.poor') }}
                                    @elseif ($finalRate->percentage < 75 && $finalRate->percentage >= 65)
                                        {{ __('rates.good') }}
                                    @elseif ($finalRate->percentage < 85 && $finalRate->percentage >= 75)
                                        {{ __('rates.very') }}
                                    @elseif ($finalRate->percentage <= 100 && $finalRate->percentage >= 85)
                                        {{ __('rates.excellent') }}
                                    @endif
                                </td>
                             
                                
                            </tr>


                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
