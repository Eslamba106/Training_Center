@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('section.graduated_from') }} {{ $section->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    {{ __('section.graduated_from') }} {{ $section->name }}
@endsection

@section('content')
    <div>

        <div class="col-xl-12">
            <div class="card mg-b-20">


                <div class="card-header pb-0 bg-white">
                    <form action="/admin/search_graduation" method="POST" role="search" autocomplete="off">
                        @csrf
                        <input type="hidden" name="section_id" value="{{ $section->id }}">

                        <div class="row">
                            <div class="col-lg-3" id="start_at">
                                <label for="start_at">{{ __('attendance.from_date') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}" name="start_at"
                                        placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>

                            <div class="col-lg-3" id="end_at">
                                <label for="end_at">{{ __('attendance.to_date') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="end_at" value="{{ $end_at ?? '' }}"
                                        placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>

                            <div class="col-lg-3 align-self-end ">
                                <button class="btn btn-primary form-control">{{ __('attendance.search') }}</button>
                            </div>
                        </div><br>
                    </form>
                   
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($graduates))
                            <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">{{ __('attendance.student_name') }}</th>
                                        <th class="border-bottom-0">{{ __('section.section') }}</th>
                                        <th class="border-bottom-0">{{ __('attendance.date') }}</th>
                                        <th class="border-bottom-0">{{ __('section.final_rates_for') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($graduates as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->students->name }} </td>
                                            <td>{{ $item->sections->name }} </td>
                                            <td>{{ $item->graduated_date  }}</td>
                                            <td>
                                                @if ($item->percentage <= 64)
                                                    {{ __('rates.poor') }}
                                                @elseif ($item->percentage < 75 && $item->percentage >= 65)
                                                    {{ __('rates.good') }}
                                                @elseif ($item->percentage < 85 && $item->percentage >= 75)
                                                    {{ __('rates.very') }}
                                                @elseif ($item->percentage <= 100 && $item->percentage >= 85)
                                                    {{ __('rates.excellent') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
