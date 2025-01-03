@extends('frontend.includes.main')

@section('contents')


<section id="payment_method">
    <div class="container">
        <div class="payment_wrapper mt-4">
            <div class="col-8 m-auto box-shadow-color p-5"  style="background-color: #fff;">
                <div class="text-center">
                    <h2>Select Payment Method</h2>
                </div>
                <div class="payment_price box-shadow-color">
                    <div class="text-center">
                        <h4>{{@$subscription->title}}</h4>
                        <span class="footerPrice">{{@$subscription->currency_type}} {{@$subscription->price}}</span>
                        <p>{{@$subscription->period_id}}</span></p>
                    </div>
                </div>
                <form action="{{route('subscription.payment')}}" method="post">
                    @csrf
                    <input type="text" value="{{@$subscription->id}}" name="subscription_id" required hidden>
                    <div class="col-6 m-auto mt-5">
                        <div class="payment_method-items mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="radio_btn" style="margin-right: 3rem;">
                                    <input type="radio" name="payment_type" value="2" class="selectPaymentType" style="height: 1.5rem; width: 1.5rem">
                                </div>
                                <div class="payment_text">
                                    <h3>Khalti</h3>
                                    <p>Pay With Khalti</p>
                                </div>
                                <div class="payment_icon" style="width: 60px; margin-left: 5rem;">
                                    <img src="{{asset('frontend\assets\img\download (3).png')}}" alt="khalti" style="width: 60px;">
                                </div>
                            </div>
                        </div>

                        <div class="payment_method-items mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="radio_btn" style="margin-right: 3rem;" >
                                    <input type="radio" name="payment_type" value="1" class="selectPaymentType" style="height: 1.5rem; width: 1.5rem">
                                </div>
                                <div class="payment_text">
                                    <h3>Esewa</h3>
                                    <p>Pay With Esewa</p>
                                </div>
                                <div class="payment_icon" style="width: 60px; margin-left: 5rem;">
                                    <img src="{{asset('frontend\assets\img\download.png')}}" alt="khalti" style="width: 60px;">
                                </div>
                            </div>
                        </div>

                        <div class="payment_method-items mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="radio_btn" style="margin-right: 3rem;" >
                                    <input type="radio" name="payment_type" value="4" class="selectPaymentType" style="height: 1.5rem; width: 1.5rem">
                                </div>
                                <div class="payment_text">
                                    <h3>Ime Pay</h3>
                                    <p>Pay With ImePay</p>
                                </div>
                                <div class="payment_icon" style="width: 60px; margin-left: 5rem;">
                                    <img src="{{asset('frontend\assets\img\download (1).png')}}" alt="khalti" style="width: 60px;">
                                </div>
                            </div>
                        </div>

                        <div class="payment_method-items mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="radio_btn" style="margin-right: 3rem;" >
                                    <input type="radio" name="payment_type" value="6" class="selectPaymentType" style="height: 1.5rem; width: 1.5rem">
                                </div>
                                <div class="payment_text">
                                    <h3>Prabhu Pay</h3>
                                    <p>Pay With PrabhuPay</p>
                                </div>
                                <div class="payment_icon" style="width: 60px; margin-left: 5rem;">
                                    <img src="{{asset('frontend\assets\img\prabhupay.jpg')}}" alt="khalti" style="width: 60px;">
                                </div>
                            </div>
                        </div>
                        <input type="text" name="ipaddress" value="" id="ipAddress" hidden>

                        <div class="payment_method-items mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="radio_btn" style="margin-right: 3rem;" >
                                    <input type="radio" name="payment_type" value="3" class="selectPaymentType" style="height: 1.5rem; width: 1.5rem">
                                </div>
                                <div class="payment_text">
                                    <h3>Hamro Pay</h3>
                                    <p>Pay With HamroPay</p>
                                </div>
                                <div class="payment_icon" style="width: 60px; margin-left: 5rem;">
                                    <img src="{{asset('frontend\assets\img\hamro_pay_logo.jpg')}}" alt="khalti" style="width: 60px;">
                                </div>
                            </div>
                        </div>

                        <div class="payment_method-items mt-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="radio_btn" style="margin-right: 3rem;" >
                                    <input type="radio" name="payment_type" value="5" class="selectPaymentType"class="selectPaymentType"style="height: 1.5rem; width: 1.5rem">
                                </div>
                                <div class="payment_text">
                                    <h3>Paypal</h3>
                                    <p>Pay With Paypal</p>
                                </div>
                                <div class="payment_icon" style="width: 60px; margin-left: 5rem;">
                                    <img src="{{asset('frontend\assets\img\download (2).png')}}" alt="khalti" style="width: 60px;">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-5 align-items-center">
                            <div class="text-center">
                                <p style="margin: 0;  font-weight: 500;">You have to Pay</p>
                                <h4 class="footerPrice">{{@$subscription->currency_type}} {{@$subscription->price}}</h4>
                            </div>

                            <div>
                                <button href="" class="btn btn-secondary" id="paymentBtn" style="margin-left: 5rem;" hidden>Pay From <span id="textFormat"></span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
    
@endsection

@push('scripts')

<script>
    function generateUniqueId() {
// Get user agent
var userAgent = navigator.userAgent;

// Get screen dimensions
var screenWidth = window.screen.width;
var screenHeight = window.screen.height;

// Generate a unique identifier based on user agent and screen dimensions
var uniqueId = hashCode(userAgent + screenWidth + screenHeight);

return uniqueId;
}

// Function to generate a hash code from a string
function hashCode(str) {
var hash = 0, i, chr;
if (str.length === 0) return hash;
for (i = 0; i < str.length; i++) {
    chr   = str.charCodeAt(i);
    hash  = ((hash << 5) - hash) + chr;
    hash |= 0; // Convert to 32bit integer
}
return hash;
}

// Usage example
var userId = generateUniqueId();
setUniqueKey();
function setUniqueKey(){
$('#ipAddress').val(userId);
}
</script>
    <script>

        const updatePrice=(amount,to,currencyType)=>{
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                url:"{{route('fetch-currency-price')}}",
                type:"post",
                data:{
                    amount:amount,
                    to:to,
                    currency_code:currencyType
                },
                success:function(response){
                    $('.footerPrice').text(`${response.type} ${response.data}`);
                }
            });
        };
        $(document).on('click','.selectPaymentType',function(){
            const paymentType=$(this).val();
            let typeText='';
            let to='';
            let currencyType="{{@$subscription->currency_type}}";
            let amountValue="{{@$subscription->price}}" ?? 0;
            switch(paymentType){
                case '1':
                    typeText='Esewa';
                    to='npr';
                    break;
                case '2':
                    typeText='Khalti';
                    to='npr';
                    break;
                case '3':
                    typeText='Hamro Pay';
                    to='npr';
                    break;
                case '4':
                    typeText='Ime Pay';
                    to='npr';
                    break;
                case '5':
                    typeText='Paypal';
                    to='usd';
                    amountValue="{{@$foreignAmount}}";
                    break;
                case '6':
                    typeText='Prabhu Pay';
                    to='npr';
                    break;
                case '7':
                    return false;
                    typeText='Bank';
                    to='npr';
                    break;
                default:
                    return false;
            }
            
            
            updatePrice(amountValue,to,currencyType);
            $('#paymentBtn').removeAttr('hidden');
            $('#textFormat').text(typeText);
        });

        $(document).on('click','#paymentBtn',function(){
            const paymentType = $('[name="payment_type"]:checked').val();
            if(paymentType !== undefined) {
                
                return true;
            } else {
                toastr.error('Plz Select Payment Method');
                return false;
            }
        });
    </script>


@endpush