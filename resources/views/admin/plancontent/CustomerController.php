<?php

namespace App\Http\Controllers\Customer;

use App\Models\Setting;
use App\Enum\GenderEnum;
use App\Models\WebsiteLogo;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Models\CustomerDetail;
use App\Models\PaymentHistory;
use Illuminate\Support\Carbon;
use App\Enum\Device\DeviceEnum;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use App\Enum\Customer\LoginTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Actions\Customer\LoginRegisterAction;
use App\Actions\Api\CustomerDeviceAction\CustomerAddDevice;
use App\Actions\Api\CustomerDeviceAction\CustomerDeviceCheck;
use App\Models\Api\CustomerDeviceList;

class CustomerController extends Controller
{
    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function loginOrRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|integer',
            'email_or_phone' => 'required|in:0,1',
            'country_code' => 'nullable|string',
            'platform'=>'required|string'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

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
            $response = [
                'error' => false,
                'data' => $data->email ?? $data->phone,
                'type' => $request->email_or_phone,
                'msg' => 'Otp Send Successfully !!'
            ];
            return response()->json($response, 200);
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

    public function getLogin(Request $request)
    {
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
            
            $otp = $request->otp;
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

            if($customer->manual_subscription){
                $deviceList=$customer->deviceList;
                foreach($deviceList as $list){
                    $list->delete();
                }
                if ($subscriptionStatus) {
                    $alreadyAddedToList = CustomerDeviceList::where('customer_id',$customer->id)->where('device_serial_num', $request->device_serial_num)->withTrashed()->first();
                    if (!$alreadyAddedToList) {
                        $setDeviceStatus = (new CustomerAddDevice($customer))->setDeviceList($request);
                        if (!$setDeviceStatus) {
                            session()->flash('error','Device Limit Is Full Please Logout From Another Device To Login This Device !!');
                            return back();
                        }
                    }else{
                        $alreadyAddedToList->deleted_at=null;
                        $alreadyAddedToList->save();
                    }
                } else {
                    (new CustomerAddDevice($customer))->setDeviceList($request);
                }
                $customer->manual_subscription='0';
                $customer->save();
            }else{
                if ($subscriptionStatus) {
                    $alreadyAddedToList = CustomerDeviceList::where('device_serial_num', $request->device_serial_num)->first();
                    if (!$alreadyAddedToList) {
                        $setDeviceStatus = (new CustomerAddDevice($customer))->setDeviceList($request);
                        if (!$setDeviceStatus) {
                            return $this->responseApiError('Device Limit Is Full Plz Logout From Another Device To Login This Device !!', null, 200);
                        }
                        // $checkdeviceList=(new CustomerDeviceCheck($request,$customer))->checkDeviceList();
                    }
                } else {
                    (new CustomerAddDevice($customer))->setDeviceList($request);
                }
            }


            
            $customer->deleted_at=null;
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
            $registerStaus = true;
            $customerDetails = $user->customerDetail;
            if (!$customerDetails) {
                $registerStaus = false;
            }
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $response = [
                'error' => false,
                'data' => $success,
                'register' => $registerStaus,
                'message' => 'Login Successfull !'
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
    }

    public function updateDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => ['required', Rule::in(GenderEnum::MALE, GenderEnum::FEMALE, GenderEnum::OTHER)],
            'date_of_birth' => 'required|date'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        $customer = Auth::user();
        DB::beginTransaction();
        try {
            $temp = [
                'customer_id' => $customer->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth
            ];
            CustomerDetail::insert($temp);
            DB::commit();
            $success['token'] = $customer->createToken('MyApp')->plainTextToken;
            // $success['user'] = $customer;
            $response = [
                'error' => false,
                'data' => $success,
                'msg' => 'Registration Successfull !!'
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => ['required', Rule::in(GenderEnum::MALE, GenderEnum::FEMALE, GenderEnum::OTHER)],
            'date_of_birth' => 'required|date',
            'photo' => 'sometimes|image'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $customer = Auth::user();
        DB::beginTransaction();
        try {
            $data = $request->except('photo');
            if ($request->photo && $request->photo != null) {
                $image_name = uploadProfileImage($request->photo, 'customer', '200x200');
                if ($image_name) {
                    $data['photo'] = $image_name;
                }
            }
            if ($customer->customerDetail) {
                $customer->customerDetail->fill($data);
                $customer->customerDetail->save();
            } else {
                $temp = [
                    'customer_id' => $customer->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'photo' => $data['photo'] ?? null,
                    'photo_from' => $data['photo_from'] ?? 'web'
                ];
                CustomerDetail::insert($temp);
            }
            DB::commit();
            $response = [
                'error' => false,
                'data' => null,
                'msg' => 'Profile Update Successfull !!'
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
    }

    public function customerProfile(Request $request)
    {
        $customer = Auth::user();
        if (!$customer) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
        $customer->name = ($customer->customerDetail->first_name ?? '') . ' ' . ($customer->customerDetail->last_name ?? '');
        $customer->setAttribute('gender', $customer->customerDetail->gender ?? null);
        if ($customer->type == '1') {
            $customer->setAttribute('photo', $customer->customerDetail->photo ? asset('Uploads/customer/' . $customer->customerDetail->photo) : null);
        } else {
            $customer->setAttribute('photo', $customer->customerDetail->photo ? $customer->customerDetail->photo : null);
        }

        $customer->setAttribute('date_of_birth', $customer->customerDetail->date_of_birth ?? null);
        $customer->makeHidden('customerDetail');
        $customer->makeHidden('password');
        $subscriptionStatus = (new CustomerDeviceCheck($request, $customer))->checkSubscription();
        $customer->makeHidden('subscription');
        $customer->setAttribute('subscriptionStatus', $subscriptionStatus);
        $success['user'] = $customer;
        // dd($customer);

        $response = [
            'error' => false,
            'data' => $success,
            'msg' => 'Customer Profile !!'
        ];
        return response()->json($response, 200);
    }

    public function logout()
    {
        $customer = Auth::user();
        if (!$customer) {
            return $this->responseApiError('Plz Login First', null, 200);
        }
        $customer->tokens()->delete();
        return $this->responseApiSuccess("Logout Successfully !!", null, 200);
    }

    public function downloadBill(Request $request, $invoiceNum)
    {
        
        if (!$invoiceNum) {
            return $this->responseApiError('Invoice Num Required...', null, 200);
        }
        $item = PaymentHistory::where('transaction_id', $invoiceNum)->first();
        // dd($item);
        if (!$item) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
        $subscriptionData = $item->from_model::where('id', $item->model_id)->first();
        // dd($subscriptionData);
        $data = [
            'title' => 'Online Payment',
            'amount' => ($item->amount_type == 'npr' ? 'NPR ' : '$ ') . $item->amount,
            'operator' => $item->payment_type->name,
            'type' => 'Online',
            'invoice_num' => $item->transaction_id,
            'for_payment' => $item->purpose,
            'date' => Carbon::parse($item->created_at)->formatLocalized('%d %B, %Y')
        ];


        // $path = public_path('backend\dist\img\logo.png');
        // // dd($path);
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        // $img = file_get_contents($path);
        // $tick = 'data:image/' . $type . ';base64,' . base64_encode($img);
        $tick = null;
        $setting = SystemSetting::first();
        $logo = null;
        $customer = $item->customer;
        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif'])->loadView('admin.bill',  compact('data', 'setting', 'logo', 'customer', 'subscriptionData', 'tick'));
        return $pdf->download('Kantipur Cinemas.pdf');
    }

    public function socialLoginOrRegister(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email',
            'country_code' => 'nullable|string',
            'login_type' => ['required', Rule::in(LoginTypeEnum::APPLE, LoginTypeEnum::GOOGLE)],
            'photo' => 'nullable|string',
            'device_type' => ['required', Rule::in(DeviceEnum::MOBILE, DeviceEnum::TV, DeviceEnum::BROWSER)],
            'device_name' => 'required|string',
            'device_serial_num' => 'required|string',
            'platform'=>'required|string'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        if (!$request->email) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Email Field Required...'
            ];
            return response()->json($response, 200);
        }
        $request['email_or_phone'] = 1;

        DB::beginTransaction();
        try {
            $data = (new LoginRegisterAction($request, $this->customer))->toResponseSocailMedia();
            // dd($data);

            $subscriptionStatus = (new CustomerDeviceCheck($request, $data))->checkSubscription();
            if ($subscriptionStatus) {
                $alreadyAddedToList = CustomerDeviceList::where('customer_id',$data->id)->where('device_serial_num', $request->device_serial_num)->first();
                if (!$alreadyAddedToList) {
                    $setDeviceStatus = (new CustomerAddDevice($data))->setDeviceList($request);
                    if (!$setDeviceStatus) {
                        return $this->responseApiError('Device Limit Is Full Plz Logout From Another Device To Login This Device !!', null, 200);
                    }
                    // $checkdeviceList=(new CustomerDeviceCheck($request,$customer))->checkDeviceList();
                }
            } else {
                (new CustomerAddDevice($data))->setDeviceList($request);
            }


            // $subscriptionStatus = (new CustomerDeviceCheck($request, $data))->checkSubscription();
            // if ($subscriptionStatus) {
            //     $alreadyAddedToList = CustomerDeviceList::where('device_serial_num', $request->device_serial_num)->first();
            //     if (!$alreadyAddedToList) {
            //         $setDeviceStatus = (new CustomerAddDevice($data))->setDeviceListSocial($request);
            //         if (!$setDeviceStatus) {
            //             return $this->responseApiError('Device Limit Is Full Plz Logout From Another Device To Login This Device !!', null, 200);
            //         }
            //     }
            // } else {
            //     (new CustomerAddDevice($data))->setDeviceListSocial($request);
            // }
            // if (Auth::guard('customer')->attempt(['email' => $data->email, 'password' => $data->email])) {
            //     $user = Auth::guard('customer')->user();
            // } else {
            //     $response = [
            //         'error' => true,
            //         'data' => null,
            //         'msg' => 'Something Went Wrong !!'
            //     ];
            //     return response()->json($response, 200);
            // }
            $registerStaus = true;
            $customerDetails = $data->customerDetail;
            if (!$customerDetails) {
                $customerDetailsData = new CustomerDetail();
                $detailsData = [
                    'customer_id' => $data->id,
                    'first_name' => $request->first_name ?? null,
                    'last_name' => $request->last_name ?? null,
                    'photo' => $request->photo ?? null
                ];
                $customerDetailsData->fill($detailsData);
                $customerDetailsData->save();
                $registerStaus = false;
            }
            $success['token'] = $data->createToken('MyApp')->plainTextToken;
            DB::commit();
            $response = [
                'error' => false,
                'data' => $success,
                'register' => $registerStaus,
                'message' => 'Login Successfull !'
            ];
            return response()->json($response, 200);
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

    public function deleteAccount(){
        $customer = Auth::user();
        if (!$customer) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
        DB::beginTransaction();
        try {
            $customer->delete();
            DB::commit();
            $response = [
                'error' => false,
                'data' => null,
                'message' => 'Account Deleted !!'
            ];
            return response()->json($response, 200);
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

   
}
