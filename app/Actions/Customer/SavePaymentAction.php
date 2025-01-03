<?php

namespace App\Actions\Customer;

use Exception;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Enum\PaymentTypeEnum;
use App\Enum\Device\DeviceEnum;
use App\Enum\PaymentStatusEnum;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPayment;
use Illuminate\Support\Facades\Auth;
use App\Models\PremiumContentPayment;
use App\Models\SubscriptionPaymentType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Actions\Payment\SubscriptionPaymentAction;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Actions\Api\CustomerDeviceAction\CustomerAddDevice;

class SavePaymentAction
{

    protected $customer;
    protected $request;
    protected $subscription;
    protected $subscriptionPayment;
    protected $subscriptionPaymentType;
    protected $premiumContentPayment;
    protected $deviceData;
    public function __construct(Request $request, Subscription $subscription)
    {
        $this->deviceData=userAgentData();
        $this->subscriptionPayment = new SubscriptionPayment();
        $this->subscriptionPaymentType = new SubscriptionPaymentType();
        $this->premiumContentPayment = new PremiumContentPayment();

        $this->request = $request;
        $this->subscription = $subscription;
        $this->customer = Auth::guard('customer')->user();
        if (!$this->customer) {
            throw new Exception();
        }
    }

    public function saveSubscriptionPayment()
    {
        if (!(new KhaltiPaymentAction($this->request))->validateTransaction()) {
            session()->flash('error', 'Your Payment Validation Failed, Please Pay Again');
            return redirect()->route('home');
        }
        $ipAddress=Session::get('useripaddress');
        $this->request['subscription_id'] = $this->subscription->id;
        $this->request['payment_type'] = '2';
        $this->request['payment_status'] = '1';
        $this->request['amount'] = $this->request->amount / 100;
        $this->request['transaction_id'] = $this->request->transaction_id;
        $this->request['device_type'] = '3';
        $this->request['device_name'] = $this->deviceData['device'];
        $this->request['device_serial_num'] = $ipAddress;
        $customer = $this->customer;
        if (!$customer) {
            throw new Exception();
        }
        
        $validator = Validator::make($this->request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
            'payment_type' => ['required', Rule::in(PaymentTypeEnum::ESEWA, PaymentTypeEnum::KHALTI, PaymentTypeEnum::PRABHUPAY, PaymentTypeEnum::IMEPAY, PaymentTypeEnum::BANK, PaymentTypeEnum::PAYPAL)],
            'payment_status' => ['required', Rule::in(PaymentStatusEnum::SUCCESS, PaymentStatusEnum::PENDING, PaymentStatusEnum::CANCELLED)],
            'amount' => 'required',
            'transaction_id' => 'required|string',
            'device_type' => ['required', Rule::in(DeviceEnum::MOBILE, DeviceEnum::TV, DeviceEnum::BROWSER)],
            'device_name' => 'required|string',
            'device_serial_num' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new Exception();
        }
        $data = (new SubscriptionPaymentAction($this->request, $this->subscriptionPayment, $customer, $this->subscriptionPaymentType))->subscriptionCallBackAction();
        $deviceList = $customer->deviceList;
        foreach ($deviceList as $list) {
            $list->delete();
        }
        (new CustomerAddDevice($customer))->setDeviceListMain($this->request);
        $paymentHistory = $customer->paymentHistories;
        return true;
    }

    public function saveSubscriptionPaymentEsewa()
    {
        $ipAddress=Session::get('useripaddress');
        $this->request['subscription_id'] = $this->subscription->id;
        $this->request['payment_type'] = '1';
        $this->request['payment_status'] = '1';
        $this->request['amount'] = $this->request->amt;
        $this->request['transaction_id'] = $this->request->refId;
        $this->request['device_type'] = '3';
        $this->request['device_name'] = $this->deviceData['device'];
        $this->request['device_serial_num'] = $ipAddress;
        $customer = $this->customer;
        if (!$customer) {
            throw new Exception();
        }
        $validator = Validator::make($this->request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
            'payment_type' => ['required', Rule::in(PaymentTypeEnum::ESEWA, PaymentTypeEnum::KHALTI, PaymentTypeEnum::PRABHUPAY, PaymentTypeEnum::IMEPAY, PaymentTypeEnum::BANK, PaymentTypeEnum::PAYPAL)],
            'payment_status' => ['required', Rule::in(PaymentStatusEnum::SUCCESS, PaymentStatusEnum::PENDING, PaymentStatusEnum::CANCELLED)],
            'amount' => 'required',
            'transaction_id' => 'required|string',
            'device_type' => ['required', Rule::in(DeviceEnum::MOBILE, DeviceEnum::TV, DeviceEnum::BROWSER)],
            'device_name' => 'required|string',
            'device_serial_num' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new Exception();
        }
        $data = (new SubscriptionPaymentAction($this->request, $this->subscriptionPayment, $customer, $this->subscriptionPaymentType))->subscriptionCallBackAction();
        $deviceList = $customer->deviceList;
        foreach ($deviceList as $list) {
            $list->delete();
        }
        (new CustomerAddDevice($customer))->setDeviceListMain($this->request);
        $paymentHistory = $customer->paymentHistories;
        return true;
    }

