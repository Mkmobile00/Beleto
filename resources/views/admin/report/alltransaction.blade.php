@extends('admin.app')
@section('title', 'All Visitors')
@push('styles')
    <style>
        .searchfield{
            position: relative !important;
        }
        .search{
            position: absolute;
            top: 0;
            right: 7px;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
        }
        .search2{
            position: absolute;
            top: 0;
            right: -33px;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
        }
        .label{
            position: absolute;
            top: -17px;
          
        }
        .marginLfet{
            margin-left:33px;
        }
    </style>
@endpush
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TRANSACTIONS</h1>
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
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-check-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Today Collection </span>
                                <span class="info-box-number">NPR {{@$todayCollection}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">OverAll Collection </span>
                                <span class="info-box-number">NPR {{@$overAllTransaction}}</span>
                            </div>
                        </div>
                    </div>
                    @foreach ($paymentHistoryByPaymentType as $paymentData)
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-muted elevation-1"><i class="fas fa-money-check-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{$paymentData['title']}}</span>
                                    <span class="info-box-number">{{$paymentData['currency']}} {{$paymentData['amount']}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-muted elevation-1"><i class="fas fa-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Self Subscription </span>
                                <span class="info-box-number">{{@$selfData}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-muted elevation-1"><i class="fas fa-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Admin Subscription Collection </span>
                                <span class="info-box-number">{{@$adminData}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">TRANSACTIONS
                                </h3>

                                <div class="card-tools">
                                    
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        
                                        <a href="" class="btn brn-sm btn-success" title="Export">Export</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                
                                <form action="{{route('alltransaction.view')}}" id="filterform">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <select name="paymenttype" class="form-control" id="filterData">
                                                <option value="">Filter By Payment Method</option>
                                                @foreach ($paymentTypes as $type)
                                                    <option value="{{$type->value}}" {{request()->get('paymenttype')==$type->value ? 'selected':''}}>{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <input type="text" name="email_or_phone" class="form-control searchfield" value="{{request()->get('email_or_phone') }}" placeholder="Search By Phone Num OR Email...">
                                            <a type="submit" class="search"><i class="fa fa-search"></i></a>
                                        </div>
                                        <input type="text" name="per_page" value="10" id="perPageData" hidden>
                                        <div class="form-group col-md-1">
                                            <input type="text" name="invoicenum" class="form-control searchfield" value="{{request()->get('invoicenum')}}" placeholder="Payment ID">
                                            <a type="submit" class="search2"><i class="fa fa-search"></i></a>
                                        </div>

                                        <div class="form-group col-md-2 marginLfet">
                                            <label for="" class="label">From</label>
                                            <input type="date" name="from" class="form-control searchfield" value="{{request()->get('from')}}" placeholder="mm/dd/yyyy">
                                            <a type="submit" class="search2"><i class="fa fa-search"></i></a>
                                        </div>
                                        <div class="form-group col-md-2 marginLfet">
                                            <label for="" class="label">To</label>
                                            <input type="date" name="to" class="form-control searchfield" value="{{request()->get('to')}}" placeholder="mm/dd/yyyy">
                                            <a type="submit" class="search2"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                </form>
                                

                            </div>

                            <div class="card-header">
                                <div class="form-group col-md-1">
                                    <select name="per_page" class="form-control" id="per_page">
                                        <option value="10" {{request()->get('per_page')=='10' ? 'selected':''}}>10</option>
                                        <option value="20" {{request()->get('per_page')=='20' ? 'selected':''}}>20</option>
                                        <option value="50" {{request()->get('per_page')=='50' ? 'selected':''}}>50</option>
                                        <option value="100" {{request()->get('per_page')=='100' ? 'selected':''}}>100</option>
                                        <option value="500" {{request()->get('per_page')=='500' ? 'selected':''}}>500</option>
                                        <option value="All" {{request()->get('per_page')=='All' ? 'selected':''}}>All</option>
                                    </select>
                                </div>

                            </div>
                            {{-- @dd($sessionData) --}}
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>		 		
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Email/Phone</th>
                                            <th>Plan</th>
                                            <th>Payment Gateway</th>
                                            <th>Amount</th>
                                            <th>kantipur Cinemas</th>
                                            <th>Nectardigit(5%)</th>
                                            <th>Payment ID</th>
                                            <th>Payment Date</th>
                                            <th>Remarks</th>
                                            <th>Subscription From</th>
                                            <th>Download Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alltransaction as $key=>$data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{@$data['customer']}}</td>
                                                <td>{{@$data['email_phone']}}</td>
                                                <td>{{@$data['for_payment'] }}({{@$data['paidFor']}})</td>
                                                <td>{{@$data['operator'] }}</td>
                                                <td>{{@$data['amount'] }}</td>
                                                <td>{{@$data['kantipur_cinemas_commission'] }}</td>
                                                <td>{{@$data['nectar_commission'] }}</td>
                                                <td>{{@$data['invoice_num'] }}</td>
                                                <td>{{@$data['date'] }} {{@$data['final_date']}}</td>
                                                <td>{{@$data['remarks']}}</td>
                                                <td>{{@$data['payment_from']}}</td>
                                                <td>
                                                    <a href="{{route('downloadInvoice',$data['invoice_num'])}}">
                                                        <span class="badge badge-info">Download</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{@$alltransaction->links()}}
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
        $(document).on('change','#filterData',function(){
            let paymentType=$(this).val();
           $('#filterform').submit();
        });
        $(document).on('click','.search,.search2',function(){
            // let paymentType=$(this).val();
           $('#filterform').submit();
        });
        $(document).on('change','#per_page',function(){
            const perPageValue=$(this).val();
            $('#perPageData').val(perPageValue);
            $('#filterform').submit();
        });
    </script>
@endpush
