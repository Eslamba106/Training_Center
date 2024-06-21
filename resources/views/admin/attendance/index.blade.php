@extends('layouts.dashboard.dashboard')

@section('title')
    قائمة الحضور والغياب للطلاب
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    قائمة الحضور والغياب للطلاب
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



    <h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('admin.attendance.store') }}">

        @csrf

        <!-- row closed -->

        <table class="table">
            <thead>
                <tr>
                    <th>الاسم</th>
                    {{-- <th>مدة الدورة</th> --}}
                    <th>البريد الالكتروني</th>
                    <th>العمليات</th>
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
                                    <span class="text-success">حضور</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="attendences[{{ $student->id }}]" disabled
                                        {{ $student->attendance()->first()->attendence_status == 0 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="absent">
                                    <span class="text-danger">غياب</span>
                                </label>
                            @else
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="presence">
                                    <span class="text-success">حضور</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="absent">
                                    <span class="text-danger">غياب</span>
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
                                    <span class="text-success">اجازة</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="excused[{{ $student->id }}]" disabled
                                        {{ $student->attendance()->first()->excused == 0 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="0">
                                    <span class="text-danger">بدون عذر</span>
                                </label>
                            @else
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="excused[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="1">
                                    <span class="text-success">اجازة</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="excused[{{ $student->id }}]" class="leading-tight" type="radio"
                                        value="0">
                                    <span class="text-danger">بدون بعذر</span>
                                </label>
                            @endif


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">لا يوجد طلاب</td>
                    </tr>
                @endforelse
                {{-- @else

    @endif --}}
            </tbody>
        </table>
        <P>
            <button class="btn btn-success mr-2 " type="submit">حفظ</button>
        </P>
    </form><br>

    <P>
        <a href="{{ route('admin.attendance.print' , $section->id) }}">
            <button class="btn btn-success mr-2 " type="submit">طباعة جدول الحضور</button>
        </a>
    </P>
@endsection
