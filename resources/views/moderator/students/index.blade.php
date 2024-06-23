@extends('layouts.dashboard.dashboard')

@section('title')
    الطلاب
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    الطلاب
@endsection

@section('content')

    {{-- ############################################ Delete Section ###################################### --}}





    {{-- ################################################### Show Sections ########################### --}}
    <table class="table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد الالكتروني</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($students as $item)
                <tr>
                    <td>{{ $item->student->name }}</td>
                    <td>{{ $item->student->email }}</td>
                    {{-- <td>{{ $item->student_section->name }}</td> --}}
                    {{-- <td>{{ $item->student->created_at->shortAbsoluteDiffForHumans() }}</td> --}}
                    <td>
                        <a href="" id="edit_student_item" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-success" >تخريج الطالب</a>
                    </td>
                 

                </tr>
            @empty
                <tr>
                    <td colspan="7">لا يوجد طلاب</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
