@extends('layouts.dashboard.dashboard')

@section('title')
    {{ __('section.add_students') }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    {{ __('section.add_students') }}
@endsection

@section('content')
    <div class="m-2">
        <a href="" class="btn btn-sm btn-outline-primary mr-2" href="#" data-category_id="" data-toggle="modal"
            data-target="#category_id">{{ __('student.add_excel') }}</a>
    </div>
    <div class="modal fade" id="category_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('student.add_excel') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.student.import_excel') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">{{ __('general.name') }}</label>
                                <input type="hidden" name="excel_section_id" value="{{ $section->id }}">
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


    <form action="{{ route('admin.add_students.store') }}" method="post">
        @csrf
        <input type="hidden" name="student_id_add" id="student_id_add">
        <input type="hidden" name="section_id" value="{{ $section->id }}">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('general.name') }}</th>
                    <th>{{ __('general.operations') }}</th>
                    <th>{{ __('section.from') }} :</th>
                    <th>{{ __('section.to') }} :</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>

                        <td>


                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="status[{{ $student->id }}]" class="leading-tight" type="radio"
                                    value="presence">
                                <span class="text-success">{{ __('general.add') }}</span>
                            </label>
                        </td>
                        <td>
                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input class="form-control" type="date" name="from[{{ $student->id }}]">
                            </label>
                        </td>
                        <td>
                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input class="form-control" type="date" name="to[{{ $student->id }}]">
                            </label>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="7">{{ __('section.therestudent') }}</td>
                    </tr>
                @endforelse
                {{-- @else

@endif --}}
            </tbody>
        </table>
        @if (count($students) !== 0)
            <P class="m-2">
                <button class="btn btn-success mr-2 " type="submit">{{ __('general.save') }}</button>
            </P>
        @endif
    </form>
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
        $('#add_students').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var add_student_id = button.data('add_student_id')
            var modal = $(this)
            modal.find('.modal-body #student_id_add').val(add_student_id);
        })
    </script>
@endsection
