@extends('admin.app')
@section('title', 'Shows List')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Shows</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.home') }}</li>
                        </ol>
                    </div>
                    <a href="{{route('shows.create')}}" class="btn btn-sm btn-success ml-auto">Create Shows</a>
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
                                <h3 class="card-title">Shows List
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
                                            <th>S.N</th>
                                            <th>Title</th>
                                            <th>Theater</th>
                                            <th>Movie</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($notifications as $key=>$data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ $data->title }}</td>
                                                <td>{{ $data->theater->title }}</td>
                                                <td>{{ $data->movie->title }}</td>
                                                <td>
                                                    <img src="{{ @$data->image }}" alt="" height="50px" width="100px">
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $data->status->value=='1' ? 'info':'danger' }}">{{ $data->status->name }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('shows.setTiming',$data->id) }}" class="btn btn-sm btn-info setTimeSlot"
                                                        data-theaterId="{{ $data->id }}">Set Theater Timing</a>
                                                    <a class="btn btn-sm btn-success" href="{{route('shows.edit',$data->id)}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor" data-id="{{ $data->id}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url'=>route('shows.destroy',$data->id),'class'=>'delete-form'])}}
                                                        @method('delete')
                                                    {{ Form::close()}}

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
@endsection

@push('scripts')
    <script>
        $(document).on('click','.delete-visitor',function(e){

        e.preventDefault();
        let clicked=confirm('Are You Sure Want To Delete Shows');

        if(clicked)
        {
            $(this).parent().find('form').submit();
        }
        });
    </script>
@endpush
