@extends('layouts.dashboard.dashboard')

@section('title')
    جدول الحضور والغياب
@endsection

@section('home_route')
    {{ route('student.dashboard') }}
@endsection

@section('logout_route')
    {{ route('student.logout') }}
@endsection
@section('page_name')
    جدول الحضور والغياب
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>اليوم</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            <?php $total =0 ;?>
            @forelse ($table_attendances as $item)
                <tr>
                    <td>{{ $item->attendence_date }}</td>
                    @if($item->attendence_status == 1)
                    <?php $total++ ?>
                    <td>حضور</td>
                    @elseif($item->attendence_status == 0)
                    <td>
                        غياب
                        @if($item->excused == 1) 
                        ("اجازة")
                        @else
                        @endif
                    </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7">لا يوجد جدول</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    عدد ايام الحضور {{ $total }}
    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'sucsess', {
                button: true,
                button: "Ok"

            })
        </script>
    @endif
@endsection
