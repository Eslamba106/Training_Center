@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("rates.rates") }}
@endsection

@section('home_route')
    {{ route('student.dashboard') }}
@endsection

@section('logout_route')
    {{ route('student.logout') }}
@endsection
@section('page_name')
{{ __("rates.rates") }}
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>{{ __("section.section") }}</th>
                <th>{{ __("rates.rate") }}</th>
                <th>{{ __("rates.degree") }}</th>
            </tr>
        </thead>
        <tbody>
            <?php $total =0 ;?>
            @forelse ($allrates as $item)
                <tr>
                    <td>{{ $item->section_rate->name }}</td>
                    <td>{{ $item->rates->title }}</td>
                    <td>{{ $item->rate }}</td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="7"></td>
                </tr>
            @endforelse

        </tbody>
    </table>
    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'sucsess', {
                button: true,
                button: "Ok"

            })
        </script>
    @endif
@endsection