@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("section.graduated_from") }} {{ $section->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __("section.graduated_from") }} {{ $section->name }}
@endsection

@section('content')


    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __("section.section_student") }} : {{ $section->name }}
                    </h3>
                </div>
                <!-- /.card-header -->
                @forelse ($graduates as $item)
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="width30">{{ __("attendance.student_name") }}</td>
                                    <td>{{ $item->students->name }}</td>
                                </tr>
                              
                                <tr>
                                    <td class="width30">{{ __('section.graduated_date_from') }}</td>
                                    <td>
                                        {{ $item->graduated_date  }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="width30">{{ __("section.final_rates_for") }} {{ $section->name }}</td>
                                    <td>
                                        @if ($item->rate == 1)
                                        {{ __("rates.poor") }}
                                        @elseif ($item->rate > 1 && $item->rate <= 2)
                                        {{ __("rates.good") }}
                                        @elseif ($item->rate > 2 && $item->rate <= 3)
                                        {{ __("rates.very") }}
                                        @elseif ($item->rate > 3 && $item->rate <= 4)
                                        {{ __("rates.excellent") }}
                                        @endif
                                    </td>
                                </tr>

                            </thead>
                        </table>
                    </div>
                @empty
                {{ __("section.therestudent") }}
                @endforelse
            </div>
        </div>
    </div>
@endsection
