@extends('admin.app')
@section('title', 'Featured Section')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Featured Section</h1>
                    </div>
                   
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.home') }}</li>
                        </ol>
                    </div>
                    <a href="{{route('featuredsection.create')}}" class="btn btn-sm btn-success ml-auto">Add Featured Section</a>
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
                                <h3 class="card-title">Featured Section List
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
                                            <th>Image</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablecontents">
                                        
                                        @foreach($finalData as $key=>$data)
                                            <tr class="row1" data-id="{{ $data->id }}">
                                                <td>{{$key+1}}</td>
                                                <td><img src="{{ $data->poster }}" alt="" height="100px"></td>
                                                <td>{{ $data->title }}</td>
                                                
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
                    url: "{{ route('featuredsectionitem.updatePosition') }}",
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
