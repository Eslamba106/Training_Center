@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("attendance.list") }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __("attendance.list") }}
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div>

        <div class="col-xl-12">
            <div class="card mg-b-20 ">


                <div class="card-header pb-0 bg-white">
                    <form action="/admin/search_attendance" method="POST" role="search" autocomplete="off">
                        @csrf
                        <input type="hidden" name="section_id" value="{{ $section->id }}">
                
                        <div class="row">
                            <div class="col-lg-4" id="start_at">
                                <label for="start_at">{{ __("attendance.from_date") }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                           name="start_at" placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>
                
                            <div class="col-lg-4" id="end_at">
                                <label for="end_at">{{ __("attendance.to_date") }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="end_at"
                                           value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>
                            <div class="form-group">
                                <label for="">{{ __("general.name") }}</label>
                                <select name="student_id" class="form-control" id="">
                                    <option value="">{{ __('general.all') }}</option>
                                    @foreach ($allstudents as $item)
                                        
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 align-self-end">
                                <button class="btn btn-primary mt-4 form-control" >{{ __("attendance.search") }}</button>
                            </div>
                        </div>
                    </form>
                
                    {{-- <form action="/admin/search_attendance" method="POST" role="search" autocomplete="off">
                        @csrf
                        <input type="hidden" name="section_id" value="{{ $section->id }}">
                        

                        <div>


                            <div class="col-lg-3" id="start_at">
                                <label for="exampleFormControlSelect1">{{ __("attendance.from_date") }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                        name="start_at" placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>

                            <div class="col-lg-3" id="end_at">
                                <label for="exampleFormControlSelect1">{{ __("attendance.to_date") }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" name="end_at"
                                        value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-sm-1 col-md-1">
                                <button class="btn btn-primary ">{{ __("attendance.search") }}</button>
                            </div>
                        </div>
                    </form> --}}

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($student_attendance) || isset($student_attendance))
                            <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">{{ __("section.section") }}</th>
                                        <th class="border-bottom-0">{{ __("attendance.date") }}</th>
                                        <th class="border-bottom-0">{{ __("attendance.student_name") }}</th>
                                        <th class="border-bottom-0">{{ __("attendance.status") }}</th>
                                        <th class="border-bottom-0">{{ __("attendance.notes") }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($student_attendance as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->section->name }} </td>
                                            <td>{{ $item->attendence_date }} </td>
                                            <td>{{ $item->students_attendance->name }} </td>
                                            @if ($item->attendence_status == 1)
                                                <td>{{ __("attendance.presence") }}</td>
                                            @else
                                                <td>{{ __("attendance.absence") }}</td>
                                            @endif
                                            @if ($item->attendence_status == 0 && $item->excused == 1)
                                                <td>{{ __("attendance.vacation") }}</td>
                                            @elseif($item->attendence_status == 0 && $item->excused == 0)
                                                <td>{{ __("attendance.absence_without") }}</td>
                                            @endif
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
    <!-- row closed -->
    
@endsection

