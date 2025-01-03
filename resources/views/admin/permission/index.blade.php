@extends('admin.app')
@section('title', 'All Category')
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
                        <h1>Permissions Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Permission</li>
                        </ol>
                    </div>
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
                                <h3 class="card-title">All Permissions</h3>

                                <div class="card-tools">
                                    {{-- <a href="{{route('permission.create')}}" class="btn btn-sm btn-success">Add Permission</a> --}}
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
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $key=>$data)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $data->name }}</td>
                                                {{-- <td>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('permission.edit', $data->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                        class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-event"
                                                        data-id="{{ $data->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url' => route('permission.destroy', $data->id), 'class' => 'delete-form']) }}
                                                    @method('delete')
                                                    {{ Form::close() }}

                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$permissions->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

 

  
@endsection

@push('scripts')
    <script>
       $(document).on('click', '.delete-event', function(e) {

        e.preventDefault();
        let clicked = confirm('Are You Sure Want To Delete Category');

        if (clicked) {
            $(this).parent().find('form').submit();
        }
        });
    </script>
@endpush
