@extends('customerdashboard.main')
@section('contents')
<div class="container-fluid">

   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payments/Statements List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Payment From</th>
                            <th>Payment Type</th>
                            <th>Invoice Num</th>
                            <th>Payment For</th>
                            <th>Payment Date</th>
                            <th>Download Invoice/th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentHistories as $payment)
                        <tr>
                            <td>{{@$payment['title']}}</td>
                            <td>{{@$payment['amount']}}</td>
                            <td>{{@$payment['operator']}}</td>
                            <td>{{@$payment['type']}}</td>
                            <td>{{@$payment['invoice_num']}}</td>
                            <td>{{@$payment['for_payment']}}</td>
                            <td>{{@$payment['date']}}</td>
                            <td>
                                <a href="{{route('downloadInvoice',$payment['invoice_num'])}}">
                                    <span class="badge badge-info">Download</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection