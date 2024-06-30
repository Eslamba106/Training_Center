@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("rates.finalrate") }}
@endsection

@section('home_route')
    {{ route('student.dashboard') }}
@endsection

@section('logout_route')
    {{ route('student.logout') }}
@endsection
@section('page_name')
{{ __("rates.finalrate") }}
@endsection

@section('content')
    <div class="container" style="display: flex; justify-content:center">

        <h1>
            مبروك تم التخرج بنجاح
        </h1>

    </div>
    <div class="container mt-3" style="display: flex; justify-content:center">

        <h2>
            {{ __("rates.finalrate") }}            
            @if ($senior->final_rate <= 1)
            {{ __("rates.poor") }}
        @elseif ($senior->final_rate > 1 && $senior->final_rate <= 2)
        {{ __("rates.good") }}
        @elseif ($senior->final_rate > 2 && $senior->final_rate <= 3)
        {{ __("rates.very") }}
        @elseif ($senior->final_rate > 3 && $senior->final_rate <= 4)
        {{ __("rates.excellent") }}
        @endif
        </h2>
    </div>
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
@endsection
