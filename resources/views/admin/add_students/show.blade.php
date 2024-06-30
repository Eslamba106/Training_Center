@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __("section.section_student") }} : {{ $section->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __("section.section_student") }} : {{ $section->name }}
@endsection

@section('content')
    <div class="mb-1">
        <a href="{{ route('admin.attendance.index', $section->id) }}" class="btn btn-sm btn-outline-primary m-2">
            {{ __("attendance.list") }}
        </a>
    </div>
    <div class="mb-1">
        <a href="{{ route('admin.attendance.report', $section->id) }}" class="btn btn-sm btn-outline-primary m-2">{{ __("attendance.report") }}</a>
    </div>
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __("section.section_student") }} : {{ $section->name }}
                    </h3>
                </div>
                <!-- /.card-header -->
                @forelse ($students as $item)
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="width30">{{ __("general.name") }}</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <td class="width30">{{ __("section.from") }}</td>
                                    <td>
                                        @foreach ($section_students as $section_student)
                                            <?php $from = $section_student::where('student_id', $item->id)->pluck('from'); ?>
                                        @endforeach
                                        {{ \Carbon\Carbon::parse($from[0])->format('Y-m-d') ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width30">{{ __("section.to") }}</td>
                                    <td>
                                        @foreach ($section_students as $section_student)
                                            <?php $to = $section_student::where('student_id', $item->id)->pluck('to'); ?>
                                        @endforeach
                                        {{ \Carbon\Carbon::parse($to[0])->format('Y-m-d') ?? '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="width30">{{ __("graduated.student_graduation") }}</td>
                                    <td>
                                        <a href="">
                                            <form action="{{ route('admin.student_rate', $section->id) }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $item->id }}">
                                                <button class="btn btn-info">
                                                    {{ __("graduated.student_graduation") }}
                                                </button>
                                            </form>

                                        </a>
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
