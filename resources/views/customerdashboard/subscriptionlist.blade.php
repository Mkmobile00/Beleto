@extends('customerdashboard.main')
@section('contents')
<div class="container-fluid">

   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subscription List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Total Days</th>
                            <th>Left Days</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allSubscription as $subscription)
                        <tr>
                            <td>{{@$subscription['title']}}</td>
                            <td>{{@$subscription['total_days']}}</td>
                            <td>{{@$subscription['left_days']}}</td>
                            <td>{{@$subscription['from']}}</td>
                            <td>{{@$subscription['to']}}</td>
                        </tr>
                        @endforeach
                        
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection