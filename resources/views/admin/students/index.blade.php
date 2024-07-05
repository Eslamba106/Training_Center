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
    {{-- ############################## Create Section ################################## --}}
    <div class="m-2">
        <a href="" class="btn btn-sm btn-outline-primary mr-2" href="#" data-category_id="" data-toggle="modal"
            data-target="#category_id">{{ __("student.add_student") }}</a>
        <a href="" class="btn btn-sm btn-outline-primary mr-2" data-target="#Excel_id" data-Excel_id="" data-toggle="modal" href="#">{{ __('student.add_excel') }}</a>
    </div>

    <div class="modal fade" id="Excel_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('student.add_excel') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.student_register.import_excel') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __('general.name') }}</label>
                                <input class="form-control" type="file" name="file">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('general.cancel') }}</button>
                            <button type="submit" class="btn btn-success">{{ __('general.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="category_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("student.add_student") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.student.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __("general.name") }}</label>
                                <input class="form-control" type="text" name="name">
                            </div>

                            <div class="form-group">
                                <label for="">{{ __("general.email") }}</label>
                                <input class="form-control" type="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __("student.phone") }}</label>
                                <input class="form-control" type="text" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __("student.university") }}</label>
                                <input class="form-control" type="text" name="university_id">
                            </div>

                            <div class="form-group">
                                <label for="">{{ __("general.password") }}</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("general.cancel") }}</button>
                            <button type="submit" class="btn btn-success">{{ __("general.save") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- ######################################### Edit Section ################################## --}}

    <div class="modal fade" id="edit_student_btn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("student.edit_student") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                    <form action="#" method="post">
                        @method('put')
                        @csrf

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __("general.name") }}</label>
                                <input type="hidden" name="id" id="edit_student_id">
                                <input id="edit_student_name" class="form-control" type="text" name="name">
                            </div>

                            <div class="form-group">
                                <label for="">{{ __("general.email") }}</label>
                                <input id="edit_student_email" class="form-control" type="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __("phone") }}</label>
                                <input id="edit_student_phone" class="form-control" type="text" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __("student.university") }}</label>
                                <input id="edit_student_university_id" class="form-control" type="text" name="university_id">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __("general.password") }}</label>
                                <input id="edit_student_password" class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("general.cancel") }}</button>
                            <button type="submit" class="btn btn-success update_student">{{ __("general.save") }}</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>


    {{-- ############################################ Delete Section ###################################### --}}
    <div class="modal fade" id="delete_moderator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("student.delete") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.student.delete') }}" method="post">
                        @method('delete')
                        @csrf

                        <div class="modal-body">
                            {{ __("general.are_you") }}                            
                            <input type="hidden" name="id" id="delete_moderator_id" value="">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("general.cancel") }}</button>
                            <button type="submit" class="btn btn-danger">{{ __("general.delete") }}</button>
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
                <th>{{ __("general.email") }}</th>
                <th>{{ __("student.phone") }}</th>
                <th>{{ __("student.university") }}</th>
                <th>{{ __("general.created_at") }}</th>
                <th>{{ __("general.operations") }}</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($students as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->university_id }}</td>
                    <td>{{ $item->created_at->shortAbsoluteDiffForHumans() }}</td>
                    <td>
                        <a href="" id="edit_student_item" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-success" data-toggle="modal"
                            data-moderator_id="{{ $item->id }}" data-target="#edit_student_btn">{{ __("general.edit") }}</a>
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                            data-delete_moderator_id="{{ $item->id }}" data-target="#delete_moderator">{{ __("general.delete") }}</a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __("student.there_no_student") }}</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection

@section('js')
    <script>
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function shortAbsoluteDiffForHumans(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffInMs = now - date;
            const diffInSec = Math.floor(diffInMs / 1000);
            const diffInMin = Math.floor(diffInSec / 60);
            const diffInHours = Math.floor(diffInMin / 60);
            const diffInDays = Math.floor(diffInHours / 24);
            const diffInMonths = Math.floor(diffInDays / 30);
            const diffInYears = Math.floor(diffInDays / 365);

            if (diffInSec < 60) {
                return diffInSec + 's';
            } else if (diffInMin < 60) {
                return diffInMin + 'm';
            } else if (diffInHours < 24) {
                return diffInHours + 'h';
            } else if (diffInDays < 30) {
                return diffInDays + 'd';
            } else if (diffInMonths < 12) {
                return diffInMonths + 'mo';
            } else {
                return diffInYears + 'y';
            }
        }


        function fetchSection() {
            $.ajax({
                type: "GET",
                url: "/admin/student/fetch",
                dataType: "json",
                success: function(response) {
                    // console.log(response.sections);
                    $('tbody').html(""); // Clear the tbody content

                    $.each(response.sections, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                            <td>' + item.name + '</td>\
                                            <td>' + item.email + '</td>\
                                            <td>' + item.section.name + '</td>\
                                            <td>' + shortAbsoluteDiffForHumans(item.created_at) +
                            '</td>\
                                            <td>\
                                                <a href="#" class="btn btn-sm btn-outline-success edit_section_item" data-section_id="' +
                            item.id +
                            '" data-toggle="modal" data-target="#edit_section">تعديل</a>\
                                            </td>\
                                            <td>\
                                                <a href="#" class="btn btn-sm btn-outline-danger delete_section_item" data-section_id="' +
                            item
                            .id + '" data-toggle="modal" data-target="#delete_section">حذف</a>\
                                            </td>\
                                        </tr>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });
        }
        $(document).on('click', '#edit_student_item', function(e) {
            e.preventDefault();
            var moder_id = $(this).data('moderator_id');
            $('#edit_student_btn').modal('show');

            $.ajax({
                type: "GET",
                url: "/admin/student/edit/" + moder_id,
                success: function(response) {
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);
                    } else {
                        $('#edit_student_id').val(moder_id)
                        $('#edit_student_name').val(response.student.name)
                        $('#edit_student_email').val(response.student.email)
                        $('#edit_student_section_id').val(response.student.student_section_id)
                        $('#edit_student_phone').val(response.student.phone)
                        $('#edit_student_university_id').val(response.student.university_id)
           
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });

        });


        $(document).on('click', '.update_student', function(e) {
            e.preventDefault();
            var moder_id = $('#edit_student_id').val();
            var data = {
                'name': $('#edit_student_name').val(),
                'email': $('#edit_student_email').val(),
                'section_id': $('#edit_student_section_id').val(),
                'password': $('#edit_student_password').val(),
                'phone': $('#edit_student_phone').val(),
                'university_id': $('#edit_student_university_id').val()
            };

            $.ajax({
                type: "PUT",
                url: "/admin/student/update/" + moder_id,
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
                        $('#edit_student_btn').modal('hide');

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });
        });
    </script>
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
