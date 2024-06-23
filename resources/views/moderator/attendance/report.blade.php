@extends('layouts.dashboard.dashboard')

@section('title')
    قائمة الحضور والغياب للطلاب
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
    قائمة الحضور والغياب للطلاب
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- row -->
<div >

    <div class="col-xl-12">
        <div class="card mg-b-20">


            <div class="card-header pb-0">

                <form action="/admin/search_attendance" method="POST" role="search" autocomplete="off">
                    @csrf
                    <input type="hidden" name="section_id" value="{{ $section->id }}">
                    {{-- <div class="col-lg-3">
                        <label class="rdiobox">
                            <input checked name="rdio" type="radio" value="1" id="type_div"> <span>بحث بنوع
                                الفاتورة</span></label>
                    </div> --}}


                    {{-- <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                        <label class="rdiobox"><input name="rdio" value="2" type="radio"><span>بحث برقم الفاتورة
                            </span></label>
                    </div><br><br> --}}

                    <div >


                        <div class="col-lg-3" id="start_at">
                            <label for="exampleFormControlSelect1">من تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                    name="start_at" placeholder="YYYY-MM-DD" type="date">
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-3" id="end_at">
                            <label for="exampleFormControlSelect1">الي تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" name="end_at"
                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                            </div><!-- input-group -->
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-1 col-md-1">
                            <button class="btn btn-primary ">بحث</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (isset($student_attendance) || isset($student_attendance))
                        <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">التاريخ</th>
                                    <th class="border-bottom-0">اسم الطالب</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">ملاحظات</th>

                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($student_attendance as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->section->name }} </td>
                                            <td>{{ $item->attendence_date }} </td>
                                            <td>{{ $item->students_attendance->name }} </td>
                                            @if ($item->attendence_status == 1)
                                            <td>حضور</td>
                                            @else
                                            <td>غياب</td>
                                            @endif
                                            @if ($item->attendence_status == 0 && $item->excused == 1)
                                            <td>اجازة</td>
                                            @elseif($item->attendence_status == 0 && $item->excused == 0)
                                            <td>غياب بدون عذر</td>
                                            @endif
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
@endsection
@section('js')
{{-- <script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script> --}}

<script>
// $(document).ready(function() {

//     $('#invoice_number').hide();

//     $('input[type="radio"]').click(function() {
//         if ($(this).attr('id') == 'type_div') {
//             $('#invoice_number').hide();
//             $('#type').show();
//             $('#start_at').show();
//             $('#end_at').show();
//         } else {
//             $('#invoice_number').show();
//             $('#type').hide();
//             $('#start_at').hide();
//             $('#end_at').hide();
//         }
//     });
// });

</script>
@endsection