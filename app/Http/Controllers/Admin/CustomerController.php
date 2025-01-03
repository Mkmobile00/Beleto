<?php

namespace App\Http\Controllers\Admin;

use Exception;
use ReflectionClass;
use App\Models\Movie;
use App\Enum\GenderEnum;
use Illuminate\Support\Str;
use Mockery\Matcher\Subset;
use App\Models\Subscription;
use App\Models\TvSeriesPart;
use Illuminate\Http\Request;
use App\Enum\PaymentTypeEnum;
use App\Models\SystemSetting;
use App\Models\WebSeriesPart;
use App\Models\CustomerDetail;
use App\Models\PaymentHistory;
use Illuminate\Support\Carbon;
use App\Enum\Device\DeviceEnum;
use App\Enum\PaymentStatusEnum;
use Illuminate\Validation\Rule;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPayment;
use App\Utilities\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Models\PremiumContentPayment;
use App\Models\SubscriptionPaymentType;
use App\Models\VideoWatchCustomerRecord;
use App\Enum\Customer\CustomerStatusEnum;
use Illuminate\Support\Facades\Validator;
use App\Actions\Customer\SavePaymentAction;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Actions\Payment\SubscriptionPaymentAction;
use App\Actions\Api\CustomerDeviceAction\CustomerAddDevice;
use App\Models\Api\CustomerDeviceList;
use Barryvdh\DomPDF\Facade\Pdf;
class CustomerController extends Controller
{
    protected $customer;
    protected $customerDetail;
    protected $subscriptionPayment;
    protected $subscriptionPaymentType;
    protected $premiumContentPayment;

