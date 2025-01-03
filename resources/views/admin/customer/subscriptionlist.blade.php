@extends('admin.app')
@section('title', 'Customer Subscription List')
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
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                    </div>
                </div>
            </section>
            <!-- Main content -->
            {{-- @dd($visitor->getTemporaryAddress->temporary_province) --}}
            <section class="content">
                <div class="row">
                    @foreach ($allSubscription as $subscription)
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>{{ $subscription['title'] }}</strong></h5>
                                    <br>
                                    <p>Total Days: <span
                                            class="badge badge-primary">{{ $subscription['total_days'] }}</span></p>
                                    <p>Remaining Days: <span
                                            class="badge badge-primary">{{ $subscription['left_days'] }}</span></p>
                                    <p>Validate (From/To): <span class="badge badge-primary">{{ $subscription['from'] }} /
                                            {{ $subscription['to'] }}</span></p>
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
                                
                            </div>
                        </div>
                    @endforeach
                    

                </div>
            </section>
        </div>

    </div>




@endsection

@push('scripts')
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
    </script>
@endpush
