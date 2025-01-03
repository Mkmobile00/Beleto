@extends('admin.app')
@section('title', 'Customer Details')
@push('styles')
<style>
    .map-search-modal-all {
        height: 40px;
        position: absolute;
        left: 12px !important;
        top: 0;
        box-sizing: border-box;
        border: 1px solid transparent;
        width: 98%;
        margin-top: 10px;
        padding: 10px 12px;
        box-shadow: rgba(0, 0, 0, .3) 0 2px 6px;
        font-size: 16px;
        outline: none;
        text-overflow: ellipsis;
        border-radius: 3px;
        z-index: 12;
        background-color: rgb(255, 255, 255)
    }

    .search-suggestions {
        position: absolute;
        width: 95.5%;
        max-height: 150px;
        overflow-y: auto;
        background-color: #ffffffba;
        border: 1px solid #ccc;
        z-index: 1000;
        left: 26px;
        margin-top: 49px;
    }

    .suggestion {
        padding: 8px;
        cursor: pointer
    }

    .suggestion:hover {
        background-color: #f5f5f5
    }

    .locate-me-btn {
        color: #000000cf;
        font-weight: 700;
        border-color: #555;
        position: absolute;
        bottom: 17%;
        right: 6%;
        font-size: 21px;
        background: #e9ecef96;
        border-radius: 27px;
    }

 
    .box-container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
        width: 100%;
    }

    .box-wrapper {
        flex: 0 0 150px;
        height: 150px;
        position: relative;
    }

    .box-circle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        padding-top: 80%;
    }

    .circle-border {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .circle-percentage {
        position: absolute;
        top: 5px;
        left: 5px;
        text-align: center;
        width: calc(100% - 10px);
        height: calc(100% - 10px);
        border-radius: 50%;
        background-color: #fff;
    }

    .percentage {
        position: absolute;
        font-size: 20px;
        top: 50%;
        left: 0;
        width: 100%;
        transform: translateY(-50%);
        font-family: arial;
    }
</style>
@endpush
@section('main')
<div class="content-wrapper">
    {{-- @dd($customer) --}}
    {{-- @dd($customer->customerDetail) --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{@$customer->customerDetail->first_name .' ',@$customer->customerDetail->last_name}} Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{@$customer->customerDetail->photo ?? @$logo->website_logo}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{@$customer->customerDetail->first_name .' ',@$customer->customerDetail->last_name}}</h3>

                <p class="text-muted text-center">Customer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>First Name</b> <a class="float-right">{{@$customer->customerDetail->first_name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Last Name</b> <a class="float-right">{{@$customer->customerDetail->last_name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">{{@$customer->customerDetail->gender->name}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>DOB</b> <a class="float-right">{{@$customer->customerDetail->date_of_birth}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Subscription List</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Payment History</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Device List</a></li>
                  <li class="nav-item"><a class="nav-link" href="#watchhistory" data-toggle="tab">Watch History</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    
                    <!-- Post -->
                    @foreach ($allSubscription as $subscription)
                    <div class="post">
                        <div class="user-block">
                          <span class="username" style="margin-left:0px !important">
                            <a href="#">{{ $subscription['title'] }}</a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description" style="margin-left:0px !important">Subscription From/To: {{ $subscription['from'] }} /
                            {{ $subscription['to'] }}</span>
                        </div>
                        <p>Total Days: <span
                            class="badge badge-primary">{{ $subscription['total_days'] }}</span></p>
                        <p>Remaining Days: <span
                            class="badge badge-primary">{{ $subscription['left_days'] }}</span></p>
                            <div class="box-container">
                                <div class="box-wrapper">
                                    <div class="box-circle">
                                        <div class="circle-border red-background" data-color1="#eee" data-color2="#CC073C">
                                            <div class="circle-percentage">
                                                <span class="percentage" data-percentage="{{ $subscription['left_days'] }}" data-totalDays="{{$subscription['total_days']}}"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div>
                    @endforeach
                    
                    <!-- /.post -->

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Payment From</th>
                                    <th>Payment Type</th>
                                    <th>Invoice Num</th>
                                    <th>Payment For</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentHistories as $key=>$data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{ @$data['title']}}</td>
                                        <td>{{ @$data['amount'] }}</td>
                                        <td>{{ @$data['operator'] }}</td>
                                        <td>{{ @$data['type'] }}</td>
                                        <td>{{ @$data['invoice_num'] }}</td>
                                        <td>{{ @$data['for_payment'] }}</td>
                                        <td>{{ @$data['date'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="settings">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Device Type</th>
                                    <th>Device Name</th>
                                    <th>Device Serial Num</th>
                                    <th>Added Date</th>
                                    <th>Device Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deviceList as $key=>$data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{ @$data['device_type']}}</td>
                                        <td>{{ @$data['device_name'] }}</td>
                                        <td>{{ @$data['device_serial_num'] }}</td>
                                        <td>{{ @$data['added_date'] }}</td>
                                        <td>
                                          <span class="badge badge-{{@$data['deleted_at'] ? 'danger':'success'}}">{{ @$data['deleted_at'] ? 'Deleted':'Active' }}</span>
                                          @if($data['deleted_at'] ==null)
                                         

                                          <a href="javascript:;"
                                              class=" delete-visitor"
                                              data-id="{{ $data['id'] }}">
                                              <span class="badge badge-danger">Remove</span>
                                          </a>
                                          {{ Form::open(['url' => route('customer.admindeletedevicelist', $data['id']), 'class' => 'delete-form']) }}
                                          @method('delete')
                                          <input type="text" hidden name="ipaddress" value="" class="ipaddress">
                                          {{ Form::close() }}
                                          @endif
                                          
                                          
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="tab-pane" id="watchhistory">
                    <div class="card-body table-responsive p-0" id="nav-tabContent">
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
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  
@endsection

@push('scripts')
<script>
  $(document).on('click','.delete-visitor',function(e){

  e.preventDefault();
  let clicked=confirm('Are You Sure Want To Remove Device');

  if(clicked)
  {
      $(this).parent().find('form').submit();
  }
  });
</script>
<script>
         $('#image').filemanager('image');
         $(".box-circle").each(function() {
           

           let i = 0,
               that = $(this),
               circleBorder = that.find(".circle-border"),
               borderColor = circleBorder.data("color1"),
               animationColor = circleBorder.data("color2"),
               percentageText = that.find(".percentage"),
               percentage = percentageText.data("percentage"),
               total = percentageText.data("totalDays");

           circleBorder.css({
               "background-color": animationColor
           });
           percentageText.text(percentage + " Days");
           circleBorder.css('background-image', 'linear-gradient(' + total + 'deg, transparent 50%,' +
                   borderColor + ' 50%),linear-gradient(180deg, ' + borderColor + ' 50%, transparent 50%)');


           circleBorder.css('background-image', 'linear-gradient(' + percentage + 'deg, transparent 50%,' +
           animationColor + ' 50%),linear-gradient(180deg, ' + borderColor +
           ' 50%, transparent 50%)');
       });

       paginateData();

       function paginateData()
        {
            $('.page-link').click(function(event)
            {
                event.preventDefault();
                var url=$(this).attr('href');
                $.ajax({
                    url:url,
                    type:"get",
                    data:{

                    },success:function(response)
                    {
                        console.log(response);
                        $("#nav-tabContent").replaceWith(response);
                        // $('.page-link').addClass('sumitTest');
                        paginateData();
                    }
                });
            })
        }
</script>
    
@endpush
