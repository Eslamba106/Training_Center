@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('attendance.list') }}
@endsection

@section('home_route')
    {{ route('moderator.dashboard') }}
@endsection

@section('logout_route')
    {{ route('moderator.logout') }}
@endsection
@section('page_name')
    {{ __('attendance.list') }}
@endsection

@section('content')
    @if (isset(
            $students[0]->attendance()->where('attendence_date', date('Y-m-d'))->where('section_id', $section->id)->first()->student_id))
        <!-- row -->
        <P class="ml-2">
            <a href="{{ route('moderator.attendance.print', $section->id) }}">
                <button class="btn btn-success mr-2 " type="submit">{{ __('attendance.print') }}</button>
            </a>
        </P>
    @endif

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



    <h5 style="font-family: 'Cairo', sans-serif;color: red"> {{ __('attendance.date_day') }} : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('moderator.attendance.store') }}">

        @csrf

        <!-- row closed -->

        <table class="table">
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
                                        {{ $student->attendance()->first()->excused == 0 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="0">
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
                                        value="0">
                                    <span class="text-danger">{{ __('attendance.absence_without') }}</span>
                                </label>
                            @endif


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">{{ __('student.there_no_student') }}</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <P class="ml-2" >
            <button class="btn btn-success mr-2 " type="submit">{{ __('save') }}</button>
        </P>
    </form><br>


@endsection
