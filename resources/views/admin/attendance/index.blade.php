@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('attendance.list') }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    {{ __('attendance.list') }}
@endsection

@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.dayNumber') }}" method="post" class="form-inline mb-2">
        @csrf
        <div class="form-group mx-sm-3 mb-2">
            <input type="hidden" name="section_id" value="{{ $section->id }}">
            <select class="form-control" name="day" id="">
                {{-- <option selected value="">day</option> --}}
                <option value="1">Yesterday</option>
                <option value="2">From Two Days Ago</option>
                <option value="3">From Three Days Ago</option>
            </select>
        </div>
        <button class="btn btn-success mb-2" type="submit">Search</button>
    </form>

    {{-- 
<form action="" method="post">
            <select class="form-control m-2 p-1 w-25" name="day" id="">
            <option value="1">yesterday</option>
            <option value="2">From Two Days Ago</option>
            <option value="3">From Three Days Ago</option>
        </select>
        <button class="btn btn-success " type="submit">search</button>
</form> --}}
    <h5 class="m-3" style="font-family: 'Cairo', sans-serif;color: red"> {{ __('attendance.date_day') }} :
        {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('admin.attendance.store') }}">

        @csrf
        <!--  <select class="form-control m-2 p-1 w-25" name="day" id="">
                <option selected value="">day</option>
                <option value="1">yesterday</option>
                <option value="2">From Two Days Ago</option>
                <option value="3">From Three Days Ago</option>
            </select>
            row closed -->

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>{{ __('general.name') }}</th>
                    <th>{{ __('general.email') }}</th>
                    <th>{{ __('general.operations') }}</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($students as $student)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>

                        <td>
                            @if (isset(
                                    $student->attendance()->where('attendence_date', date('Y-m-d'))->where('section_id', $section->id)->first()->student_id))
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="attendences[{{ $student->id }}]" disabled
                                        {{ $student->attendance()->first()->attendence_status == 1 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="presence">
                                    <span class="text-success">{{ __('attendance.presence') }}</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="attendences[{{ $student->id }}]" disabled
                                        {{ $student->attendance()->first()->attendence_status == 0 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="absent">
                                    <span class="text-danger">{{ __('attendance.absence') }}</span>
                                </label>
                            @else
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="presence">
                                    <span class="text-success">{{ __('attendance.presence') }}</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="absent">
                                    <span class="text-danger">{{ __('attendance.absence') }}</span>
                                </label>
                            @endif

                            <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                            <input type="hidden" name="section_id" value="{{ $section->id }}">
                        </td>
                        <td>
                            @if (isset(
                                    $student->attendance()->where('attendence_date', date('Y-m-d'))->where('section_id', $section->id)->first()->student_id))
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="excused[{{ $student->id }}]" disabled
                                        {{ $student->attendance()->first()->excused == 1 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="1">
                                    <span class="text-success">{{ __('attendance.vacation') }}</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="excused[{{ $student->id }}]" disabled
                                        {{ $student->attendance()->first()->excused == 1 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="1">
                                    <span class="text-danger">{{ __('attendance.absence_without') }}</span>
                                </label>
                            @else
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="excused[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="1">
                                    <span class="text-success">{{ __('attendance.vacation') }}</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="excused[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="1">
                                    <span class="text-danger">{{ __('attendance.absence_without') }}</span>
                                </label>
                            @endif


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">{{ __('section.therestudent') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <P class="m-2">
            <button class="btn btn-success " type="submit">{{ __('general.save') }}</button>
        </P>
    </form><br>
    {{-- {{ dd($student) }} --}}
    @if ($students != [])
        @if (isset(
                $students[0]->attendance()->where('attendence_date', date('Y-m-d'))->where('section_id', $section->id)->first()->student_id))
            <P class="m-2">
                <a href="{{ route('admin.attendance.print', $section->id) }}">
                    <button class="btn btn-success " type="submit">{{ __('attendance.print') }}</button>
                </a>
            </P>
        @endif
    @endif

@endsection

{{-- @section('js')
    <script>
        $(document).ready(function() {
            $('select[name="day"]').on('change', function() {
                var daynumber = $(this).val();
                if (daynumber) {
                    $.ajax({
                        url: "{{ URL::to('admin/daynumber') }}/" + daynumber,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // myarray = response.data;
                            // buildTable(data);
                            console.log(data[0].section);

                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

        function buildTable(data) {
            var table = document.getElementById('myTable');
            for (var i = 0; i < data.length; i++) {
                var row = `
                    <tr>
                        <td>${data[i].students_attendance.name }</td>
                        <td>${data[i].students_attendance.email }</td>

                    </tr>
                `
            }
        }
    </script>
@endsection --}}
