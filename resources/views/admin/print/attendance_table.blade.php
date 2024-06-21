@extends('layouts.dashboard.dashboard')

@section('title')
معاينه طباعة قائمة الحضور والغياب للطلاب
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
معاينه طباعة قائمة الحضور والغياب للطلاب
@endsection

{{-- @section('content') --}}
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection


@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">قائمة حضور وغياب قسم {{ $section->name }}</h1>
                            <div class="billed-from">
                                <h6>{{ $settings->web_name ?? "EslamSoft" }}</h6>
                                <p></p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                         
      
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">الاسم</th>
                                        <th class="tx-center">البريد الالكتروني</th>
                                        <th class="tx-right">الحالة</th>
                                        {{--  <th class="tx-right">الاجمالي</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="tx-12">{{ $student->name }}</td>
                                            <td class="tx-center">{{ $student->email }}</td>
                                            @foreach ($attendence_tables as $item)
                                            @if ($item->student_id == $student->id  && $item->attendence_status == 1)
                                                <td class="tx-center">حضور</td>
                                            @elseif ($item->student_id == $student->id  && $item->attendence_status == 0)
                                           
                                            <td class="tx-center">غياب</td>

                                            @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                  

                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

    {{-- print code js  --}}
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection
