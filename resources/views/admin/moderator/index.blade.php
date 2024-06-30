@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('general.moderators') }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __('general.moderators') }}
@endsection

@section('content')
    {{-- ############################## Create Section ################################## --}}
    <div class="m-2">
        <a href="" class="btn btn-sm btn-outline-primary mr-2" href="#" data-category_id="" data-toggle="modal"
            data-target="#category_id">{{ __("moderator.add_moderator") }}</a>
    </div>
    <div class="modal fade" id="category_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("moderator.add_moderator") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.moderator.store') }}" method="post">
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
                                <label for="">{{ __("section.section") }}</label>
                                <select class="form-control" name="section_id" id="">
                                    @forelse ($sections as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
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

    <div class="modal fade" id="edit_moderator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("moderator.edit_moderator") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                    <form action="#" method="post">
                        @method('put')
                        @csrf 

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __("general.name") }}</label>
                                <input type="hidden" name="id" id="edit_moderator_id">
                                <input id="edit_moderator_name" class="form-control" type="text" name="name">
                            </div>

                            <div class="form-group">
                                <label for="">{{ __("general.email") }}</label>
                                <input id="edit_moderator_email" class="form-control" type="email" name="email">
                            </div>

                            <div class="form-group">
                                <label for="">{{ __("section.section") }}</label>
                                <select id="edit_moderator_section_id" class="form-control" name="section_id" id="">
                                    @forelse ($sections as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">{{ __("general.password") }}</label>
                                <input id="edit_moderator_password" class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("general.cancel") }}</button>
                            <button type="submit" class="btn btn-success update_moderator">{{ __("general.save") }}</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("moderator.delete") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.moderator.delete') }}" method="post">
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
                <th>{{ __("section.section") }}</th>
                <th>{{ __("general.created_at") }}</th>
                <th>{{ __("general.operations") }}</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($moderators as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->section->name }}</td>
                    <td>{{ $item->created_at->shortAbsoluteDiffForHumans() }}</td>
                    <td>
                        <a href="" id="edit_moderator_item" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-success" data-toggle="modal"
                            data-moderator_id="{{ $item->id }}" data-target="#edit_moderator">{{ __("general.edit") }}</a>
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                            data-delete_moderator_id="{{ $item->id }}" data-target="#delete_moderator">{{ __("general.delete") }}</a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __("moderator.there_no") }}</td>
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

@section('js')
    <script>
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


        function fetchModerator() {
            $.ajax({
                type: "GET",
                url: "/admin/moderator/fetch",
                dataType: "json",
                success: function(response) {
                    // console.log(response.sections);
                    $('tbody').html(""); // Clear the tbody content

                    $.each(response.moderators, function(key, item) {
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
        $(document).on('click', '#edit_moderator_item', function(e) {
            e.preventDefault();
            var moder_id = $(this).data('moderator_id');
            $('#edit_moderator').modal('show');

            $.ajax({
                type: "GET",
                url: "/admin/moderator/edit/" + moder_id,
                success: function(response) {
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);
                    } else {
                        $('#edit_moderator_id').val(moder_id)
                        $('#edit_moderator_name').val(response.moderator.name)
                        $('#edit_moderator_email').val(response.moderator.email)
                        $('#edit_moderator_section_id').val(response.moderator.section_id)

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });

        });
        $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });

        $(document).on('click', '.update_moderator', function(e) {
            e.preventDefault();
            var moder_id = $('#edit_moderator_id').val();
            var data = {
                'name': $('#edit_moderator_name').val(),
                'email': $('#edit_moderator_email').val(),
                'section_id': $('#edit_moderator_section_id').val(),
                'password': $('#edit_moderator_password').val()
            };

            $.ajax({
                type: "PUT",
                url: "/admin/moderator/update/" + moder_id,
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
                        $('#edit_moderator').modal('hide');
                        fetchModerator();

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
