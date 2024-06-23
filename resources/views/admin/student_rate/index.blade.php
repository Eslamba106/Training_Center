@extends('layouts.dashboard.dashboard')

@section('title')
    اضافة تقييم الي {{ $student->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
اضافة تقييم الي {{ $student->name }}

@endsection

@section('content')
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اضافة تقييم الي {{ $student->name }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('admin.student_rate.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="section_id" value="{{ $section->id }}">
                    @forelse ($rates as $item)
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td class="width30">التقييم</td>
                                        <td>{{ $item->title ?? '#' }}</td>
                                    </tr>
                                    <tr>

                                        <td class="width30">التقييم</td>

                                        <td>
                                            <?php $i = 0; ?>
                                            <input class="form-control" type="hidden" name="ids[]" value="{{ $item->id }}" >
                                            {{-- <input class="form-control" type="text" name="rate[]"> --}}
                                            <select class="form-control" name="rate[]" id="">
                                                <option value="1">Poor</option>
                                                <option value="2">Good</option>
                                                <option value="3">Very Good</option>
                                                <option value="4">Excellent</option>
                                            </select>
                                        </td>
                                    </tr>

                                    {{-- <tr>
                                <td class="width30">تعديل الاعدادات</td>
                                <td>
                                    <a href="{{ route('admin.settings.edit') }}">
                                        <button class="btn btn-info">
                                            تعديل الاعدادات
                                        </button>
                                    </a>
                                </td>
                            </tr> --}}
                                </thead>
                            </table>
                        </div>
                    @empty
                    @endforelse
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
