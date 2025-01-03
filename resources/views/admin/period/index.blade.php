@extends('admin.app')
@section('title', 'Period')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Period</h1>
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
                                <h3 class="card-title">Add Period</h3>
                            </div>
                            <div class="card-body">
                                {{Form::open(['url'=>route('period.store'),'class'=>'form form-horizontal'])}}
                                <div class="row">
                                    
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="value">Period</label>
                                        <input type="number" min="1" name="value" id="value" class="form-control" value="{{old('value',@$seoSocial->value)}}" required>
                                        @error('value')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="form-control" required>
                                            @foreach ($types as $enum)
                                                <option value="{{$enum->value}}" {{ old('type') != null || @$seoSocial->type != null ? (old('type', @$seoSocial->type) == $enum->value ? 'selected' : '') : '' }}>{{$enum->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary"><i class="fas fa-plus"></i>  Add</button>
                                    </div>
                                </div>
                                {{Form::close()}}
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Period list</h3>

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
                                            <th>Value</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($periods as $key=>$data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    <span class="badge badge-success">{{ $data->value }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $data->type->value=='1' ? 'info':'primary' }}">{{ $data->type->name }}</span>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{route('period.edit',$data->id)}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="javascript:;" class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor" data-id="{{ $data->id}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url'=>route('video-quality.destroy',$data->id),'class'=>'delete-form'])}}
                                                        @method('delete')
                                                    {{ Form::close()}} --}}

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
        let clicked=confirm('Are You Sure Want To Delete Video Quality');

        if(clicked)
        {
            $(this).parent().find('form').submit();
        }
        });
    </script>
@endpush