    public function saveSubscriptionPaymentPaypal($sessionData)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($this->request['token']);
        if ($response['status'] === 'COMPLETED') {
            $refId = $response['id'];
        } else {
            session()->flash('error', 'Yor Payment Validation Failed, Please Pay Again');
            return redirect()->route('home');
        }
        // dd($response,$this->request->all(),$sessionData);
        $ipAddress=Session::get('useripaddress');
        $this->request['subscription_id'] = $sessionData['subscription_id'];
        $this->request['payment_type'] = '5';
        $this->request['payment_status'] = '1';
        $this->request['amount'] = $sessionData['amount'];
        $this->request['transaction_id'] = $refId;
        $this->request['device_type'] = '3';
        $this->request['device_name'] = $this->deviceData['device'];
        $this->request['device_serial_num'] = $ipAddress;
        $customer = $this->customer;
        if (!$customer) {
            throw new Exception();
        }
        $validator = Validator::make($this->request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
            'payment_type' => ['required', Rule::in(PaymentTypeEnum::ESEWA, PaymentTypeEnum::KHALTI, PaymentTypeEnum::PRABHUPAY, PaymentTypeEnum::IMEPAY, PaymentTypeEnum::BANK, PaymentTypeEnum::PAYPAL)],
            'payment_status' => ['required', Rule::in(PaymentStatusEnum::SUCCESS, PaymentStatusEnum::PENDING, PaymentStatusEnum::CANCELLED)],
            'amount' => 'required',
            'transaction_id' => 'required|string',
            'device_type' => ['required', Rule::in(DeviceEnum::MOBILE, DeviceEnum::TV, DeviceEnum::BROWSER)],
            'device_name' => 'required|string',
            'device_serial_num' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new Exception();
        }
        $data = (new SubscriptionPaymentAction($this->request, $this->subscriptionPayment, $customer, $this->subscriptionPaymentType))->subscriptionCallBackAction();
        $deviceList = $customer->deviceList;
        foreach ($deviceList as $list) {
            $list->delete();
        }
        (new CustomerAddDevice($customer))->setDeviceListMain($this->request);
        $paymentHistory = $customer->paymentHistories;
        return true;
    }

    
    public function saveSubscriptionPaymentImePay($sessionData)
    {

        if (!$sessionData) {
            throw new Exception();
        }
        $ipAddress=Session::get('useripaddress');
        $this->request['subscription_id'] = $sessionData['subscription_id'];
        $this->request['payment_type'] = '4';
        $this->request['payment_status'] = '1';
        $this->request['amount'] = $sessionData['amount'];
        $this->request['transaction_id'] = $sessionData['refId'];
        $this->request['device_type'] = '3';
        $this->request['device_name'] = $this->deviceData['device'];
        $this->request['device_serial_num'] = $ipAddress;
        $customer = $this->customer;
        if (!$customer) {
            throw new Exception();
        }
        $validator = Validator::make($this->request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
            'payment_type' => ['required', Rule::in(PaymentTypeEnum::ESEWA, PaymentTypeEnum::KHALTI, PaymentTypeEnum::PRABHUPAY, PaymentTypeEnum::IMEPAY, PaymentTypeEnum::BANK, PaymentTypeEnum::PAYPAL)],
            'payment_status' => ['required', Rule::in(PaymentStatusEnum::SUCCESS, PaymentStatusEnum::PENDING, PaymentStatusEnum::CANCELLED)],
            'amount' => 'required',
            'transaction_id' => 'required|string',
            'device_type' => ['required', Rule::in(DeviceEnum::MOBILE, DeviceEnum::TV, DeviceEnum::BROWSER)],
            'device_name' => 'required|string',
            'device_serial_num' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new Exception();
        }
        $data = (new SubscriptionPaymentAction($this->request, $this->subscriptionPayment, $customer, $this->subscriptionPaymentType))->subscriptionCallBackAction();
        $deviceList = $customer->deviceList;
        foreach ($deviceList as $list) {
            $list->delete();
        }
        (new CustomerAddDevice($customer))->setDeviceListMain($this->request);
        $paymentHistory = $customer->paymentHistories;
        return true;
    }

    public function saveSubscriptionPaymentHamroPay($sessionData)
    {

        if (!$sessionData) {
            throw new Exception();
        }
        $ipAddress=Session::get('useripaddress');
        $this->request['subscription_id'] = $sessionData['subscription_id'];
        $this->request['payment_type'] = '3';
        $this->request['payment_status'] = '1';
        $this->request['amount'] = $sessionData['amount'];
        $this->request['transaction_id'] = $this->request->MerchantTxnId;
        $this->request['device_type'] = '3';
        $this->request['device_name'] = $this->deviceData['device'];
        $this->request['device_serial_num'] = $ipAddress;
        $customer = $this->customer;
        if (!$customer) {
            throw new Exception();
        }
        $validator = Validator::make($this->request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
            'payment_type' => ['required', Rule::in(PaymentTypeEnum::ESEWA, PaymentTypeEnum::KHALTI, PaymentTypeEnum::PRABHUPAY, PaymentTypeEnum::IMEPAY, PaymentTypeEnum::BANK, PaymentTypeEnum::PAYPAL,PaymentTypeEnum::HAMROPAY)],
            'payment_status' => ['required', Rule::in(PaymentStatusEnum::SUCCESS, PaymentStatusEnum::PENDING, PaymentStatusEnum::CANCELLED)],
            'amount' => 'required',
            'transaction_id' => 'required|string',
            'device_type' => ['required', Rule::in(DeviceEnum::MOBILE, DeviceEnum::TV, DeviceEnum::BROWSER)],
            'device_name' => 'required|string',
            'device_serial_num' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new Exception();
        }
        $data = (new SubscriptionPaymentAction($this->request, $this->subscriptionPayment, $customer, $this->subscriptionPaymentType))->subscriptionCallBackAction();
        $deviceList = $customer->deviceList;
        foreach ($deviceList as $list) {
            $list->delete();
        }
        (new CustomerAddDevice($customer))->setDeviceListMain($this->request);
        $paymentHistory = $customer->paymentHistories;
        return true;
    }

    
}
