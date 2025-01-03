@extends('admin.app')

<style>
    #datePickerModal button {
        border: none;
    }
</style>
@section('title', 'Movie Theater List')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Movie Theater</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.home') }}</li>
                        </ol>
                    </div>
                    <a href="{{ route('movietheater.create') }}" class="btn btn-sm btn-success ml-auto">Create Movie
                        Theater</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Movie Theater List
                                </h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Unique Code</th>
                                            <th>Title</th>
                                            <th>Cinema</th>
                                            <th>Cinema Branch</th>
                                            <th>City</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notifications as $key => $data)
                                            <tr>
                                                <td>{{ $data->theater_unique_id }}</td>
                                                <td>{{ $data->title }}</td>
                                                <td>{{ $data->cinemas->title }}</td>
                                                <td>{{ $data->cinemasBranch->title }}</td>
                                                <td>{{ $data->city->title }}</td>

                                                <td>
                                                    <img src="{{ @$data->image }}" alt="" height="50px"
                                                        width="100px">
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $data->status->value == '1' ? 'info' : 'danger' }}">{{ $data->status->name }}</span>
                                                </td>

                                                <td>
                                                    <a href="{{ route('theater.timmimgview',$data->id) }}" class="btn btn-sm btn-{{  count(@$data->slots) > 0 ? 'danger' : 'success' }} setTimeSlot"
                                                        data-theaterId="{{ $data->id }}"> {{  count(@$data->slots) > 0 ? 'Edit Theater Timing' : 'Set Theater Timing' }}</a>
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('movietheater.edit', $data->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                        class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor"
                                                        data-id="{{ $data->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url' => route('movietheater.destroy', $data->id), 'class' => 'delete-form']) }}
                                                    @method('delete')
                                                    {{ Form::close() }}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    {{-- modal for daterangepicker  --}}
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="datePickerModal" tabindex="-1" role="dialog" data-backdrop="static"
        aria-labelledby="datePickerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="formHtmlAppend">

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-visitor', function(e) {

            e.preventDefault();
            let clicked = confirm('Are You Sure Want To Delete Movie Theater');

            if (clicked) {
                $(this).parent().find('form').submit();
            }
        });
    </script>
@endpush
