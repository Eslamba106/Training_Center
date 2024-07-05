@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('section.sections') }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    {{ __('section.sections') }}
@endsection

@section('content')
    {{-- ############################## Create Section ################################## --}}
    <div class="m-2">
        <a href="" class="btn btn-sm btn-outline-primary mr-2" href="#" data-category_id="" data-toggle="modal"
            data-target="#category_id">{{ __('section.add_section') }}</a>
    </div>
    <div class="modal fade" id="category_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('section.add_section') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.section.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __('general.name') }}</label>
                                <input class="form-control" type="text" name="name">
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



    {{-- ######################################### Edit Section ################################## --}}

    <div class="modal fade" id="edit_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('section.edit_section') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                    <form action="#" method="post">
                        @method('put')
                        @csrf -

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __('general.name') }}</label>
                                <input type="hidden" name="id" id="edit_section_id" value="">
                                <input class="form-control" id="edit_name" type="text" name="name">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('general.cancel') }}</button>
                            <button type="submit" class="btn btn-success update_section">{{ __('general.save') }}</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>


    {{-- ############################################ Delete Section ###################################### --}}
    <div class="modal fade" id="delete_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('section.delete_section') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.section.delete') }}" method="post">
                        @method('delete')
                        @csrf

                        <div class="modal-body">
                            {{ __('general.are_you') }}
                            <input type="hidden" name="id" id="delete_section" value="">

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




    {{-- ################################################### Show Sections ########################### --}}
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('general.name') }}</th>
                <th>{{ __('general.created_at') }}</th>
                <th>{{ __('general.operations') }}</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($sections as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->created_at->shortAbsoluteDiffForHumans() }}</td>

                    <td class="">
                        <a href="{{ route('admin.add_students', $item->id) }}" id="add_students"
                            value="{{ $item->id }}" class="btn btn-sm btn-outline-primary">
                            {{ __('section.add_students') }}
                        </a>
                    {{-- </td> --}}
                    {{-- <td> --}}
                        <a href="{{ route('admin.add_students.show', $item->id) }}" id="add_students"
                            value="{{ $item->id }}" class="btn btn-sm btn-outline-primary">
                            {{ __('section.show_students') }}
                        </a>
                    {{-- </td> --}}
                    {{-- <td> --}}
                        <a href="{{ route('admin.graduated', $item->id) }}" id="add_students"
                            value="{{ $item->id }}" class="btn btn-sm btn-outline-primary">
                            {{ __('section.graduate_students') }}
                        </a>
                        <a href="{{ route('admin.section_rate', $item->id) }}" id="add_students"
                            value="{{ $item->id }}" class="btn btn-sm btn-outline-info">
                            {{ __('rates.add_rate') }}
                        </a>
                    {{-- </td> --}}
                    {{-- <td> --}}
                        <a href="" id="edit_section_item" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-success" data-toggle="modal"
                            data-section_id="{{ $item->id }}"
                            data-target="#edit_section">{{ __('general.edit') }}</a>
                    {{-- </td> --}}
                    {{-- <td> --}}
                        <a href="" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                            data-section_id="{{ $item->id }}"
                            data-target="#delete_section">{{ __('general.delete') }}</a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7">{{ __('section.there') }}</td>
                </tr>
            @endforelse

        </tbody>
    </table>


    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@endsection

@section('js')
    {{-- <script>

    $(document).ready(function() {
        fetchSection();

        function fetchSection() {
            $.ajax({
                type: "GET",
                url: "/admin/section/fetch",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('tbody').html(""); // Clear the tbody content

                    $.each(response.section, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                    <td>' + item.name + '</td>\
                                    <td>' + item.period + '</td>\
                                    <td>' + item.created_at +
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
    });
</script> --}}
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

        // Example usage:
        const dateString = "2024-06-18T08:16:27.000000Z";
        console.log(shortAbsoluteDiffForHumans(dateString));

        // fetchSection();

        function fetchSection() {
            $.ajax({
                type: "GET",
                url: "/admin/section/fetch",
                dataType: "json",
                success: function(response) {
                    // console.log(response.sections);
                    $('tbody').html(""); // Clear the tbody content

                    $.each(response.sections, function(key, item) {
                        $('tbody').append(
                            '<tr>\
                                                        <td>' + item.name + '</td>\
                                                        <td>' + shortAbsoluteDiffForHumans(item.created_at) +
                            '</td>\
                                                <a href="#" class="btn btn-sm btn-outline-danger " data-section_id="' +
                            item.id +
                            '" data-toggle="modal" data-target="add_students">اضافة طلاب</a>\
                                                        </td>\
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
                                                        <td>\
                                            </tr>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });
        }
        $(document).on('click', '#edit_section_item', function(e) {
            e.preventDefault();
            var sect_id = $(this).data('section_id');
            $('#edit_section').modal('show');
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/admin/section/edit/" + sect_id,
                success: function(response) {
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);
                    } else {
                        $('#edit_section_id').val(sect_id)
                        $('#edit_name').val(response.section.name)

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });

        });


        $(document).on('click', '.update_section', function(e) {
            e.preventDefault();
            var sect_id = $('#edit_section_id').val();
            var data = {
                'name': $('#edit_name').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/admin/section/update/" + sect_id,
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
                        $('#edit_section').modal('hide');
                        fetchSection();

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });
        });
        // });

        // $(document).on('click', '.update_section', function(e) {
        //     e.preventDefault();
        //     var sect_id = $(edit_section_id).val();
        //     var data = {
        //         'name': $('#edit_name').val(),
        //         'period': $('#edit_period').val()
        //     }
        //     // $.ajaxSetup({
        //     //     headers: {
        //     //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     //     }
        //     // });
        //     var csrfToken = $('meta[name="csrf-token"]').attr('content');

        //     $.ajax({
        //         type: "PUT",
        //         url: "/admin/section/update/" + sect_id,
        //         headers: {
        //             'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
        //         },
        //         data: data,
        //         dataType: "json",
        //         success: function(response) {
        //             console.log(response);
        //         },
        //         error: function(xhr, status, error) {
        //             console.error("Error: " + error); // Log any error
        //         }
        //     });

        // });
        // $(document).on('click', '.update_section', function(e) {
        //     e.preventDefault();
        //     var sect_id = $('#edit_section_id').val(); // Corrected selector
        //     var data = {
        //         'name': $('#edit_name').val(),
        //         'period': $('#edit_period').val()
        //     };
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     var csrfToken = $('meta[name="csrf-token"]').attr('content');

        //     $.ajax({
        //         type: "PUT",
        //         url: "/admin/section/update/" + sect_id,
        //         headers: {
        //             'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
        //         },
        //         data: data,
        //         dataType: "json",
        //         success: function(response) {
        //             // if(response.status == 400){
        //             //     $('#update_form_errList').html("");
        //             //     $('#update_form_errList').addClass("alert alert-danger");
        //             //     $.each(response.error, function(key, err_values) {
        //             //         $('#update_form_errList').append('<li>'+err_values+'</li>');
        //             //     });
        //             // }else if(response.status == 404)
        //             $('#edit_section').modal('hide');

        //         },
        //         error: function(xhr, status, error) {
        //             console.error("Error: " + error); // Log any error
        //         }
        //     });
        // });
    </script>
    <script>
        $('#delete_section').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var section_id = button.data('section_id')
            var modal = $(this)
            modal.find('.modal-body #delete_section').val(section_id);
        })
    </script>
@endsection
{{-- <script>
    $(document).ready(function() {
        fetchSection()     

                function fetchSection() {

                    $.ajax({
                        type: "GET",
                        url: "/admin/section/fetch",
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            // $('tbody').html("");
                            // $.each(response.section, function(key, item) {
                            //     $('tbody').append(
                            //         '<tr>\
                            //             <td>' + item.name + '</td>\
                            //             <td>' + item.period + '</td>\
                            //             <td>' + item.created_at + '</td>\
                            //             <td> <a href="" id="edit_section_item" value="'
                            //         item.id '" \
                            //             class="btn btn-sm btn-outline-success" data-toggle="modal" \
                            //             data-section_id="'
                            //         item.id '" data-target="#edit_section">تعديل</a>\
                            //             </td>\
                            //             <td>\
                            //                 <a href="" class="btn btn-sm btn-outline-danger" data-toggle="modal"\
                            //                     data-section_id="'
                            //         item.id '" data-target="#delete_section">حذف</a>\
                            //             </td>\
                            //             </tr>'
                            //     )
                            // })
                        }
                    })
                }
            }
</script> 



                        $('#edit_period').val(response.section.period)
                                        'period': $('#edit_period').val()



--}}
