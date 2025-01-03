<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Currency;
use Illuminate\Support\Str;
use Mockery\Matcher\Subset;
use App\Models\CurrencyRate;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Enum\PaymentTypeEnum;
use App\Models\CustomerDetail;
use App\Models\PremiumContent;
use Illuminate\Support\Carbon;
use App\Enum\Device\DeviceEnum;
use App\Enum\PaymentStatusEnum;
use Illuminate\Validation\Rule;
use App\Http\Traits\GenerateOtp;
use App\Models\Customer\Customer;
use App\Mail\ResetPasswordOtpMail;
use Illuminate\Support\Facades\DB;
use App\Enum\Customer\MovieTypeEnum;
use App\Models\Api\CustomerWishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Api\CustomerDeviceList;
use App\Actions\Customer\PaymentAction;
use App\Models\CustomerDefaultCurrency;
use Illuminate\Support\Facades\Session;
use App\Enum\Customer\CustomerStatusEnum;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CustomerLoginRequest;
use App\Mail\Customer\CustomerRegisterMail;
use App\Actions\Customer\LoginRegisterAction;
use App\Http\Requests\CustomerRegisterRequest;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Actions\Api\CustomerDeviceAction\CustomerAddDevice;
use App\Actions\Payment\PremiumPayment\PremiumPaymentAction;
use App\Actions\Api\CustomerDeviceAction\CustomerDeviceCheck;
use Jenssegers\Agent\Agent;
class CustomerAuthController extends Controller
{
    use GenerateOtp;
    protected $customerDefaultCurrency;
    protected $customer;
    protected $customerWishList;
    protected $customerDetail;
    public function __construct(CustomerDefaultCurrency $customerDefaultCurrency, Customer $customer,CustomerWishList $customerWishList,CustomerDetail $customerDetail)
    {
        $this->customer = $customer;
        $this->customerDefaultCurrency = $customerDefaultCurrency;
        $this->customerWishList = $customerWishList;
        $this->customerDetail=$customerDetail;
    }
    public function getLoginPage()
    {
       
        $customer = Auth::guard('customer')->user();
        if ($customer) {
            return redirect()->route('home');
        }
        return view('frontend.customer.auth.loginpage');
    }

    public function getRegisterPage()
    {
        return view('frontend.customer.auth.registerpage');
    }

