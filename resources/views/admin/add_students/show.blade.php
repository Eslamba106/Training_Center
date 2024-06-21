@extends('layouts.dashboard.dashboard')

@section('title')
    طلاب قسم : {{ $section->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    طلاب قسم : {{ $section->name }}
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('admin.attendance.index' , $section->id) }}" class="btn btn-sm btn-outline-primary mr-2">قائمة الحضور والغياب</a>
    {{-- <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a> --}}
</div>
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> طلاب قسم : {{ $section->name }}
                    </h3>
                </div>
                <!-- /.card-header -->
                @forelse ($students as $item)
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="width30">اسم الطالب</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <td class="width30">بداية الدورة</td>
                                    <td>
                                        @foreach ($section_students as $section_student)
                                            <?php $from = $section_student::where('student_id', $item->id)->pluck('from'); ?>
                                        @endforeach
                                        {{ $from }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width30">نهاية الدورة</td>
                                    <td>
                                        @foreach ($section_students as $section_student)
                                            <?php $to = $section_student::where('student_id', $item->id)->pluck('to'); ?>
                                        @endforeach
                                        {{ $to }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="width30">تخريج الطالب</td>
                                    <td>
                                        <a href="">
                                            <form action="{{ route('admin.student_rate' , $section->id) }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $item->id }}">
                                                {{-- <input type="text" name="section_id" value="{{ $section_id }}"> --}}
                                                <button class="btn btn-info">
                                                    تقييم الطالب
                                               </button>
                                            </form>
                                            <button class="btn btn-info">
                                                تخريج الطالب
                                           </button>
                                        </a>
                                    </td>
                                </tr>

                            </thead>
                        </table>
                    </div>
                @empty
                    لا يوجد طلاب
                @endforelse
            </div>
        </div>
    </div>
@endsection
