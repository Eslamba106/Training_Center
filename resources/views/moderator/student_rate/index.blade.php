@extends('layouts.dashboard.dashboard')

@section('title')
{{ __("rates.add_rate_to") }} {{ $student->name }}
@endsection

@section('home_route')
    {{ route('admin.dashboard') }}
@endsection

@section('logout_route')
    {{ route('admin.logout') }}
@endsection
@section('page_name')
{{ __("rates.add_rate_to") }} {{ $student->name }}

@endsection

@section('content')
    <div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __("rates.add_rate_to") }} {{ $student->name }}
                    </h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('moderator.student_rate.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="section_id" value="{{ $section->id }}">
                    @forelse ($rates as $item)
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td class="width30">{{ __("rates.the_rate") }} </td>
                                        <td>{{ $item->title ?? '#' }}</td>
                                    </tr>
                                    <tr>

                                        <td class="width30">{{ __("rates.the_rate") }} </td>

                                        <td>
                                            <?php $i = 0; ?>
                                            <input class="form-control" type="hidden" name="ids[]" value="{{ $item->id }}" >
                                            {{-- <input class="form-control" type="text" name="rate[]"> --}}
                                            <select class="form-control" name="rate[]" id="">
                                                <option value="1">{{ __("rates.poor") }} </option>
                                                <option value="2">{{ __("rates.good") }} </option>
                                                <option value="3">{{ __("rates.very") }} </option>
                                                <option value="4">{{ __("rates.excellent") }} </option>
                                            </select>
                                        </td>
                                    </tr>

           
                                </thead>
                            </table>
                        </div>
                    @empty
                    @endforelse
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ __("general.save") }} </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
        
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
