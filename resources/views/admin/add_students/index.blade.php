@extends('layouts.dashboard.dashboard')

@section('title')
    اضافة طلاب الي القسم
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    اضافة طلاب الي القسم
@endsection

@section('content')
    <form action="{{ route('admin.add_students.store') }}" method="post">
        @csrf
        <input type="hidden" name="student_id_add" id="student_id_add">
        <input type="hidden" name="section_id" value="{{ $section->id }}">

        {{-- <div class="form-group">
            <input type="hidden" name="section_id" value="{{ $section->id }}">
            <label for="">بداية من :</label>
            <input class="form-control" type="date" name="from">
        </div> --}}

        {{-- <div class="form-group">
            <label for="">الي :</label>
            <input class="form-control" type="date" name="to">
            <input type="hidden" name="student_id_add" id="student_id_add">


        </div> --}}
        <table class="table">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>العمليات</th>
                    <th>بداية من :</th>
                    <th>الي :</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        {{-- @if (isset(
        $student->attendance()->where('attendence_date', date('Y-m-d'))->where('section_id', $section->id)->first()->student_id,
    ))
                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" disabled
                                    {{ $student->attendance()->first()->attendence_status == 1 ? 'checked' : '' }}
                                    class="leading-tight" type="radio" value="presence">
                                <span class="text-success">حضور</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendences[{{ $student->id }}]" disabled
                                    {{ $student->attendance()->first()->attendence_status == 0 ? 'checked' : '' }}
                                    class="leading-tight" type="radio" value="absent">
                                <span class="text-danger">غياب</span>
                            </label>
                        @else
                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                    value="presence">
                                <span class="text-success">حضور</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio"
                                    value="absent">
                                <span class="text-danger">غياب</span>
                            </label>
                        @endif --}}
                        {{-- <td>
                            <a href="" id="add_students" value="{{ $student->id }}"
                                data-add_student_id="{{ $student->id }}" class="btn btn-sm btn-outline-primary"
                                data-target="#add_students" data-toggle="modal">اضافة
                            </a>
                        </td> --}}
                        <td>
                            {{-- <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendences[{{ $student->id }}]" disabled {{ '' }}
                                    class="leading-tight" type="radio" value="presence">
                                <span class="text-success">اضافة</span>
                            </label> --}}

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="status[{{ $student->id }}]" class="leading-tight" type="radio"
                                    value="presence">
                                <span class="text-success">اضافة</span>
                            </label>
                        </td>
                        <td>
                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                {{-- <label for="">بداية من :</label> --}}
                                <input class="form-control" type="date" name="from[{{ $student->id }}]">
                            </label>
                        </td>
                        <td>
                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                {{-- <label for="">الي :</label> --}}
                                <input class="form-control" type="date" name="to[{{ $student->id }}]">
                            </label>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="7">لا يوجد طلاب خارج هذا القسم</td>
                    </tr>
                @endforelse
                {{-- @else

@endif --}}
            </tbody>
        </table>
        <P>
            <button class="btn btn-success mr-2 " type="submit">حفظ</button>
        </P>
    </form>
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
