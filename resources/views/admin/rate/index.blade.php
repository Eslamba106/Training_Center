@extends('layouts.dashboard.dashboard')

@section('title')
    التقييمات
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
التقييمات
@endsection

@section('content')
    {{-- ############################## Create Section ################################## --}}
    <div class="m-2">
        <a href="" class="btn btn-sm btn-outline-primary mr-2" href="#" data-category_id="" data-toggle="modal"
            data-target="#category_id">اضافة تقييم</a>
    </div>
    <div class="modal fade" id="category_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة تقييم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.rate.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">العنوان</label>
                                <input class="form-control" type="text" name="name">
                            </div>

                            {{-- <div class="form-group">
                                <label for="">مدة الدورة</label>
                                <input class="form-control" type="text" name="period">
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- ######################################### Edit Section ################################## --}}

    <div class="modal fade" id="edit_rate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل تقييم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                    <form action="#" method="post">
                        @method('put')
                        @csrf -

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">العنوان</label>
                                <input type="hidden" name="id" id="edit_rate_id" value="">
                                <input class="form-control" id="edit_name" type="text" name="name">
                            </div>

                            {{-- <div class="form-group">
                                <label for="">مدة الدورة</label>
                                <input class="form-control" id="edit_period" type="text" name="period">
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-success update_section">حفظ</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>


    {{-- ############################################ Delete Section ###################################### --}}
    <div class="modal fade" id="delete_rate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف تقييم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.rate.delete') }}" method="post">
                        @method('delete')
                        @csrf

                        <div class="modal-body">
                            هل انت متأكد من عملية الحذف
                            <input type="hidden" name="id" id="delete_rate" value="">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">حذف</button>
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
                <th>العنوان</th>
                {{-- <th>مدة الدورة</th> --}}
                <th>اضيفت في</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($rate as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    {{-- <td>{{ $item->period }}</td> --}}
                    <td>{{ $item->created_at->shortAbsoluteDiffForHumans() }}</td>
                    {{-- <td>
                        <a href="{{ route('admin.add_students' , $item->id ) }}" id="add_students" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-primary" data-toggle="modal">اضافة طلاب</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.add_students.show' , $item->id ) }}" id="add_students" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-primary" data-toggle="modal">عرض الطلاب</a>
                    </td> --}}
                    <td>
                        <a href="" id="edit_rate_item" value="{{ $item->id }}"
                            class="btn btn-sm btn-outline-success" data-toggle="modal"
                            data-section_id="{{ $item->id }}" data-target="#edit_rate">تعديل</a>
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                            data-section_id="{{ $item->id }}" data-target="#delete_rate">حذف</a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7">لا يوجد تقييمات</td>
                </tr>
            @endforelse
            {{-- @else

    @endif --}}
        </tbody>
    </table>
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
                                                <a href="#" class="btn btn-sm btn-outline-success edit_rate_item" data-section_id="' +
                            item.id +
                            '" data-toggle="modal" data-target="#edit_rate">تعديل</a>\
                                            </td>\
                                            <td>\
                                                <a href="#" class="btn btn-sm btn-outline-danger delete_rate_item" data-section_id="' +
                            item
                            .id + '" data-toggle="modal" data-target="#delete_rate">حذف</a>\
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
        $(document).on('click', '#edit_rate_item', function(e) {
            e.preventDefault();
            var sect_id = $(this).data('section_id');
            $('#edit_rate').modal('show');

            $.ajax({
                type: "GET",
                url: "/admin/rate/edit/" + sect_id,
                success: function(response) {
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);
                    } else {
                        $('#edit_rate_id').val(sect_id)
                        $('#edit_name').val(response.rate.title)

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });

        });


        $(document).on('click', '.update_section', function(e) {
            e.preventDefault();
            var sect_id = $('#edit_rate_id').val();
            var data = {
                'name': $('#edit_name').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/admin/rate/update/" + sect_id,
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
                        $('#edit_rate').modal('hide');
                        // fetchSection();

                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error); // Log any error
                }
            });
        });

    </script>
    <script>
        $('#delete_rate').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var section_id = button.data('section_id')
            var modal = $(this)
            modal.find('.modal-body #delete_rate').val(section_id);
        })
    </script>
@endsection