    public function loginResponse(Request $request)
    {
        
        $deviceData=userAgentData();
        $request['platform']=$deviceData['platform'];
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|integer|digits:10',
            'email_or_phone' => 'required|in:0,1',
            'country_code' => 'nullable|string',
            'platform'=>'required|string'
        ]);
        if ($validator->fails()) {
            $response = [
                'validation' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $request['platform'] = 'Web';
        if (!$request->email && !$request->phone) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Email Or Phone Required...'
            ];
            return response()->json($response, 200);
        }

        DB::beginTransaction();
        try {
            $data = (new LoginRegisterAction($request, $this->customer))->toResponse();
            DB::commit();
            $checkData = [
                'email' => $request->email,
                'phone' => $request->phone,
                'email_or_phone' => $request->email_or_phone
            ];
            $request->session()->put('loginCheckData', null);
            $request->session()->put('loginCheckData', $checkData);
            $response = [
                'error' => false,
                'data' => $data->email ?? $data->phone,
                'type' => $request->email_or_phone,
                'msg' => 'Otp Send Successfully !!'
            ];
            return view('frontend.customer.auth.otpverification');
        } catch (\Throwable $th) {
            DB::rollback();
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }

    public function registerNewUser(CustomerRegisterRequest $request)
    {
       
        $deviceData=userAgentData();
        $request['platform']=$deviceData['platform'];
        DB::beginTransaction();
        try {
            $existUser=Customer::where('email',$request->email)->first();
            if($existUser){
                $request->session()->flash('error','User Already Exists Plz Login');
                return redirect()->route('customer.login');
            }
            
            $data=[
                'name'=>null,
                'email'=>$request->email,
                'verify_otp'=>$this->generateOtp(),
                'email_or_phone'=>'1',
                'status'=>CustomerStatusEnum::ACTIVE->value,
                'country_code'=> null,
                'password'=>bcrypt($request->password),
                'platform'=>$request->platform,
                'verified_from'=>'Web'
            ];
            $this->customer->fill($data);
            $this->customer->save();
            $temp=[];
            $temp=[
                'customer_id'=>$this->customer->id,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name
            ];
            $this->customerDetail->insert($temp);
            Mail::to($this->customer->email)->send(new CustomerRegisterMail($this->customer));
            session()->put('customer_otp_form', null);
            session()->put('customer_otp_form', $this->customer->verify_otp);
            DB::commit();
            $request->session()->flash('success','Otp Has been sent to your mail plz verify....');
            return redirect()->route('customer.customerotp');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function verifyCustomerOtp(Request $request){
        $otp_form = $request->session()->get('customer_otp_form');
        if ($otp_form != null) {
            return view('frontend.customer.auth.otpverification');
        } else {
            return redirect('/');
        }
    }

    public function customerNewLogin(CustomerLoginRequest $request){
        // dd($request->all(),$_SERVER);
        $computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'];
        //    dd($computerId);
            //echo "<pre>$output</pre>"
        $check = Customer::where('email', $request->email)->first();
        if ($check == null) {
            session()->flash('error','Your Password is Wrong, Please try again.');
            return back();
        }
        if($check->status->value=='2' || $check->status->value=='3'){
            $status=$check->status->value=='2' ? 'Inactive':'Blocked';
            session()->flash('error',"Sorry Your Account Has Been ${status} Plz Contact Kantipur Cinemas.");
            return back();
        }
        if($check->from_old){
            $reset_otp=$this->generateOtp();
            Mail::to($check->email)->send(new ResetPasswordOtpMail($check,$reset_otp));
            $check->reset_otp=$reset_otp;
            $check->save();
            $email=$check->email;
            $request->session()->flash('error','Reset Your New Password Otp has been sent to your mail!!');
            return view('frontend.customer.auth.redirectresetpassword',compact('email'));
        }
        $deviceData=userAgentData();
        $agent = new Agent();
        $device =$agent->browser();;
        $request['device_type'] = '3';
        $request['device_name'] = ($device.'('.$deviceData['device'].')') ?? $deviceData['device'];
        // $request['device_serial_num'] = $computerId $request->ipaddress;
        $request['device_serial_num'] = $computerId;
        $subscriptionStatus = (new CustomerDeviceCheck($request, $check))->checkSubscription();
        if($check->manual_subscription){
            $deviceList=$check->deviceList;
            foreach($deviceList as $list){
                $list->delete();
            }
            if ($subscriptionStatus) {
                $alreadyAddedToList = CustomerDeviceList::where('customer_id',$check->id)->where('device_serial_num', $request->device_serial_num)->withTrashed()->first();
                if (!$alreadyAddedToList) {
                    $setDeviceStatus = (new CustomerAddDevice($check))->setDeviceList($request);
                    if (!$setDeviceStatus) {
                        session()->flash('error','Device Limit Is Full Please Logout From Another Device To Login This Device !!');
                        return back();
                    }
                }else{
                    $alreadyAddedToList->deleted_at=null;
                    $alreadyAddedToList->save();
                }
            } else {
                (new CustomerAddDevice($check))->setDeviceList($request);
            }
            $check->manual_subscription='0';
            $check->save();
        }else{
            if((new CustomerAddDevice($check))->setDeviceList($request)){
                if ($subscriptionStatus) {
                    $alreadyAddedToList = CustomerDeviceList::where('customer_id',$check->id)->where('device_serial_num', $request->device_serial_num)->withTrashed()->first();
                    if(!$alreadyAddedToList){
                        $setDeviceStatus=(new CustomerAddDevice($check))->setDeviceList($request);
                        if(!$setDeviceStatus){
                            session()->flash('error','Device Limit Is Full Please Logout From Another Device To Login On This Device !!');
                            return back();
                        }
                    }else{
                        $alreadyAddedToList->deleted_at=null;
                        $alreadyAddedToList->save();
                        if(!$alreadyAddedToList)
                        {
                            $setDeviceStatus=(new CustomerAddDevice($check))->setDeviceList($request);
                            if(!$setDeviceStatus){
                                session()->flash('error','Device Limit Is Full Please Logout From Another Device To Login On This Device !!');
                                return back();
                            }
                        }
                        
                    }
                } else {
                    (new CustomerAddDevice($check))->setDeviceList($request);
                }
            }else{
                $alreadyAddedToList = CustomerDeviceList::where('customer_id',$check->id)->where('device_serial_num', $request->device_serial_num)->first();
                if(!$alreadyAddedToList){
                    session()->flash('error','Device Limit Is Full Please Logout From Another Device To Login On This Device !!');
                    return back();
                }
                
            }
           
        }
        if ($check->email_verified_at == null) {
            $this->showOTPFormData($request->email);
            session()->put('customer_otp_form', 'show');
            return redirect()->route('customer.customerotp')->with('error', 'Please verify your account before login');
        } else            
        if (Auth::guard('customer')->attempt(['email' => $check->email, 'password' => $request->password], $request->remember)) {
            session()->flash('success','Login Successfull.');
            return redirect()->route('home');
        } else {
            session()->flash('error','Your Password is Wrong, Please try again.');
            return back();
        }
    }

    public function showOTPFormData($email_or_phone)
    {
        $customer = Customer::where('email', $email_or_phone)->first();
        if ($customer != null) {
            $customer->verify_otp = rand(100000, 999999);
            $message = "Your OTP for " . config('app.name') . " Customer Registration is :" . $customer->verify_otp;
            Mail::to($customer->email)->send(new CustomerRegisterMail($customer));
            $customer->save();
        } else {
            return back()->with('error', 'Your email is not matched with Our Record.');
        }
    }
    

    public function verifyOtp(Request $request)
    {
        $sessionValue = $request->session()->get('loginCheckData');
        if (!$sessionValue) {
            $response = [
                'sessionData' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
        $deviceData=userAgentData();
        $request['email_or_phone'] = $sessionValue['phone'] ?? $sessionValue['email'];
        $request['otp'] = $request->otpValue;
        $request['status'] = $sessionValue['email_or_phone'];
        $request['device_type'] = '3';
        $request['device_name'] = $deviceData['device'];
        $request['device_serial_num'] = $deviceData['mac_address'];
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
            'otp' => 'required|string',
            'status' => 'required|in:0,1',
            'device_type' => ['required', Rule::in(DeviceEnum::MOBILE, DeviceEnum::TV, DeviceEnum::BROWSER)],
            'device_name' => 'required|string',
            'device_serial_num' => 'required|string'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        try {
            $status = (int)$request->status;
            if ($status == 0) {
                $customer = Customer::where('phone', $request->email_or_phone)->withTrashed()->first();
            } else {
                $customer = Customer::where('email', $request->email_or_phone)->withTrashed()->first();
            }
            $otp = $request->otpValue;
            $otpCustomer = Customer::where('verify_otp', $otp)->withTrashed()->first();
            if (!$customer) {
                $response = [
                    'error' => true,
                    'data' => null,
                    'msg' => 'Sorry !! These Credential Doesnot Match Our Records'
                ];
                return response()->json($response, 200);
            }
            if (!$otpCustomer) {
                $response = [
                    'error' => true,
                    'data' => null,
                    'msg' => 'Sorry !! Invalid Otp'
                ];
                return response()->json($response, 200);
            }
            if ($customer->verify_otp != $otp) {
                $response = [
                    'error' => true,
                    'data' => null,
                    'msg' => 'Sorry !! Invalid Otp'
                ];
                return response()->json($response, 200);
            }

            $user = new Customer();
            $subscriptionStatus = (new CustomerDeviceCheck($request, $customer))->checkSubscription();

            if ($subscriptionStatus) {
                $alreadyAddedToList = CustomerDeviceList::where('device_serial_num', $request->device_serial_num)->first();
                if (!$alreadyAddedToList) {
                    $setDeviceStatus = (new CustomerAddDevice($customer))->setDeviceList($request);
                    if (!$setDeviceStatus) {
                        return $this->responseApiError('Device Limit Is Full Plz Logout From Another Device To Login This Device !!', null, 200);
                    }
                }
            } else {
                (new CustomerAddDevice($customer))->setDeviceList($request);
            }
            $customer->deleted_at = null;
            $customer->save();
            if ($customer->email_or_phone == '0') {
                if (Auth::guard('customer')->attempt(['phone' => $customer->phone, 'password' => $customer->phone])) {
                    $user = Auth::guard('customer')->user();
                } else {
                    $response = [
                        'error' => true,
                        'data' => null,
                        'msg' => 'Something Went Wrong !!'
                    ];
                    return response()->json($response, 200);
                }
            } else {
                if (Auth::guard('customer')->attempt(['email' => $customer->email, 'password' => $customer->email])) {
                    $user = Auth::guard('customer')->user();
                } else {
                    $response = [
                        'error' => true,
                        'data' => null,
                        'msg' => 'Something Went Wrong !!'
                    ];
                    return response()->json($response, 200);
                }
            }
            // $registerStaus = true;
            // $customerDetails = $user->customerDetail;
            // if (!$customerDetails) {
            //     $registerStaus = false;
            // }
            // $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $response = [
                'error' => false,
                // 'data' => $success,
                // 'register' => $registerStaus,
                // 'path'=>route('customer.dashboard'),
                'path' => route('home'),
                'msg' => 'Login Successfull !'
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function addSusbcription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id'
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'Something Went Wrong !!');
            return back()->withInput();
        }
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            session()->flash('error', 'Plz Login First !!');
            return redirect()->route('customer.login');
        }
        try {
            $finalAmount=0;
            $currencyRate = 1;
            $convertPrice=1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
            $subscription = Subscription::where('id', $request->subscription_id)->first();
            $subscription->period_id = $subscription->period->value . '(' . $subscription->period->type->name . ')';
            $customerCurrencyType = 'NPR';
            $currencyRate = 1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
            $foreignAmount=0;
            if ($customer->cutomerDefaultCurrency) {
                // dd('ok');
                $currencyRateData = $customer->cutomerDefaultCurrency->currency;
                $customerCurrencyType = $currencyRateData->code;
                $currencyRate = ((float)$currencyRateData->rate / (float)$currencyRateData->unit);
                $subscription->currency_type = $customerCurrencyType;
                $subscription->price = round(($subscription->price * $usdCurrencyPrice) / $currencyRate, 4);
                $foreignAmount=$subscription->price;
            } else {
                $convertPrice=100;
                $subscription->currency_type = $customerCurrencyType ?? "NPR";
                // dd($subscription);
                $foreignAmount = round(($subscription->price * $usdCurrencyPrice) / $currencyRate, 4);
                $subscription->price=round(($subscription->price * $convertPrice),4);
                // dd($subscription);
            }
            // dd($currencyRate);
            if (!$subscription) {
                throw new Exception();
            }
            return view('frontend.payment', compact('subscription','foreignAmount'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Something Went Wrong !!');
            return back()->withInput();
        }
    }

    public function susbcriptionPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
            'ipaddress'=>'required|string',
            'payment_type' => ['required', Rule::in(PaymentTypeEnum::ESEWA, PaymentTypeEnum::KHALTI, PaymentTypeEnum::PRABHUPAY, PaymentTypeEnum::IMEPAY, PaymentTypeEnum::BANK, PaymentTypeEnum::PAYPAL,PaymentTypeEnum::HAMROPAY)],
        ]);
        if ($validator->fails()) {
            
            session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home')->withInput();
        }
        $customer = Auth::guard('customer')->user();
        Session::put('useripaddress',null);
        Session::put('useripaddress',$request->ipaddress);
       
        if (!$customer) {
            session()->flash('error', 'Plz Login First !!');
            return redirect()->route('customer.login');
        }
        $currencyRate = 1;
        $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
        if ($usdCurrencyPrice) {
            $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
        }
        $subscription = Subscription::where('id', $request->subscription_id)->first();
        if (!$subscription) {
            throw new Exception();
        }
        $actualPriceInUsd = $subscription->price;
        $subscription->period_id = $subscription->period->value . '(' . $subscription->period->type->name . ')';
        $subscription->currency_type = $customerCurrencyType ?? "NPR";
        $subscription->price = round(($subscription->price * $usdCurrencyPrice) / $currencyRate, 4);
        
        try {
            switch ((int)$request->payment_type) {
                case 1: //ESEWA done
                    $subscription->price=$actualPriceInUsd*100;
                    $data = (new PaymentAction($request, $subscription))->payWithEsewa();
                    return view('frontend.payment.esewapayment', $data);
                    break;
                case 2: //KHALTI done
                    $subscription->price=$actualPriceInUsd*100;
                    $data = (new PaymentAction($request, $subscription))->payWithKhati();
                    break;
                case 3: //HAMROPAY done
                    $subscription->price=$actualPriceInUsd*100;
                    $data =(new PaymentAction($request, $subscription))->payWithHamroPay();
                    return view('hamro',compact('data'));
                    break;
                case 4: //IMEPAY done
                    $subscription->price=$actualPriceInUsd*100;
                    $data = (new PaymentAction($request, $subscription))->payWithImePay();
                    return view('frontend.payment.imepaypayment', $data);
                    break;
                case 5: //PAYPAL done
                    $provider = new PayPalClient();
                    $token = $provider->getAccessToken();
                    $provider->setAccessToken($token);
                    $order = $provider->createOrder([
                        "intent" => "CAPTURE",
                        "purchase_units" => [
                            [
                                "amount" => [
                                    "currency_code" => "USD",
                                    "value" => $actualPriceInUsd
                                ]
                            ]
                        ],
                        "application_context" => [
                            "cancel_url" => route('paypal.cancel'),
                            "return_url" => route('paypal.success')
                        ]
                    ]);
                    $data = [
                        'subscription_id' => $subscription->id,
                        'request' => $request->except('_token'),
                        'amount' => $actualPriceInUsd
                    ];
                    if ($order['status'] === 'CREATED') {
                        Session::put('paypalData', null);
                        Session::put('paypalData', $data);
                        return redirect()->to($order['links'][1]['href']);
                    } else {
                        throw new Exception();
                    }
                    break;
                case 6: //PRABHUPAY done
                    $subscription->price=$actualPriceInUsd*100;
                    $data = (new PaymentAction($request, $subscription))->payWithPrabhuPay();
                    throw new Exception();
                    break;
                case 7: //BANK
                    throw new Exception();
                    break;
                default:
                    throw new Exception();
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home')->withInput();
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('customer')->logout();
        request()->session()->flash('success', 'Logout Successfully !!');
        return redirect()->route('home');
    }

    public function setCurrency(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            return $this->webError($request);
        }

        $customerDefaultCurrency = $customer->cutomerDefaultCurrency->currency ?? null;
        if ($customerDefaultCurrency) {
            $customer->cutomerDefaultCurrency->delete();
        }
        $data = [
            'customer_id' => $customer->id,
            'currency_id' => (int)$request->currency_id
        ];
        if ($request->currency_id) {
            $this->customerDefaultCurrency->create($data);
        }

        $request->session()->flash('success', 'Currency Selected Successfully !!');
        return redirect()->route('home');
    }

    public function addPremiumContent(Request $request){
        $customer=Auth::guard('customer')->user();
        $type=$request->type;
        if(!$customer){
            return redirect()->route('customer.login');
        }

        if(!$type){
            return $this->webError($request);
        }
        $rules=[
            'premium_content_id'=>"required|exists:premium_contents,id",
            'type'=>["required",Rule::in(MovieTypeEnum::MOVIE,MovieTypeEnum::TVSERIES,MovieTypeEnum::WEBSERIES)],
            'amount'=>'required'
        ];

        switch((int)$request->type){
            case 1:
                $rules["movieId"] = 'required|exists:movies,id';
                break;
            case 2:
                $rules["movieId"] = 'required|exists:tv_series,id';
                break;
            case 3:
                $rules["movieId"] = 'required|exists:web_series,id';
                break;
            default:
                return false;
        }

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return $this->webError($request);
        }

        DB::beginTransaction();
        try{
            $premiumContent=PremiumContent::where('id',$request->premium_content_id)->where('movie_id',$request->movieId)->where('type',$request->type)->first();
            if(!$premiumContent){
                return "kera";
               return $this->responseApiError('Something Went Wrong !!',null,200);
            }
            if((int)$request->amount != (int)$premiumContent->price){
                return $this->webError($request);
            }
            $value=[
                'premium_content_id'=>$premiumContent->id,
                'customer_id'=>$customer->id,
                'amount'=>$request->amount,
                'type'=>$request->type,
                'movieId'=>$request->movieId
            ];
            $decodeValue=base64_encode(json_encode($value));


            $currencyRate = 1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
         
            $customerCurrencyType = 'NPR';
            $currencyRate = 1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
            if ($customer->cutomerDefaultCurrency) {
                $currencyRateData = $customer->cutomerDefaultCurrency->currency;
                $customerCurrencyType = $currencyRateData->code;
                $currencyRate = ((float)$currencyRateData->rate / (float)$currencyRateData->unit);
                $value['currency_type'] = $customerCurrencyType;
                $value['amount']= round(((int)$request->amount * $usdCurrencyPrice) / $currencyRate, 4);
            } else {
                $value['currency_type'] = $customerCurrencyType ?? "NPR";
                $value['amount'] = round(((int)$request->amount * $usdCurrencyPrice) / $currencyRate, 4);
            }
            return view('frontend.payment.premiumpayment',compact('decodeValue','value'));
        }catch(\Throwable $th){
            return $this->webError($request);
        }

    }

    public function primiumPayment(Request $request){
        $customer=Auth::guard('customer')->user();
        // dd($customer);
        if(!$customer){
            return $this->returnHomePage($request,'Something Went Wrong !!');
        }
        $encodePremiumContentValue=json_decode(base64_decode($request->premium_decode_value));
       
        if(!$encodePremiumContentValue){
            return $this->returnHomePage($request,'Something Went Wrong !!');
        }
        $type=$encodePremiumContentValue->type;
        if(!$type){
            return $this->returnHomePage($request,'Something Went Wrong !!');
        }
        $request['premium_content_id']=$encodePremiumContentValue->premium_content_id;
        $request['type']=$encodePremiumContentValue->type;
        $request['movieId']=$encodePremiumContentValue->movieId;
        $request['payment_type']=$request->payment_type;
        $request['payment_status']='1';
        $request['amount']=$encodePremiumContentValue->amount;
        $randomTrxn=Str::random(12);
        $request['transaction_id']=$randomTrxn;
        // dd($request->all());

        $rules=[
            'premium_content_id'=>"required|exists:premium_contents,id",
            'type'=>["required",Rule::in(MovieTypeEnum::MOVIE,MovieTypeEnum::TVSERIES,MovieTypeEnum::WEBSERIES)],
            'payment_type'=>['required',Rule::in(PaymentTypeEnum::ESEWA,PaymentTypeEnum::KHALTI,PaymentTypeEnum::PRABHUPAY,PaymentTypeEnum::IMEPAY,PaymentTypeEnum::BANK,PaymentTypeEnum::PAYPAL,PaymentTypeEnum::HAMROPAY)],
            'payment_status'=>['required',Rule::in(PaymentStatusEnum::SUCCESS,PaymentStatusEnum::PENDING,PaymentStatusEnum::CANCELLED)],
            'amount'=>'required',
            'transaction_id'=>'required|string',
            // 'device_type'=>['required',Rule::in(DeviceEnum::MOBILE,DeviceEnum::TV,DeviceEnum::BROWSER)],
            // 'device_name'=>'required|string',
            // 'device_serial_num'=>'required|string'
        ];
        switch((int)$request->type){
            case 1:
                $rules["movieId"] = 'required|exists:movies,id';
                break;
            case 2:
                $rules["movieId"] = 'required|exists:tv_series,id';
                break;
            case 3:
                $rules["movieId"] = 'required|exists:web_series,id';
                break;
            default:
                return false;
        }
        $currencyRate = 1;
        $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
        if ($usdCurrencyPrice) {
            $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
        }
        $premiumContent = PremiumContent::where('id', $request->premium_content_id)->first();
        if (!$premiumContent) {
            throw new Exception();
        }
        
        $actualPriceInUsd = $premiumContent->price;
        $finalAmount= round(($premiumContent->price * $usdCurrencyPrice) / $currencyRate, 4);
        $finalData=[
            'premium_content_id'=>$request->premium_content_id,
            'customer_id'=>$customer->id,
            'amount'=>$finalAmount
        ];
        
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return $this->returnHomePage($request,'Something Went Wrong !!');
        }
        DB::beginTransaction();
        try{
            switch ((int)$request->payment_type) {
                case 1: //ESEWA
                    $data = (new PremiumPaymentAction($finalData))->payWithEsewa();
                    return view('frontend.payment.esewapayment', $data);
                    break;
                case 2: //KHALTI
                    $data = (new PremiumPaymentAction($finalData))->payWithKhalti();
                    break;
                case 3: //PRABHUPAY
                    dd('Prabhu Pay');
                    throw new Exception();
                    break;
                case 4: //IMEPAY
                    $data =(new PremiumPaymentAction($finalData))->payWithImepay();
                    return view('frontend.payment.imepaypayment', $data);
                    break;
                case 5: //PAYPAL
                    $provider = new PayPalClient();
                    $token = $provider->getAccessToken();
                    $provider->setAccessToken($token);
                    $order = $provider->createOrder([
                        "intent" => "CAPTURE",
                        "purchase_units" => [
                            [
                                "amount" => [
                                    "currency_code" => "USD",
                                    "value" => $actualPriceInUsd
                                ]
                            ]
                        ],
                        "application_context" => [
                            "cancel_url" => route('paypal.cancel'),
                            "return_url" => route('paypal.success-premium-content')
                        ]
                    ]);
                    $data = [
                        'premium_content_id' => $premiumContent->id,
                        'request' => $request->except('_token'),
                        'amount' => $actualPriceInUsd
                    ];
                    if ($order['status'] === 'CREATED') {
                        Session::put('paypalDataPremiumContent', null);
                        Session::put('paypalDataPremiumContent', $data);
                        return redirect()->to($order['links'][1]['href']);
                    } else {
                        throw new Exception();
                    }
                   
                    break;
                case 6: //HAMROPAY
                    $data = (new PremiumPaymentAction($finalData))->payWithHamroPay();
                    throw new Exception();
                    break;
                case 7: //BANK
                    throw new Exception();
                    break;
                default:
                    throw new Exception();
            }

            
            
        }catch(\Throwable $th){
            DB::rollBack();
            return $this->returnHomePage($request,'Something Went Wrong !!');
        }
    }

    public function addToWishList(Request $request,$movie_id,$video_type){
        $request['movie_id']=$movie_id;
        $request['video_type']=$video_type;
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            return $this->returnHomePage($request,'Something Went Wrong !!');
        }
        $validator = Validator::make($request->all(), [
            'movie_id' => 'required',
            'video_type' => ['required', Rule::in(MovieTypeEnum::MOVIE, MovieTypeEnum::TVSERIES, MovieTypeEnum::WEBSERIES)]
        ]);
        if ($validator->fails()) {
            return $this->returnHomePage($request,'Something Went Wrong !!');
        }
        DB::beginTransaction();
        try {

            $alereadyExists = CustomerWishList::where('customer_id', $customer->id)->where('movie_id', $request->movie_id)->where('video_type', $request->video_type)->first();
            if ($alereadyExists) {
                $alereadyExists->delete();
                DB::commit();
                return $this->returnHomePageSuccess($request,'Remove From Wish List !!');
            }
            $data = $request->all();
            $data['customer_id'] = $customer->id;
            $this->customerWishList->fill($data);
            $this->customerWishList->save();
            DB::commit();
            return $this->returnHomePageSuccess($request,'Added To Wish List !!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->returnHomePage($request,'Something Went Wrong !!');
        }
    }

    public function verificationNew(Request $request)
    {
        // dd($request->all());
        if(!$request->otp)
        {
            $response=[
                'error'=>true,
                'msg'=>'Plz Provide Otp...'
            ];
            return response()->json($response,200);
        }
        $customer=Customer::where('verify_otp',$request->otp)->first();
        // dd($customer);
        DB::beginTransaction();
        try{
            if ($customer != null) {
                if ($customer->email_verified_at == null) {
                    Customer::where('verify_otp', $customer->verify_otp)->update(['email_verified_at' => Carbon::now()]);
                    DB::commit();
                    $response=[
                        'error'=>false,
                        'msg'=>'Your email has been verified. Please Log in to continue.',
                        'url'=>route('Clogin')
                    ];
                    return response()->json($response,200);
                } else {
                    $response=[
                        'error'=>false,
                        'msg'=>'Otp Verified Successfully...',
                        'url'=>route('customer.login')
                    ];
                    return response()->json($response,200);
                }
            } else {
                $response=[
                    'error'=>true,
                    'msg'=>'OOPs Your otp is not matched with our record...'
                ];
                return response()->json($response,200);
            }


        }catch(\Throwable $th){
            DB::rollBack();
            $response=[
                'error'=>true,
                'msg'=>'OOPs Your otp is not matched with our record...'
            ];
            return response()->json($response,200);
        }
        
    }

    public function showOTPForm(Request $request)
    {
        // dd($request->all(),'otp form');
        if(!$request->email_or_phone){
            $response = [
                'error' => true,
                'msg' => 'Plz Provide Email.',
            ];
            return response()->json($response, 200);
        }
        // $customer = Customer::where('email', $request->email_or_phone)->orWhere('phone', $request->email_or_phone)->whereNotNull('email')->whereNotNull('phone')->first();
        $customer = Customer::where('email', $request->email_or_phone)->first();
        if ($customer != null) {
            $customer->verify_otp = $this->generateOtp();
            Mail::to($customer->email)->send(new CustomerRegisterMail($customer));
            $customer->save();
            session()->put('customer_otp_form', 'show');
            $response = [
                'error' => false,
                'msg' => 'We sent you new OTP Code, Please check you email or phone.',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'error' => true,
                'msg' => 'The email is not match with our records, Please sign up.',
            ];
            return response()->json($response, 200);
        }
    }

    public function resetPasswordView(){
        return view('frontend.customer.auth.resetpassword');
    }

    public function resetPasswordAction(Request $request){
        $rules = array(
            'email'=>'required|email|exists:customers,email'
          );
          $v = Validator::make($request->all(), $rules);
          if (!$v->passes()) {
              $messages = $v->messages();
              foreach ($rules as $key => $value) {
                  $verrors[$key] = $messages->first($key);
              }
              $response_values = array(
                  'validate' => true,
                  'validation_failed' => 1,
                  'errors' => $verrors
              );
              return response()->json($response_values, 200);
          }
          
          try{
            $customer=Customer::where('email',$request->email)->first();
            if (!$customer) {
                $response = [
                    'error' => true,
                    'data' => null,
                    'msg' => 'User Not Found...'
                ];
                return response()->json($response, 200);
            }
            $reset_otp=$this->generateOtp();
            Mail::to($customer->email)->send(new ResetPasswordOtpMail($customer,$reset_otp));
            $customer->reset_otp=$reset_otp;
            $customer->save();
            $email=$customer->email;
            DB::commit();
            return view('frontend.customer.auth.resetpasswordform',compact('email'));
           
        }catch(\Throwable $th){
            DB::rollback();
            $response=[
                'error'=>false,
                'msg'=>'Something Went Wrong !!'
              ];
              return response()->json($response,200);
        }

    }

    public function updatePasswordAction(Request $request){
        $rules = array(
            'email'=>'required|email|exists:customers,email',
            'reset_otp'=>'required|string',
            'password'=>'required|string|min:6|confirmed'
          );
          $v = Validator::make($request->all(), $rules);
          if (!$v->passes()) {
              $messages = $v->messages();
              foreach ($rules as $key => $value) {
                  $verrors[$key] = $messages->first($key);
              }
              $response_values = array(
                  'validate' => true,
                  'validation_failed' => 1,
                  'errors' => $verrors
              );
              return response()->json($response_values, 200);
          }
          
        try{
            $customer=Customer::where('email',$request->email)->where('reset_otp',$request->reset_otp)->first();
            
            if (!$customer) {
                $response = [
                    'error' => true,
                    'data' => null,
                    'msg' => 'Invalid Otp...'
                ];
                return response()->json($response, 200);
            }
            $customer->password=bcrypt($request->password);
            $customer->from_old='0';
            $customer->email_verified_at=Carbon::now()->format('Y-m-d');
            $customer->save();
            DB::commit();
            $response=[
                'error'=>false,
                'msg'=>'Password Updated Successfully !!',
                'url'=>route('customer.login')
            ];
            return response()->json($response,200);
           
        }catch(\Throwable $th){
            DB::rollback();
            $response=[
                'error'=>true,
                'msg'=>'Something Went Wrong !!'
              ];
              return response()->json($response,200);
        }
    }

    public function removeFromWishList(Request $request){
        $customer=Auth::guard('customer')->user();
        if(!$customer){
            $response=[
                'login'=>true,
                'msg'=>'Plz Login First !!',
                'url'=>route('customer.login')
            ];
            return response()->json($response,200);
        }
        DB::beginTransaction();
        try{
            $wishListData=CustomerWishList::where('customer_id',$customer->id)->where('id',$request->id)->first();
            if(!$wishListData){
                throw new Exception();
            }
            $wishListData->delete();
            DB::commit();
            return view('frontend.updatewishlist',compact('customer'));
           
        }catch(\Throwable $th){
            DB::rollBack();
            $response=[
                'error'=>true,
                'msg'=>'Something Went Wrong !!',
            ];
            return response()->json($response,200);
        }
        
    }
}
