@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('section.section_student') }} : {{ $section->name }}
@endsection

@section('home_route')
    {{ route('moderator.dashboard') }}
@endsection

@section('logout_route')
    {{ route('moderator.logout') }}
@endsection
@section('page_name')
    {{ __('section.section_student') }} : {{ $section->name }}
@endsection

@section('content')






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
                                    <td class="width30">{{ __('student.student_presence_count') }}</td>
                                    <td>
                                        {{ $item->attendance->where('attendence_status' , 1)->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width30">{{ __('student.student_absence_count') }}</td>
                                    <td>
                                        {{ $item->attendance->where('attendence_status' , 0)->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="width30">{{ __('attendance.absence_without') }}</td>
                                    <td>
                                        
                                        {{ $item->attendance->where('excused' , 1)->count() }}
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

{{-- @section('js')
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
@endsection --}}
