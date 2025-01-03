@extends('admin.app')
@section('title', 'Plan')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Plan</h1>
                    </div>
                   
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.home') }}</li>
                        </ol>
                    </div>
                    <a href="{{route('plan.create')}}" class="btn btn-sm btn-success ml-auto">Add Plan</a>
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
                                <h3 class="card-title">Plan List
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
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Device</th>
                                            <th>Video Quality</th>
                                            <th>Audio Quality</th>
                                            <th>Max Screen Size</th>
                                            <th>Premium Content</th>
                                            <th>Live Tv</th>
                                            <th>Add Free</th>
                                            <th>Download</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($plans as $key=>$data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ $data->title }}</td>
                                                <td>
                                                    @if(json_decode($data->device) !=null)
                                                    @foreach (json_decode($data->device) as $deviceId)
                                                    <span class="badge badge-info">{{ device($deviceId) }}</span>
                                                    @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach (json_decode($data->video_quality) as $videoQuality)
                                                    <span class="badge badge-info">{{ videoQuality($videoQuality) }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach (json_decode($data->audio_quality) as $audioQuality)
                                                    <span class="badge badge-info">{{ audioQuality($audioQuality) }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $data->screensize }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{$data->premium_content=='1' ? 'success':'danger'}}">{{ $data->premium_content=='1' ? 'Yes':'No' }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{$data->livetv=='1' ? 'success':'danger'}}">{{ $data->livetv=='1' ? 'Yes':'No'  }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{$data->addfree=='1' ? 'success':'danger'}}"> {{ $data->addfree=='1' ? 'Yes':'No'  }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{$data->download=='1' ? 'success':'danger'}}">{{ $data->download=='1' ? 'Yes':'No'  }}</span>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{route('plan.edit',$data->id)}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor" data-id="{{ $data->id}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url'=>route('plan.destroy',$data->id),'class'=>'delete-form'])}}
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
        let clicked=confirm('Are You Sure Want To Delete Plan');

        if(clicked)
        {
            $(this).parent().find('form').submit();
        }
        });
    </script>
@endpush
