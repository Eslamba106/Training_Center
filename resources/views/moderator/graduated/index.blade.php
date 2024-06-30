@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("general.students") }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __("general.students") }}
@endsection

@section('content')

    {{-- ################################################### Show Sections ########################### --}}
    <table class="table">
        <thead>
            <tr>
                <th>{{ __("general.name") }}</th>
                <th>{{ __("general.email") }}</th>
                <th>{{ __("rates.rate") }}</th>
                <th>{{ __("moderator.details") }}</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($grades as $item)
                <tr>
                    <td>{{ $item->students->name }}</td>
                    <td>{{ $item->students->email }}</td>
                    @if ($item->rate < 1.5 )
                    <td>{{ __("rates.poor") }}</td>
                    @elseif ($item->rate < 2.5 && $item->rate >= 1.5)
                    <td>{{ __("rates.good") }}</td>
                    @elseif ($item->rate < 3.5 && $item->rate >= 2.5)
                    <td>{{ __("rates.very") }}</td>
                    @elseif ($item->rate < 4.1 && $item->rate >= 3.5)
                    <td>{{ __("rates.excellent") }}</td>
                    @endif
                    
                    <td>
                        <a href="{{ route('moderator.student.show' , $item->students->id) }}" id="edit_student_item" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-success" >{{ __("moderator.details") }}</a>
                    </td>
                 

                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __("student.there_no_student") }}</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    @if (Session::has('danger'))
    <script>
        swal("Message", "{{ Session::get('danger') }}", 'warning', {
            button: true,
            button: "Ok",
            timer:3000,
            dangerMode:true
    
        })
    </script>
    @endif
    @if (Session::has('success'))
    <script>
        swal("Message", "{{ Session::get('success') }}", 'success', {
            button: true,
            button: "Ok",
            timer:3000,
            // dangerMode:true
    
        })
    </script>
    @endif
    @if (Session::has('info'))
    <script>
        swal("Message", "{{ Session::get('info') }}", 'info', {
            button: true,
            button: "Ok",
            timer:3000,
            dangerMode:true
    
        })
    </script>
    @endif
@endsection
