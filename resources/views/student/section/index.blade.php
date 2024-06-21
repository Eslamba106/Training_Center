@extends('layouts.dashboard.dashboard')

@section('title')
الاقسام
@endsection

@section('home_route')
    {{ route('student.dashboard') }}
@endsection

@section('logout_route')
    {{ route('student.logout') }}
@endsection
@section('page_name')
    الاقسام
@endsection

@section('content')
    

    {{-- ################################################### Show Sections ########################### --}}
    <table class="table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($sections as $item)
                <tr>
                    <td>{{ $item->name }}</td>

                    <td>
                        <a href="{{ route('student.attendance.show' , $item->id ) }}" id="add_students" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-primary" data-toggle="modal">عرض جدول الحضور والانصراف</a>
                    </td>
                    <td>
                        <a href="{{ route('student.attendance.show' , $item->id ) }}" id="add_students" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-primary" data-toggle="modal">عرض جدول التقييم</a>
                    </td>


                </tr>
            @empty
                <tr>
                    <td colspan="7">لا يوجد اقسام</td>
                </tr>
            @endforelse
            {{-- @else

    @endif --}}
        </tbody>
    </table>

    @if(Session::has('success'))
    <script>
        swal("Message" ,  "{{ Session::get('success') }}" , 'sucsess', {
            button: true,
            button: "Ok"

        })
    </script>
    @endif
@endsection