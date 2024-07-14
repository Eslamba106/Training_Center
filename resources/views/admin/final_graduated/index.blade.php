@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("graduated.graduates") }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __("graduated.graduates") }}
@endsection

@section('content')
    {{-- ############################## Create Section ################################## --}}
    <div class="m-2">
        <a href="" class="btn btn-sm btn-outline-primary mr-2" href="#" data-category_id="" data-toggle="modal"
            data-target="#category_id">{{ __("graduated.eligible") }}</a>
    </div>
    <div class="modal fade" id="category_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("graduated.eligible") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.final_graduated.store') }}" method="post">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __("general.name") }}</th>
                                    <th>{{ __("general.operations") }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $student->students->name }}</td>

                                        <td>
                                            @if (isset($student->graduated))
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input name="graduated[{{ $student->student_id }}]"
                                                        class="leading-tight" type="radio" value="presence">
                                                    <span class="text-success">{{ __("graduated.graduation") }}</span>
                                                </label>
                                            @else
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input name="graduated[{{ $student->student_id }}]"
                                                        class="leading-tight" type="radio" value="presence">
                                                    <span class="text-success">{{ __("graduated.graduation") }}</span>
                                                </label>
                                            @endif

                                            <input type="hidden" name="student_id[]" value="{{ $student->student_id }}">
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">{{ __("student.there_no_student") }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("general.cancel") }}</button>
                            <button type="submit" class="btn btn-success">{{ __("general.save") }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>







    {{-- ################################################### Show Sections ########################### --}}
    <table class="table">
        <thead>
            <tr>
                <th>{{ __("general.name") }}</th>
                <th>{{ __("rates.rate") }}</th>
                <th>{{ __("graduated.graduted_at") }}</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($seniors as $item)
                <tr>
                    <td>{{ $item->finalGraduated->name }}</td>
                    <td>
                        @if ($item->final_rate <= 50)
                        {{ __('rates.poor') }}
                    @elseif ($item->final_rate < 50 && $item->final_rate >= 70)
                        {{ __('rates.good') }}
                    @elseif ($item->final_rate < 70 && $item->final_rate > 85)
                        {{ __('rates.very') }}
                    @elseif ($item->final_rate <= 100 && $item->final_rate >= 85)
                        {{ __('rates.excellent') }}
                    @endif
                </td>
                    <td>{{ $item->created_at->shortAbsoluteDiffForHumans() }}</td>


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

@section('js')
    <script>
        $('#delete_moderator').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var delete_moderator_id = button.data('delete_moderator_id')
            var modal = $(this)
            console.log(delete_moderator_id)
            modal.find('.modal-body #delete_moderator_id').val(delete_moderator_id);
        })
    </script>
@endsection

{{-- 

                            <div class="form-group">
                                <label for="">المجموعة</label>
                                <select id="edit_student_section_id" class="form-control" name="section_id" id="">
                                    @forelse ($sections as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label>بداية من :</label>
                                <input class="form-control" id="edit_from" type="date"  name="from" data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="form-group">
                                <label>الي :</label>
                                <input class="form-control" id="edit_to" type="date"  name="to" data-date-format="yyyy-mm-dd">
                            </div>
--}}
