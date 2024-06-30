@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('attendance.attendance') }}
@endsection

@section('home_route')
    {{ route('student.dashboard') }}
@endsection

@section('logout_route')
    {{ route('student.logout') }}
@endsection
@section('page_name')
{{ __('attendance.attendance') }}
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('attendance.day') }}</th>
                <th>{{ __('attendance.status') }}</th>
            </tr>
        </thead>
        <tbody>
            <?php $total =0 ;?>
            @forelse ($table_attendances as $item)
                <tr>
                    <td>{{ $item->attendence_date }}</td>
                    @if($item->attendence_status == 1)
                    <?php $total++ ?>
                    <td>{{ __("attendance.presence") }}</td>
                    @elseif($item->attendence_status == 0)
                    <td>
                        {{ __("attendance.absence") }}
                        @if($item->excused == 1) 
                        {{ __("attendance.vacation") }}
                        @else
                        @endif
                    </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7">  </td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ __("moderator.count_presence_day") }}{{ $total }}
    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'sucsess', {
                button: true,
                button: "Ok"

            })
        </script>
    @endif
@endsection
