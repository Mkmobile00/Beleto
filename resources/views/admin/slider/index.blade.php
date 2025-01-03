@extends('admin.app')
@section('title', 'All Sliders')
@push('styles')
    <style>

    </style>
@endpush
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sliders Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.home') }}</li>
                        </ol>
                    </div>
                    <a href="{{route('slider.create')}}" class="btn btn-sm btn-success ml-auto">Add Slider</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sliders List</h3>

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

                            {{-- @dd($sessionData) --}}
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Sub Heading</th>
                                            <th>Image/Video</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Transcode</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablecontents">
                                        @foreach ($sliders as $key=>$data)
                                        {{-- @dd(@$data->time) --}}
                                            {{-- @dd(json_decode($data->first_name)) --}}
                                            <tr class="row1" data-id="{{ $data->id }}">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ @($data->title) }}</td>
                                                <td>{{ @($data->sub_title) }}</td>
                                                <td>
                                                    @if($data->type=='video')
                                                    <a href="{{$data->path}}" target="_blank">View</a>
                                                    @else
                                                    <img src="{{ $data->path }}" style="height:100px;width:100px;" alt="">
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary">{{ strtoupper($data->type) }}</span>
                                                </td>
                                                <td>
                                                    @if($data->transcodeStatus=='false' && $data->type=='video')
                                                        <span class="badge badge-danger">Pending Transcode Video First</span>
                                                    @else
                                                        <span class="badge badge-{{$data->status=='active' ? 'success':'danger'}}">{{ strtoupper($data->status) }}</span>
                                                    @endif
                                                    
                                                    
                                                </td>

                                                <td>
                                                    @if($data->transcodeStatus=='false' && $data->type=='video')
                                                        <a href="{{route('slider.transcode',$data->id)}}">
                                                            <span class="badge badge-danger }}">
                                                                Performe Transcode
                                                            </span>
                                                        </a>
                                                    @else
                                                        <span class="badge badge-success }}">
                                                            Done
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('slider.edit', $data->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                        class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-event"
                                                        data-id="{{ $data->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url' => route('slider.destroy', $data->id), 'class' => 'delete-form']) }}
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
    </div>


@endsection
@push('scripts')
    <script>
        $(document).on('click', '.delete-event', function(e) {

            e.preventDefault();
            let clicked = confirm('Are You Sure Want To Delete Slider');

            if (clicked) {
                $(this).parent().find('form').submit();
            }
        });

        $(function() {
            $("#tablecontents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {
                var order = [];
                // var token = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('tr.row1').each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });

                });
                console.log('order', order)
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{ route('slider.updatePosition') }}",
                    data: {
                        order: order,
                    },
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.msg);
                            return false;
                        }
                        toastr.success(response.msg);
                    }
                });
            }
        });
    </script>
@endpush
