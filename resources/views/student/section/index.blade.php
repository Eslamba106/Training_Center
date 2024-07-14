@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("section.sections") }}
@endsection

@section('home_route')
    {{ route('student.dashboard') }}
@endsection

@section('logout_route')
    {{ route('student.logout') }}
@endsection
@section('page_name')
{{ __("Section.sections") }}
@endsection

@section('content')
    

    {{-- ################################################### Show Sections ########################### --}}
    <table class="table">
        <thead>
            <tr>
                <th>{{ __("general.name") }}</th>
                <th>{{ __("rates.finalrate") }}</th>
                <th>{{ __('section.from') }}</th>
                <th>{{ __('section.to') }}</th>
                <th>{{ __("general.operations") }}</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($sections as $item)
            <?php 
            // $student_section = App\Models\SectionStudent::where('section_id', $item->id)->first();
    ?>
                <tr>
                    <td>{{ $item->name }}</td>
                    <?php $user = auth()->guard('student')->user() ;
                          $finalRate = App\Models\Graduated::where('section_id' , $item->id)->where('student_id' , $user->id)->first(); 
                        //   dd($finalRate->rate); 
                        $student_section = App\Models\SectionStudent::where('section_id', $item->id)->where('student_id' , $user->id)->withTrashed()->first();
                  
                    ?>
                    <td>{{ $finalRate->rate ?? __('rates.not_yet')  }}</td>
                    <td>{{ $student_section->from ?? '' }}</td>
                    <td>{{ $student_section->to ?? "" }}</td>

                    <td>
                        <a href="{{ route('student.attendance.show' , $item->id ) }}" id="add_students" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-primary" >{{ __("attendance.attendance") }}</a>
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