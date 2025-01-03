@extends('frontend.includes.main')

@section('contents')

<!-- subscription modal  -->
<div id="subscription">
    <div class="fadeInDown" >
        <div class="mt-4 col-8 m-auto box-shadow-color p-5 bg-white">
            <div class="title mb-5 mt-3 text-center">
                <h2 class="premium-title" id="">Choose Your Premium Plan</h2>
            </div>
            <div class="m-auto">
                <div class="d-flex premium_content">
                    <div class="col-sm-6">
                        <div>
                            <h4>Features</h4>
                        </div>
                        @foreach ($finalData['data'] as $contentFeature)
                        <div class="border-bottom" style="height: 70px;">
                            <p><strong>{{$contentFeature['title']}}</strong></p>
                            <span>{{$contentFeature['item']}}</span>
                        </div>
                        @endforeach
                    </div>
                    @foreach ($finalData['plan'] as $plan)
                    @php
                        $hightStatus=false;
                        $classAdd=null;
                    @endphp
                    @foreach ($plan['subscription'] as $checkStatus)
                        @if($checkStatus->is_suggested=='1')
                        @php
                            $hightStatus=true;
                        @endphp
                        @endif
                        @php
                            $classAdd.='planCheck'.$checkStatus->id.' ';
                        @endphp
                    @endforeach
                        <div class="col-sm-2 text-center {{$hightStatus ? 'highlight': ''}} {{$classAdd}}  sumitPlan" id="premium4K">
                            <h4>{{$plan['title']}}</h4>
                            <div>
                                @foreach ($plan['features'] as $feature)
                                    <div class="border-bottom" style="height: 70px;">
                                        @if($feature=='true')
                                         <p><i class="fa-solid fa-check"></i></p>
                                         @elseif($feature==null)
                                         <p>&nbsp;</p>
                                        @else
                                        <p>{{$feature}}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5 flex-wrap">
                    @foreach ($allSubscriptionData as $subscription)
                        <div class="premium4K position-relative p-1">
                            <div class="content__wrapper box-shadow-active" data-attributevalue="{{$subscription->id}}">
                                <h4>{{$subscription->title}}</h4>
                                <h2>{{$subscription->currency_type}} {{$subscription->price}}</h2>
                                <p>{{$subscription->period_id}}</p>
                            </div>
                            @if($subscription->is_suggested=='1')
                            <div class="suggested position-absolute">
                                <p>Suggested</p>
                            </div>
                            @else
                                <p>&nbsp;</p>
                            @endif
                            <div class="tick_on_cirlce position-absolute  {{$subscription->is_suggested=='1' ? 'active':''}} sumit{{$subscription->id}} sumitSubscription">
                                <div class="tick__circle">
                                    <p><i class="fa-solid fa-check"></i></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <form class="text-center" action="{{route('customer.addSusbcription')}}" method="post" id="buySubscription">
                @csrf
                <input type="text" name="subscription_id" value="{{@$defaultSubscription}}" id="subscription_id" hidden>
                <button type="submit" class="apply_code" style="padding: 6px 20px !important; margin: 0 !important;  margin-bottom: 10px !important; font-size: 14px !important;">Buy Subscription</button>
            </form>

            <!-- apply code modal open btn  -->
            <div class="modal-footer text-center" style="justify-content: center; margin-top: 2rem;">

                {{-- <div class="apply_code form-control cursor-pointer d-flex justify-content-between text-white align-items-center" data-bs-toggle="modal" data-bs-target="#codeModal">
                    <p style="margin: 0; cursor: pointer"><i class="fa-solid fa-gear" style="margin-right: 6px;"></i>Apply Code</p>
                    <strong class="chevron-right-icon"><i class="fas fa-chevron-right" style="color: white !important;"></i></strong>
                </div> --}}

                <div>
                    <p style="margin: 0;">4K plan is supported on 4K TVs and Connected devices only. <a href="{{route('see_terms_use')}}">See our Terms</a> of Use for more details.</p>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

<!-- apply code modal   -->
<div class="modal fade" id="codeModal" aria-hidden="true" aria-labelledby="codeModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-color">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5 text-white"><i class="fa fa-arrow-left"></i> Apply Code</h1>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body" style="height: 200px">
                <input type="text" placeholder="Enter Code" class="form-control" style="padding: 10px;">
            </div>
        </div>
    </div>
</div>

<!-- premium buy modal  -->
<div class="modal fade" id="premiumModal" aria-hidden="true" aria-labelledby="premiumModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-color p-5">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5 text-white">Continue With Email </h1>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div>
                    <input type="email" placeholder="Email ID" class="form-control" style="padding: 10px;">
                </div>
                <div class="text-white pt-4 pb-4 d-flex">
                    <input type="checkbox" style="width: 20px">
                    <label for="text" class="ms-3">By proceeding you agree to our Terms of Services & Privacy Policy.</label>
                </div>
                <div class="premium_continue_btn">
                    <button class="form-control p-3">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
