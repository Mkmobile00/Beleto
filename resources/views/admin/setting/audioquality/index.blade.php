@extends('admin.app')
@section('title', 'Audio quality Management')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Audio quality Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.home') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add audio quality</h3>
                            </div>
                            <div class="card-body">
                                {{Form::open(['url'=>route('audio-quality.store'),'class'=>'form form-horizontal'])}}
                                <div class="row">
                                    
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="quality">Audio Quality</label>
                                        <input type="text" name="quality" id="quality" class="form-control" value="{{old('quality',@$seoSocial->quality)}}" required>
                                        @error('quality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" id="description" class="form-control" value="{{old('description',@$seoSocial->description)}}">
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            @foreach ($videoEnum as $enum)
                                                <option value="{{$enum->value}}" {{ old('status') != null || @$seoSocial->status != null ? (old('status', @$seoSocial->status) == $enum->value ? 'selected' : '') : '' }}>{{$enum->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary"><i class="fas fa-plus"></i>  Add</button>
                                    </div>
                                </div>
                                {{Form::close()}}
                                <h4 class="text-center">Default Audio quality</h4>
                                <hr>
                                {{Form::open(['url'=>route('video-quality.setDefault'),'class'=>'form form-horizontal'])}}
                                @method('post')
                                <div class="col-md-12 form-group mt-2">
                                    <label for="status_default">Default Video Quality</label>
                                    <select name="status_default" id="status_default" class="form-control" required>
                                        @foreach ($audioQualitys as $quality)
                                            <option value="{{$quality->id}}" {{ old('status_default') != null || @$quality->default != null ? (old('status_default', @$quality->default) == '1' ? 'selected' : '') : '' }}>{{$quality->quality}}</option>
                                        @endforeach
                                    </select>
                                    @error('status_default')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit"
                                        class="btn btn-primary">Save Changes</button>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Audio quality list</h3>

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
                                            <th>Quality</th>
                                            <th>Desc</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($audioQualitys as $key=>$data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ $data->quality }}</td>
                                                <td>{{ $data->description }}</td>
                                                <td>{{ $data->status->name }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{route('audio-quality.edit',$data->id)}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor" data-id="{{ $data->id}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url'=>route('audio-quality.destroy',$data->id),'class'=>'delete-form'])}}
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
        let clicked=confirm('Are You Sure Want To Delete Audio');

        if(clicked)
        {
            $(this).parent().find('form').submit();
        }
        });
    </script>
@endpush
