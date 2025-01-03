@extends('admin.app')
@section('title', 'All Visitors')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Watch History</h1>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Watch History List</h3>

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
                                            <th>SN</th>
                                            <th>Title</th>
                                            <th>Poster</th>
                                            <th>Video</th>
                                            <th>Watch Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($viewData as $key=>$data)

                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ @$data['title']}}</td>
                                                <td>
                                                    <img src="{{ @$data['poster'] }}" alt="" height="100px">
                                                </td>
                                                <td>
                                                    @if(@$data['video_path'])
                                                    <a href="{{ @$data['video_path'] }}" target="_blank">View</a>
                                                    @endif
                                                </td>
                                                <td>{{ @$data['date'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$viewData->links()}}
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
        let clicked=confirm('Are You Sure Want To Delete User');

        if(clicked)
        {
            $(this).parent().find('form').submit();
        }
        });
    </script>
@endpush
