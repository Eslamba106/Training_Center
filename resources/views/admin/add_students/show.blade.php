@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('section.section_student') }} : {{ $section->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    {{ __('section.section_student') }} : {{ $section->name }}
@endsection

@section('content')
    <div class="mb-1">
        <a href="{{ route('admin.attendance.index', $section->id) }}" class="btn btn-sm btn-outline-primary m-2">
            {{ __('attendance.list') }}
        </a>
    </div>
    <div class="mb-1">
        <a href="{{ route('admin.attendance.report', $section->id) }}"
            class="btn btn-sm btn-outline-primary m-2">{{ __('attendance.report') }}</a>
    </div>

    {{-- ######################################### Edit Section ################################## --}}

    <div class="modal fade" id="edit_student_section_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('student.edit_student') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                    <form action="#" method="post">
                        @method('put')
                        @csrf -

                        <div class="modal-body">
                            <div class="form-group">
                                {{-- <label for="">{{ __('general.name') }}</label> --}}
                                <input type="hidden" name="section_id" id="edit_section_id" value="{{ $section->id }}">
                                <input class="form-control" id="edit_name_student_id" type="hidden" value="" name="student_id">
                            </div>
                            <div class="form-group">
                                <label class="">{{ __('section.from') }}
                                </label>
                                <input id="from" class="form-control" type="date" name="from">
                            </div>
                            <div class="form-group">
                                <label class="">{{ __('section.to') }}
                                </label>
                                <input id="to" class="form-control" type="date" name="to">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('general.cancel') }}</button>
                            <button type="submit" class="btn btn-success update_student_section">{{ __('general.save') }}</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete_student_from_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('student.delete') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.student_section_delete') }}" method="post">
                        @method('delete')
                        @csrf

                        <div class="modal-body">
                            {{ __('general.are_you') }}
                            <input type="hidden" name="id" id="delete_student_from_section" value="">
                            <input type="hidden" name="section_id" value="{{ $section->id }}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('general.cancel') }}</button>
                            <button type="submit" class="btn btn-danger">{{ __('general.delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('section.section_student') }} : {{ $section->name }}
                    </h3>
                </div>
                <!-- /.card-header -->
                @forelse ($students as $item)
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="width30">{{ __('general.name') }}</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <td class="width30">{{ __('section.from') }}</td>
                                    <td>
                                        @foreach ($section_students as $section_student)
                                            <?php $from = $section_student::where('student_id', $item->id)->pluck('from'); ?>
                                        @endforeach
                                        {{ \Carbon\Carbon::parse($from[0])->format('Y-m-d') ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width30">{{ __('section.to') }}</td>
                                    <td>
                                        @foreach ($section_students as $section_student)
                                            <?php $to = $section_student::where('student_id', $item->id)->pluck('to'); ?>
                                        @endforeach
                                        {{ \Carbon\Carbon::parse($to[0])->format('Y-m-d') ?? '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="width30">{{ __('graduated.student_graduation') }}</td>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="">
                                                        <form action="{{ route('admin.student_rate', $section->id) }}"
                                                            method="GET">
                                                            @csrf
                                                            <input type="hidden" name="student_id"
                                                                value="{{ $item->id }}">
                                                            <button class="btn btn-info">
                                                                {{ __('graduated.student_graduation') }}
                                                            </button>
                                                        </form>

                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a href="{{ route('admin.student_section_edit', $item->id) }}"
                                                        id="edit_student_section_item" value="{{ $item->id }}"
                                                        class="btn btn-primary" data-toggle="modal"
                                                        data-student_section_id_edit="{{ $item->id }}"
                                                        data-target="#edit_student_section_new">
                                                        {{ __('general.edit') }}

                                                        {{-- <button class="btn btn-primary">
                                                            {{ __('general.edit') }}
                                                        </button> --}}

                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="d-inline p-2 btn btn-danger"
                                                        href="{{ route('admin.student_section_delete') }}"
                                                        data-toggle="modal" data-student_section_id="{{ $item->id }}"
                                                        data-target="#delete_student_from_section">
                                                        {{ __('general.delete') }}

                                                    </a>
                                                </div>
                                            </div>



                                    </td>
                                </tr>

                            </thead>
                        </table>
                    </div>
                @empty
                    {{ __('section.therestudent') }}
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('click', '#edit_student_section_item', function(e) {
            e.preventDefault();
            var sect_id = $(this).data('student_section_id_edit');
            $('#edit_student_section_new').modal('show');
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: "GET",
                url: "/admin/section_students/edit/" + sect_id,
                success: function(response) {
                    // console.log(response.section[0].student_id)
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);
                    } else {
                        $('#edit_section_student_item_id').val(sect_id)
                        $('#edit_name_student_id').val(response.section[0].student_id)
                        // console.log(response.section.student_id)
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });

        });


        $(document).on('click', '.update_student_section', function(e) {
            e.preventDefault();
            var sect_id = $('#edit_section_student_item_id').val();
            var data = {
                'from': $('#from').val(),
                'to': $('#to').val(),
                'section_id': $('#edit_section_id').val(),
                'student_id': $('#edit_name_student_id').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/admin/section_students/update/" + sect_id,
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status === 400) {
                        $('#update_form_errList').html("");
                        $('#update_form_errList').addClass("alert alert-danger");
                        $.each(response.error, function(key, err_values) {
                            $('#update_form_errList').append('<li>' + err_values +
                                '</li>');
                        });
                    } else if (response.status === 404) {
                        // Handle not found case
                    } else {
                        $('#edit_student_section_new').modal('hide');

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });
        });
        // });
    </script>
    <script>
        $('#delete_student_from_section').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var student_section_id = button.data('student_section_id')
            var modal = $(this)
            modal.find('.modal-body #delete_student_from_section').val(student_section_id);
        })
    </script>
@endsection
