@extends('admin.app')
@section('title', 'All Customer')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer List</h1>
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
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3 ">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content ">
                                <span class="info-box-text">Total</span>
                                <a href="{{route('customer.list')}}">
                                    <span class="info-box-number">{{@$totalUser}}
                                        <span class="badge badge-success">Selected</span>
                                    </span>
                                    
                                </a>
                            </div>

                        </div>

                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Verified</span>
                                <a href="{{route('customer.verifiedlist')}}">
                                    <span class="info-box-number">{{@$verifiedUser}}</span>
                                </a>
                            </div>

                        </div>

                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Active</span>
                                <a href="{{route('customer.activelist')}}">
                                    <span class="info-box-number">
                                        {{ @$activeUser }}
                                    </span>
                                </a>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">InActive</span>
                                <a href="{{route('customer.inactivelist')}}">
                                    <span class="info-box-number">{{ @$inactiveUser }}</span>
                                </a>
                            </div>

                        </div>

                    </div>


                    <div class="clearfix hidden-md-up"></div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Blocked</span>
                                <a href="{{route('customer.blockedlist')}}">
                                    <span class="info-box-number">{{ @$blockedUser }}</span>
                                </a>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-light elevation-1"><i class="fas fa-box-open"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Subscription</span>
                                <a href="{{route('customer.subscriptionuserlist')}}">
                                    <span class="info-box-number">{{@$totalCustomerSubscription}}</span>
                                </a>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="row">
                    
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Customer List
                                   
                                </h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            onkeyup="searchCustomer(this)" placeholder="Search">

                                        {{-- <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                           
                            {{-- @dd($sessionData) --}}
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" id="searchCustomer">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Email/Phone</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Joined Date</th>
                                            <th>Add Subscription</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $key => $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ @$data->email }}{{ @$data->phone ? '/ ' . $data->phone : '' }}
                                                    <span class="badge badge-{{ $data->email_verified_at ? 'success':'danger' }}" title="{{ $data->email_verified_at ? 'Verified User':'UnVerified User' }}">
                                                        <i class="fas fa-{{ $data->email_verified_at ? 'check':'times' }}"></i>
                                                    </span>
                                                </td>
                                                <td>{{ @$data->customerDetail->first_name . ' ' . @$data->customerDetail->last_name }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ @$data->status->value == '1' ? 'success' : 'danger' }}">{{  @$data->status->name }}</span>
                                                </td>
                                                <td>{{ $data->created_at->formatLocalized('%d %B, %Y') }}
                                                    {{ $data->created_at->format('H:i:s A') }}</td>
                                                <td>
                                                    <a href="{{ route('setcustomercustome.susbcription', $data->id) }}">
                                                        <span class="badge badge-primary">Add
                                                            <i class="fas fa-plus"></i>
                                                        </span>

                                                    </a>
                                                    @foreach ($data->subscription as $subdata)
                                                    <a href="{{route('subscription.edit',$subdata->subscription->id)}}" target="_blank">
                                                        <span class="badge badge-info" title="{{@$subdata->subscription->title}}">
                                                            {{ substr($subdata->subscription->title, 0, 1) }}
                                                        </span>
                                                    </a>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('customer.show', $data->id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('customer.edit', $data->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                        class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor"
                                                        data-id="{{ $data->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url' => route('customer.destroy', $data->id), 'class' => 'delete-form']) }}
                                                    @method('delete')
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <tfoot class="text-right mt-2">
                                    <tr>
                                        <td colspan="9">
                                            <ul class="pagination">
                                                @foreach ($customers->links('pagination::bootstrap-4')->elements as $element)
                                                    @if (is_string($element))
                                                        <li class="page-item disabled"><span
                                                                class="page-link">{{ $element }}</span></li>
                                                    @endif

                                                    @if (is_array($element))
                                                        @foreach ($element as $page => $url)
                                                            <li
                                                                class="page-item {{ $page == $customers->currentPage() ? 'active' : '' }}">
                                                                <a class="page-link movie-type"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </tfoot>
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
        $(document).on('change','#filterData',function(){
            let paymentType=$(this).val();
           $('#filterform').submit();
        });
        $(document).on('click', '.delete-visitor', function(e) {

            e.preventDefault();
            let clicked = confirm('Are You Sure Want To Delete User');

            if (clicked) {
                $(this).parent().find('form').submit();
            }
        });

        function searchCustomer(data) {
            const searchValue = data.value;
            $.ajax({
                url: "{{ route('search.customer') }}",
                type: "get",
                data: {
                    searchValue: searchValue,
                },
                success: function(response) {
                    $('#searchCustomer').replaceWith(response);
                }
            });
        }

        $(document).on('click', '.searchDataPaginate', function() {
            event.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: "get",
                data: {

                },
                success: function(response) {
                    $('#searchCustomer').replaceWith(response);

                }
            });
        });
    </script>
@endpush
