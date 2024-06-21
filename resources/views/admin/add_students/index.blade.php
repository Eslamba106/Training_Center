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
    {{-- <div class="m-2">
    <a href="" class="btn btn-sm btn-outline-primary mr-2" href="#" data-category_id="" data-toggle="modal"
        data-target="#category_id">اضافة قسم</a>
</div> --}}
    <div class="modal fade" id="add_students" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة طالب</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('admin.add_students.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">بداية من :</label>
                                <input type="hidden" name="section_id" value="{{ $section->id }}">
                                <input class="form-control" type="date" name="from">
                            </div>
                            <div class="form-group">
                                <label for="">الي :</label>
                                <input type="hidden" name="student_id_add" id="student_id_add">


                                <input class="form-control"  type="date" name="to">
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
    <table class="table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($students as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    {{-- <td>{{ $item->period }}</td> --}}
                    <td>{{ $item->created_at->shortAbsoluteDiffForHumans() }}</td>
                    <td>
                        <a href="" id="add_students" value="{{ $item->id }}"
                            data-add_student_id="{{ $item->id }}" class="btn btn-sm btn-outline-primary"
                             data-target="#add_students" data-toggle="modal">اضافة
                            </a>
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
