@extends('admin.app')
@section('title', 'All WebSeries')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>WebSeries List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.home') }}</li>
                        </ol>
                    </div>
                    <a href="{{route('webseries.create')}}" class="btn btn-sm btn-success ml-auto">Add Web Series</a>
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
                                <h3 class="card-title">WebSeries List</h3>
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
                                            <th>SN</th>
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Premium</th>
                                            <th>Episodes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablecontents">
                                        @foreach($tvseries as $key=>$data)
                                            <tr class="row1" data-id="{{ $data->id }}">
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    <img src="{{ $data->thumbnail }}" alt="" height="100px">
                                                </td>
                                                <td>{{ $data->title }}</td>
                                                <td>{!! Illuminate\Support\Str::limit($data->description, 20) !!}</td>
                                                <td>
                                                    <span class="badge badge-{{ $data->publication=='1' ? 'success' :'danger' }}">{{ $data->publication=='1' ? "Published" :"Un Published" }}</span>
                                                </td>
                                                <td>
                                                    @if($data->isPremium)
                                                    <a href="javascript:;" class="btn btn-sm btn-info" id="setPremiumData" data-id="{{$data->id}}" data-attributetype="3">Set Premium
                                                        <span class="badge badge-success" id="setActive{{$data->id}}">Active</span>
                                                    </a>
                                                    @else
                                                    <a href="javascript:;" class="btn btn-sm btn-info" id="setPremiumData" data-id="{{$data->id}}" data-attributetype="3">Set Premium
                                                        <span class="badge badge-danger" id="setActive{{$data->id}}">Not Set</span>
                                                    </a>
                                                    @endif
                                                   
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info" href="{{route('webseries.episodelist',$data->id)}}" title="Episode">
                                                        {{count($data->episodes)}}
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{route('webseries.edit',$data->id)}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                   
                                                    <a href="javascript:;" class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor" data-id="{{ $data->id}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url'=>route('webseries.destroy',$data->id),'class'=>'delete-form'])}}
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

    <!-- Set Primium -->
<div class="modal fade" id="setPremium" tabindex="-1" aria-labelledby="setPremiumLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="setPremiumLabel">Premium Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="premiumContentForm">
           
              
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary setPremiumContent">Save changes</button>
            </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click','.delete-visitor',function(e){

        e.preventDefault();
        let clicked=confirm('Are You Sure Want To Delete Tv Series');

        if(clicked)
        {
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
                    url: "{{ route('webseries.updatePosition') }}",
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
    @include('admin.premiumcontentjs')
@endpush
