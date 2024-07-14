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
<a href="{{ route('moderator.student_show') }}" value=""
class="btn btn-sm btn-outline-success m-2" >{{ __('moderator.details') }} </a>
    {{-- ################################################### Show Sections ########################### --}}
    <table class="table">
        <thead>
            <tr>
                <th>{{ __("general.name") }} </th>
                <th>{{ __("general.email") }} </th>
                <th>{{ __('section.from') }} </th>
                <th>{{ __('section.to') }} </th>
                <th>{{ __("general.operations") }} </th>
            </tr>
        </thead>
        <tbody>

            @forelse ($students as $item)
            <?php 
                    $student_section = App\Models\SectionStudent::where('student_id', $item->student->id)->first();
            ?>
                <tr>
                    <td>{{ $item->student->name }}</td>
                    <td>{{ $item->student->email }}</td>
                    <td>{{ $student_section->from }}</td>
                    <td>{{ $student_section->to }}</td>
                    <?php $date = Carbon\Carbon::now()->today(); 
                        $final_date = date("Y-m-d" ,strtotime($student_section->to)) ;
                        $today_date = date("Y-m-d" ,strtotime($date));
                        // dd($final_date == $today_date);
                    ?>
                    @if ($final_date <= $today_date)
                    <td>
                        <a href="{{ route('moderator.student.rate' , $item->student->id) }}" id="edit_student_item" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-success" >{{ __("graduated.student_graduation") }} </a>
                    </td>   
                    @endif
                    {{-- <td>
                        <a href="{{ route('moderator.student_show') }}" value=""
                            class="btn btn-sm btn-outline-success" >{{ __('section.show_students') }} </a>
                    </td>   --}}

                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __("student.there_no_student") }} </td>
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
