@extends('layouts.dashboard.dashboard')

@section('title')
    الطلاب المتخرجين من قسم : {{ $section->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    الطلاب المتخرجين من قسم : {{ $section->name }}
@endsection

@section('content')


    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> طلاب قسم : {{ $section->name }}
                    </h3>
                </div>
                <!-- /.card-header -->
                @forelse ($graduates as $item)
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="width30">اسم الطالب</td>
                                    <td>{{ $item->students->name }}</td>
                                </tr>
                                {{-- <tr>
                                    <td class="width30">بداية الدورة</td>
                                    <td>
                                        @foreach ($section_students as $section_student)
                                            <?php $from = $section_student::where('student_id', $item->id)->first(); ?>
                                        @endforeach
                                        {{ $from->from }}
                                        {{-- {{ \Carbon\Carbon::parse($from[0])->format('Y-m-d') ?? ""}} 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width30">نهاية الدورة</td>
                                    <td>
                                        @foreach ($section_students as $section_student)
                                            <?php $to = $section_student::where('student_id', $item->id)->pluck('to'); ?>
                                        @endforeach
                                        
                                        {{ \Carbon\Carbon::parse($to[0])->format('Y-m-d') ?? ""}}
                                        {{-- {{ $to ?? '' }} 
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td class="width30">تاريخ التخرج</td>
                                    <td>
                                        {{ $item->graduated_date  }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="width30"> التقييم النهائي للطالب في المجموعة {{ $section->name }}</td>
                                    <td>
                                        @if ($item->rate == 1)
                                            Poor
                                        @elseif ($item->rate > 1 && $item->rate <= 2)
                                            Good
                                        @elseif ($item->rate > 2 && $item->rate <= 3)
                                            Very Good
                                        @elseif ($item->rate > 3 && $item->rate <= 4)
                                            Excellent
                                        @endif
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
