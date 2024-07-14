@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('general.students') }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    {{ __('general.students') }}
@endsection

@section('content')
    {{-- ################################################### Show Sections ########################### --}}
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('general.name') }}</th>
                <th>{{ __('general.email') }}</th>
                <th>{{ __('rates.rate') }}</th>
                <th>{{ __('moderator.details') }}</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($grades as $item)
                <tr>
                    <td>{{ $item->students->name }}</td>
                    <td>{{ $item->students->email }}</td>
                    <td>
                        @if ($item->percentage <= 50)
                            {{ __('rates.poor') }}
                        @elseif ($item->percentage < 70 && $item->percentage >= 50)
                            {{ __('rates.good') }}
                        @elseif ($item->percentage < 85 && $item->percentage >= 70)
                            {{ __('rates.very') }}
                        @elseif ($item->percentage <= 100 && $item->percentage >= 85)
                            {{ __('rates.excellent') }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('moderator.student.show', $item->students->id) }}" id="edit_student_item"
                            value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-success">{{ __('moderator.details') }}</a>
                    </td>


                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __('student.there_no_student') }}</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    @if (Session::has('danger'))
        <script>
            swal("Message", "{{ Session::get('danger') }}", 'warning', {
                button: true,
                button: "Ok",
                timer: 3000,
                dangerMode: true

            })
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
                // dangerMode:true

            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
                dangerMode: true

            })
        </script>
    @endif
@endsection