    public function __construct(Customer $customer,CustomerDetail $customerDetail)
    {
        $this->customer=$customer;
        $this->customerDetail=$customerDetail;
        $this->subscriptionPayment = new SubscriptionPayment();
        $this->subscriptionPaymentType = new SubscriptionPaymentType();
        $this->premiumContentPayment = new PremiumContentPayment();
    }
    public function getCustomer(Request $request){
        
        $data['customers']=Customer::with('subscription')->orderBy('id','DESC')->paginate(20);
        $allCustomer=Customer::get();
        $data['totalCustomerSubscription']=Customer::whereHas('subscription')->count();
        $data['totalUser']=count($allCustomer);
        $data['verifiedUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->where('email_verified_at','!=',null)->count();
        $data['activeUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->count();
        $data['inactiveUser']=$allCustomer->where('status',CustomerStatusEnum::INACTIVE)->count();
        $data['blockedUser']=$allCustomer->where('status',CustomerStatusEnum::BLOCKED)->count();
        return view('admin.customer.index',$data);
    }

    public function getVerifiedCustomer(Request $request){
        
        $data['customers']=Customer::with('subscription')->orderBy('id','DESC')->where('email_verified_at','!=',null)->paginate(20);
        $allCustomer=Customer::get();
        $data['totalCustomerSubscription']=Customer::whereHas('subscription')->count();
        $data['totalUser']=count($allCustomer);
        $data['verifiedUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->where('email_verified_at','!=',null)->count();
        $data['activeUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->count();
        $data['inactiveUser']=$allCustomer->where('status',CustomerStatusEnum::INACTIVE)->count();
        $data['blockedUser']=$allCustomer->where('status',CustomerStatusEnum::BLOCKED)->count();
        return view('admin.customer.verifiedlist',$data);
    }

    public function getActiveCustomer(Request $request){
        
        $data['customers']=Customer::with('subscription')->orderBy('id','DESC')->where('status',CustomerStatusEnum::ACTIVE)->paginate(20);
        $allCustomer=Customer::get();
        $data['totalCustomerSubscription']=Customer::whereHas('subscription')->count();
        $data['totalUser']=count($allCustomer);
        $data['verifiedUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->where('email_verified_at','!=',null)->count();
        $data['activeUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->count();
        $data['inactiveUser']=$allCustomer->where('status',CustomerStatusEnum::INACTIVE)->count();
        $data['blockedUser']=$allCustomer->where('status',CustomerStatusEnum::BLOCKED)->count();
        return view('admin.customer.activelist',$data);
    }

    public function getInActiveCustomer(Request $request){
        
        $data['customers']=Customer::with('subscription')->orderBy('id','DESC')->where('status',CustomerStatusEnum::INACTIVE)->paginate(20);
        $allCustomer=Customer::get();
        $data['totalCustomerSubscription']=Customer::whereHas('subscription')->count();
        $data['totalUser']=count($allCustomer);
        $data['verifiedUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->where('email_verified_at','!=',null)->count();
        $data['activeUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->count();
        $data['inactiveUser']=$allCustomer->where('status',CustomerStatusEnum::INACTIVE)->count();
        $data['blockedUser']=$allCustomer->where('status',CustomerStatusEnum::BLOCKED)->count();
        return view('admin.customer.inactivelist',$data);
    }

    public function getBlockedCustomer(Request $request){
        
        $data['customers']=Customer::with('subscription')->orderBy('id','DESC')->where('status',CustomerStatusEnum::BLOCKED)->paginate(20);
        $allCustomer=Customer::get();
        $data['totalCustomerSubscription']=Customer::whereHas('subscription')->count();
        $data['totalUser']=count($allCustomer);
        $data['verifiedUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->where('email_verified_at','!=',null)->count();
        $data['activeUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->count();
        $data['inactiveUser']=$allCustomer->where('status',CustomerStatusEnum::INACTIVE)->count();
        $data['blockedUser']=$allCustomer->where('status',CustomerStatusEnum::BLOCKED)->count();
        return view('admin.customer.blocklist',$data);
    }

    public function getSubscriptionCustomer(Request $request){
        
        $data['customers']=Customer::whereHas('subscription')->orderBy('id','DESC')->paginate(20);
        $allCustomer=Customer::get();
        $data['totalCustomerSubscription']=Customer::whereHas('subscription')->count();
        $data['totalUser']=count($allCustomer);
        $data['verifiedUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->where('email_verified_at','!=',null)->count();
        $data['activeUser']=$allCustomer->where('status',CustomerStatusEnum::ACTIVE)->count();
        $data['inactiveUser']=$allCustomer->where('status',CustomerStatusEnum::INACTIVE)->count();
        $data['blockedUser']=$allCustomer->where('status',CustomerStatusEnum::BLOCKED)->count();
        return view('admin.customer.subscriptionuserlist',$data);
    }
    
    
    

    

    public function create(){
        $status=new ReflectionClass(CustomerStatusEnum::class);
        $status=array_values($status->getConstants());

        $gender=new ReflectionClass(GenderEnum::class);
        $gender=array_values($gender->getConstants());
        $data=[
            'stataus'=>$status,
            'gender'=>$gender
        ];
        
        return view('admin.customer.form',$data);
    }

    public function edit(Request $request,$id){
        $customer=Customer::findOrFail($id);
        $status=new ReflectionClass(CustomerStatusEnum::class);
        $status=array_values($status->getConstants());

        $gender=new ReflectionClass(GenderEnum::class);
        $gender=array_values($gender->getConstants());
        $data=[
            'stataus'=>$status,
            'gender'=>$gender,
            'customer'=>$customer,
            'date'=>Carbon::parse($customer->customerDetail->date_of_birth)->format('Y-m-d')
        ];
        return view('admin.customer.form',$data);
    }

    public function store(CustomerStoreRequest $request){
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['password']=bcrypt($request->password);
            $data['email_or_phone']='1';
            $data['verified_from']='web';
            $data['email_verified_at']=Carbon::now()->format('Y-m-d');
            $data['from_old']='1';
            $this->customer->fill($data);
            $this->customer->save();
            $temp=[
                'customer_id'=>$this->customer->id,
                'gender'=>$data['gender'],
                'date_of_birth'=>$data['date_of_birth'],
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'photo'=>$data['photo']
            ];
            $this->customerDetail->insert($temp);
            DB::commit();
            $request->session()->flash('success','Customer Created Successfully !!');
            return redirect()->route('customer.list');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();

        }
    }

    public function getCustomerDetails(Request $request,$id){
        $data['customer']=$this->customer->findOrFail($id);
        $today = Carbon::today();
        $future_date = Carbon::createFromFormat('Y-m-d', '2026-02-09');
        $days_left = $today->diffInDays($future_date);
        $data['allSubscription'] = $data['customer']->subscription->map(function ($item) use ($today) {
            $future_date = Carbon::createFromFormat('Y-m-d', $item->to_date);
            $days_left = $today->diffInDays($future_date);
            return [
                'title' => $item->subscription->title,
                'is_expired'=>$item->is_expired,
                'days' => $item->subscription_id,
                'total_days' => (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date)),
                'left_days' => $days_left,
                'percentage' => round(($days_left / (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date))) * 100),
                'from' => Carbon::parse($item->from_date)->formatLocalized('%d %B, %Y'),
                'to' => Carbon::parse($item->to_date)->formatLocalized('%d %B, %Y')
            ];
        });
        $data['paymentHistories'] = $data['customer']->paymentHistories->map(function ($item) {
            return [
                'title' => 'Online Payment',
                'amount' => ($item->amount_type == 'npr' ? 'NPR ' : '$ ') . $item->amount,
                'operator' => $item->payment_type->name,
                'type' => 'Online',
                'invoice_num' => $item->transaction_id,
                'for_payment' => $item->purpose,
                'date' => Carbon::parse($item->created_at)->formatLocalized('%d %B, %Y')
                
            ];
        });
        $data['deviceList'] = $data['customer']->deviceListAdmin->map(function ($item) {
            return [
                'id' => $item->id,
                'device_type' => $item->device_type->name,
                'device_name' => $item->device_name,
                'device_serial_num' => $item->device_serial_num,
                'added_date' => $item->added_date,
                'deleted_at'=>$item->deleted_at
            ];
        });

        $customerHistory=VideoWatchCustomerRecord::where('customer_id',$data['customer']->id)->with('viewVideo')->get()->map(function($item){
            return $item->viewVideo;
        });
        $viewData=$customerHistory->map(function($item){
            switch($item->type){
                case 1:
                    $movies = Movie::where('unique_code', $item->video_unique_code)->first();
                    $videoPath=$movies->movie_path;
                    $path=route('movie.update',$movies->id);
                    break;
                case 2:
                    $movies = TvSeriesPart::where('unique_code', $item->video_unique_code)->first();
                    $videoPath=$movies->video_path;
                    $path=route('tvseries.episodeedit',$movies->id);
                    break;
                case 3:
                    $movies = WebSeriesPart::where('unique_code',  $item->video_unique_code)->first();
                    $videoPath=$movies->video_path;
                    $path=route('webseries.episodeedit',$movies->id);
                    break;
            }
            return[
                'title'=>$movies->title,
                'slug'=>$movies->slug,
                'video_path'=>$videoPath,
                'date'=>$item->created_at->formatLocalized('%d %B %Y'),
                'path'=>$path,
                'poster'=>$movies->poster,
                'type'=>$movies->type
            ];
        });
        $url = route('customer.paginatewatchhistory',$data['customer']->id);
        $data['viewData'] = PaginationHelper::paginate(collect($viewData), 5)->withPath($url);

        return view('admin.customer.details',$data);
    }

    public function getCustomerWatchHistoryPaginate(Request $request,$id){
        $data['customer']=$this->customer->findOrFail($id);
        
        $customerHistory=VideoWatchCustomerRecord::where('customer_id',$data['customer']->id)->with('viewVideo')->get()->map(function($item){
            return $item->viewVideo;
        });
        $viewData=$customerHistory->map(function($item){
            switch($item->type){
                case 1:
                    $movies = Movie::where('unique_code', $item->video_unique_code)->first();
                    $videoPath=$movies->movie_path;
                    $path=route('movie.update',$movies->id);
                    break;
                case 2:
                    $movies = TvSeriesPart::where('unique_code', $item->video_unique_code)->first();
                    $videoPath=$movies->video_path;
                    $path=route('tvseries.episodeedit',$movies->id);
                    break;
                case 3:
                    $movies = WebSeriesPart::where('unique_code',  $item->video_unique_code)->first();
                    $videoPath=$movies->video_path;
                    $path=route('webseries.episodeedit',$movies->id);
                    break;
            }
            return[
                'title'=>$movies->title,
                'slug'=>$movies->slug,
                'video_path'=>$videoPath,
                'date'=>$item->created_at->formatLocalized('%d %B %Y'),
                'path'=>$path,
                'poster'=>$movies->poster,
                'type'=>$movies->type
            ];
        });
        $url = route('customer.paginatewatchhistory',$data['customer']->id);
        $data['viewData'] = PaginationHelper::paginate(collect($viewData), 5)->withPath($url);
        return view('admin.customer.paginatedata',$data);
    }

    public function customerSusbcriptionList(Request $request,$id){
        $this->customer=$this->customer->findOrFail($id);
        $today = Carbon::today();
        $future_date = Carbon::createFromFormat('Y-m-d', '2026-02-09');
        $days_left = $today->diffInDays($future_date);
        $allSubscription = $this->customer->subscription->map(function ($item) use ($today) {
            $future_date = Carbon::createFromFormat('Y-m-d', $item->to_date);
            $days_left = $today->diffInDays($future_date);
            return [
                'title' => $item->subscription->title,
                'is_expired'=>$item->is_expired,
                'days' => $item->subscription_id,
                'total_days' => (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date)),
                'left_days' => $days_left,
                'percentage' => round(($days_left / (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date))) * 100),
                'from' => Carbon::parse($item->from_date)->formatLocalized('%d %B, %Y'),
                'to' => Carbon::parse($item->to_date)->formatLocalized('%d %B, %Y')
            ];
        });
        return view('admin.customer.subscriptionlist',compact('allSubscription'));
    }

    public function customerPaymentHistory(Request $request,$id){
        $this->customer=$this->customer->findOrFail($id);
        $paymentHistories = $this->customer->paymentHistories->map(function ($item) {
            return [
                'title' => 'Online Payment',
                'amount' => ($item->amount_type == 'npr' ? 'NPR ' : '$ ') . $item->amount,
                'operator' => $item->payment_type->name,
                'type' => 'Online',
                'invoice_num' => $item->transaction_id,
                'for_payment' => $item->purpose,
                'date' => Carbon::parse($item->created_at)->formatLocalized('%d %B, %Y')
            ];
        });
        return view('admin.customer.paymenthistory',compact('paymentHistories'));
    }
    public function customerDevicelist(Request $request,$id){
        $this->customer=$this->customer->findOrFail($id);
        $deviceList = $this->customer->deviceList->map(function ($item) {
            return [
                'id' => $item->id,
                'device_type' => $item->device_type->name,
                'device_name' => $item->device_name,
                'device_serial_num' => $item->device_serial_num,
                'added_date' => $item->added_date
            ];
        });
        return view('admin.customer.devicelist',compact('deviceList'));
    }

    public function customerWatchhistory(Request $request,$id){
        $this->customer=$this->customer->findOrFail($id);
        $customerHistory=VideoWatchCustomerRecord::where('customer_id',$this->customer->id)->with('viewVideo')->get()->map(function($item){
            return $item->viewVideo;
        });
        $viewData=$customerHistory->map(function($item){
            switch($item->type){
                case 1:
                    $movies = Movie::where('unique_code', $item->video_unique_code)->first();
                    $videoPath=$movies->movie_path;
                    $path=route('movie.update',$movies->id);
                    break;
                case 2:
                    $movies = TvSeriesPart::where('unique_code', $item->video_unique_code)->first();
                    $videoPath=$movies->video_path;
                    $path=route('tvseries.episodeedit',$movies->id);
                    break;
                case 3:
                    $movies = WebSeriesPart::where('unique_code',  $item->video_unique_code)->first();
                    $videoPath=$movies->video_path;
                    $path=route('webseries.episodeedit',$movies->id);
                    break;
            }
            return[
                'title'=>$movies->title,
                'slug'=>$movies->slug,
                'video_path'=>$videoPath,
                'date'=>$item->created_at->formatLocalized('%d %B %Y'),
                'path'=>$path,
                'poster'=>$movies->poster,
                'type'=>$movies->type
            ];
        });
        $viewData=PaginationHelper::paginate(collect($viewData), 5);
        return view('admin.customer.watchhistory',compact('viewData'));

    }

    public function setSubscription(Request $request,$id){
        $customer=Customer::findOrFail($id);
        $allSubscription=Subscription::where('status','active')->get();
        $paymentEnum=new ReflectionClass(PaymentTypeEnum::class);
        $paymentType=array_values($paymentEnum->getConstants());
        $susbcriptionPriceData=$allSubscription->map(function($item){
            return[
                'id'=>$item->id,
                'price'=>$item->price
            ];
        })->toArray();
        return view('admin.customer.setsubscription',compact('customer','allSubscription','paymentType','susbcriptionPriceData'));
    }

    public function setSubscriptionAction(Request $request){
        $customer=Customer::findOrFail($request->customer_id);
        $subscription=Subscription::findOrFail($request->subscription_id);
        DB::beginTransaction();
        try{
            $request['refId']=Str::random(15);
            $data = $this->saveSubscriptionPaymentAdmin($request,$subscription,$customer);
            if(!$data){
                throw new Exception();
            }   
            $customer->manual_subscription='1';
            $customer->save();
            CustomerDeviceList::where('customer_id',$customer->id)->delete();
            DB::commit();
            $request->session()->flash('success','Subscription Added Successfully !!');
            return redirect()->route('customer.list');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();

        }
    }

    public function saveSubscriptionPaymentAdmin($request,$subscription,$customer)
    {
        $request['subscription_id'] = $subscription->id;
        $request['payment_type'] = $request->payment_type;
        $request['payment_status'] = '1';
        $request['amount'] = $request->amt;
        $request['transaction_id'] = $request->refId;
        $request['device_type'] = '3';
        $request['device_name'] = 'gvsfgvs';
        $request['device_serial_num'] = 'sdfsdfs';
        $request['remarks']=$request->remarks ?? null;
        $request['payment_from']='admin' ?? null;
        $customer = $customer;
        $data = (new SubscriptionPaymentAction($request, $this->subscriptionPayment, $customer, $this->subscriptionPaymentType))->subscriptionCallBackAction();
        $deviceList = $customer->deviceList;
        foreach ($deviceList as $list) {
            $list->delete();
        }
        (new CustomerAddDevice($customer))->setDeviceListMain($request);
        $paymentHistory = $customer->paymentHistories;
        return true;
    }

    public function searchCustomer(Request $request){
        $customersData=Customer::whereRaw('LOWER(email) like ?', ['%' . strtolower($request->searchValue) . '%'])->get();
        $url=route('search.customer');
        $customers=PaginationHelper::paginate(collect($customersData), 20)->withPath($url);
        return view('admin.searchcustomer',compact('customers'));
    }

    public function searchCustomerVerified(Request $request){
        $customersData=Customer::whereRaw('LOWER(email) like ?', ['%' . strtolower($request->searchValue) . '%'])->orderBy('id','DESC')->where('email_verified_at','!=',null)->get();
        $url=route('search.customer');
        $customers=PaginationHelper::paginate(collect($customersData), 20)->withPath($url);
        return view('admin.searchcustomer',compact('customers'));
    }

    public function searchCustomerActive(Request $request){
        $customersData=Customer::whereRaw('LOWER(email) like ?', ['%' . strtolower($request->searchValue) . '%'])->orderBy('id','DESC')->where('status',CustomerStatusEnum::ACTIVE)->get();
        $url=route('search.customer');
        $customers=PaginationHelper::paginate(collect($customersData), 20)->withPath($url);
        return view('admin.searchcustomer',compact('customers'));
    }

    public function searchCustomerInActive(Request $request){
        $customersData=Customer::whereRaw('LOWER(email) like ?', ['%' . strtolower($request->searchValue) . '%'])->orderBy('id','DESC')->where('status',CustomerStatusEnum::INACTIVE)->get();
        $url=route('search.customer');
        $customers=PaginationHelper::paginate(collect($customersData), 20)->withPath($url);
        return view('admin.searchcustomer',compact('customers'));
    }

    public function searchCustomerBlocked(Request $request){
        $customersData=Customer::whereRaw('LOWER(email) like ?', ['%' . strtolower($request->searchValue) . '%'])->orderBy('id','DESC')->where('status',CustomerStatusEnum::BLOCKED)->get();
        $url=route('search.customer');
        $customers=PaginationHelper::paginate(collect($customersData), 20)->withPath($url);
        return view('admin.searchcustomer',compact('customers'));
    }

    public function searchCustomerSubscription(Request $request){
        $customersData=Customer::whereRaw('LOWER(email) like ?', ['%' . strtolower($request->searchValue) . '%'])->whereHas('subscription')->orderBy('id','DESC')->get();
        $url=route('search.customer');
        $customers=PaginationHelper::paginate(collect($customersData), 20)->withPath($url);
        return view('admin.searchcustomer',compact('customers'));
    }


    public function update(CustomerUpdateRequest $request,$id){
        
        DB::beginTransaction();
        try{
            $data=$request->all();
            
            $this->customer=Customer::findOrFail($id);
            $this->customer->fill($data);
            $this->customer->save();
            // dd($request->all());
            $temp=[
                'customer_id'=>$this->customer->id,
                'gender'=>$data['gender'],
                'date_of_birth'=>$data['date_of_birth'],
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'photo'=>$data['photo']
            ];
            if($data['photo'] !=$this->customer->customerDetail->photo){
                $temp['photo_from']='web';
            }
            if($this->customer->customerDetail){
                $this->customer->customerDetail->update($temp);
            }else{
                $this->customerDetail->insert($temp);
            }
            
            DB::commit();
            $request->session()->flash('success','Customer Updated Successfully !!');
            return redirect()->route('customer.list');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();

        }
    }

    public function destroy(Request $request,$id){
        
        DB::beginTransaction();
        try{
            $this->customer=Customer::findOrFail($id);
            $this->customer->delete();
            
            DB::commit();
            $request->session()->flash('success','Customer Deleted Successfully !!');
            return redirect()->route('customer.list');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();

        }
    }

    public function downloadInvoice(Request $request,$invoiceNum){
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

    public function customerDeleteDeviceList(Request $request,$id){
        DB::beginTransaction();
        try{
            $deviceData=CustomerDeviceList::where('id',$id)->first();
            $deviceData->delete();
            DB::commit();
            $request->session()->flash('success','Device Removed Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
    
}
