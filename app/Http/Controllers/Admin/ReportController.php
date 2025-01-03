<?php

namespace App\Http\Controllers\Admin;

use App\Enum\PaymentStatusEnum;
use ReflectionClass;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Enum\PaymentTypeEnum;
use App\Models\PaymentHistory;
use Illuminate\Support\Carbon;
use App\Utilities\PaginationHelper;
use App\Http\Controllers\Controller;
use Faker\Provider\ar_EG\Payment;

class ReportController extends Controller
{
    public function allTransaction(Request $request){
        $filters=[
            'paymenttype'=>$request->paymenttype ?? null,
            'email_or_phone'=>$request->email_or_phone ?? null,
            'from'=>$request->from ?? null,
            'to'=>$request->to ?? null,
            'invoicenum'=>$request->invoicenum ?? null,
            'per_page'=>$request->per_page=='All' ? 100000 : $request->per_page ?? 10
        ];
        // dd($filters);
        $alltransaction = PaymentHistory::orderBy('id','DESC')->get()->map(function ($item) {
            return [
                'title' => 'Online Payment',
                'amount' => ($item->amount_type == 'npr' ? ('NPR '.$item->amount) : ('$ '.$item->amount.'('.'NPR '.$item->amount*100 .')')),
                'kantipur_cinemas_commission'=>'NPR '. ($item->amount_type == 'npr' ? ((float)$item->amount)-((float)$item->amount*5/100) : ((float)$item->amount *100)-((float)$item->amount *100*5/100)),
                'nectar_commission'=>'NPR '.($item->amount_type == 'npr' ? ((float)$item->amount*5/100 ): ((float)$item->amount *100 *5/100)) ,
                'operator' => $item->payment_type->name,
                'type' => 'Online',
                'invoice_num' => $item->transaction_id,
                'for_payment' => $item->purpose,
                'customer' => $item->customer ? $item->customer->customerDetail->first_name .' '.$item->customer->customerDetail->last_name:'',
                'email_phone' => $item->customer ? $item->customer->email .' '.$item->customer->phone:'',
                'date' => Carbon::parse($item->created_at)->formatLocalized('%d %B, %Y'),
                'final_date'=>Carbon::parse($item->created_at)->format('H:i:s A'),
                'paymenttype' => $item->payment_type->value,
                'paidFor'=>$item->from_model::where('id', $item->model_id)->first()->subscription->title ?? null,
                'totalAmount'=>($item->amount_type == 'npr' ? (float)$item->amount : $item->amount*100),
                'created_at'=>$item->created_at,
                'remarks'=>$item->remarks,
                'payment_from'=>$item->from_model::where('id', $item->model_id)->first()->payment_from ?? null
            ];
        })->when(Arr::get($filters,'paymenttype'), function ($item, $value) {
            return $item->map(function ($data) use ($value) {
                if ($data['paymenttype'] == $value) {
                    return $data;
                }
            });
        })->when(Arr::get($filters, 'email_or_phone'), function ($item, $value) {
            if ($item && count($item->whereNotNull()) > 0) {
                return $item->filter(function ($data) use ($value) {
                    return isset($data['email_phone']) && strpos($data['email_phone'], $value) !== false;
                });
            }
        })
        ->when(Arr::get($filters,'from'), function ($item, $value) {
            if(count($item->whereNotNull()) > 0){
                return $item->map(function ($data) use ($value) {
                    if ($data['final_date'] >= $value) {
                        return $data;
                    }
                });
            }
        })->when(Arr::get($filters,'to'), function ($item, $value) {
            if(count($item->whereNotNull()) > 0){
                return $item->map(function ($data) use ($value) {
                    if ($data['final_date'] <= $value) {
                        return $data;
                    }
                });
            }
        })->when(Arr::get($filters,'invoicenum'), function ($item, $value) {
            if(count($item->whereNotNull()) > 0){
                return $item->filter(function ($data) use ($value) {
                    return $data['invoice_num'] && strpos($data['invoice_num'], $value) !== false;
                });
            }
        });
        $allPaymentHistory=PaymentHistory::orderBy('payment_type','ASC')->get();
        $commissionData = $allPaymentHistory->map(function ($item) {
            return [
                'kantipur_cinemas_commission'=>($item->amount_type == 'npr' ? ((float)$item->amount)-((float)$item->amount*5/100) : ((float)$item->amount *100)-((float)$item->amount *100*5/100)),
                'nectar_commission'=>($item->amount_type == 'npr' ? ((float)$item->amount*5/100 ): ((float)$item->amount *100 *5/100)) ,
                'payment_from'=>$item->from_model::where('id', $item->model_id)->first()->payment_from ?? null
            ];
        });
        $subscriptionPaymentFromCollection=$commissionData->groupBy('payment_from');
        $selfData=$commissionData->where('payment_from','self')->count();
        $adminData=$commissionData->where('payment_from','admin')->count();
        
        $totalKantipurCommission=collect($commissionData)->sum('kantipur_cinemas_commission');
        $totalNectarCommission=collect($commissionData)->sum('nectar_commission');
        $appenData=[
            [
                'title'=>'Kantipur',
                'amount'=>number_format($totalKantipurCommission,2),
                'currency'=>'NPR'
            ],
            [
                'title'=>'Nectardigit',
                'amount'=>number_format($totalNectarCommission,2),
                'currency'=>'NPR'
            ]
        ];
        $paymentHistoryByPaymentType=$allPaymentHistory->groupBy('payment_type')->map(function($key,$item){
            // dd($key,$item);
            switch($item){
                case 1://esewa
                    return $this->arrangePaymentStatusData('Esewa',number_format(collect($key)->sum('amount'),2));
                    break;
                case 2://khalti
                    return $this->arrangePaymentStatusData('Khalti',number_format(collect($key)->sum('amount'),2));
                    break;
                case 3://hamropay
                    return $this->arrangePaymentStatusData('HamroPay',number_format(collect($key)->sum('amount'),2));
                    break;
                case 4://imepay
                    return $this->arrangePaymentStatusData('ImePay',number_format(collect($key)->sum('amount'),2));
                    break;
                case 5://paypal
                    return $this->arrangePaymentStatusData('Paypal',number_format(collect($key)->sum('amount'),2),'$');
                    break;
                case 6://prabhupay
                    return $this->arrangePaymentStatusData('PrabhuPay',number_format(collect($key)->sum('amount'),2));
                    break;
                case 7://bank
                    return $this->arrangePaymentStatusData('Bank',number_format(collect($key)->sum('amount'),2));
                    break;
                case 8://cash
                    return $this->arrangePaymentStatusData('Cash',number_format(collect($key)->sum('amount'),2));
                    break;
                default:
                    break;
            }
        });
        $paymentHistoryByPaymentType=array_merge($appenData,$paymentHistoryByPaymentType->toArray());
        $alltransaction=collect($alltransaction)->whereNotNull();
        // $overAllTransaction=number_format($allPaymentHistory->sum('amount'),2);
        $overAllTransaction=number_format($totalKantipurCommission+$totalNectarCommission,2);
        $todayCollection = number_format($allPaymentHistory->filter(function ($data) {
            return Carbon::parse($data['created_at'])->toDateString() === today()->toDateString();
        })->sum('amount'),2);
        $url=route('alltransaction.view',$filters);
        $alltransaction= PaginationHelper::paginate(collect($alltransaction), $filters['per_page'])->withPath($url);
        $paymentTypes=new ReflectionClass(PaymentTypeEnum::class);
        $paymentTypes=array_values($paymentTypes->getConstants());
        return view('admin.report.alltransaction',compact('alltransaction','paymentTypes','overAllTransaction','todayCollection','paymentHistoryByPaymentType','adminData','selfData'));
    }

    public function arrangePaymentStatusData($title,$amount,$currency='NPR'){
        return[
            'title'=>$title,
            'amount'=>$amount,
            'currency'=>$currency
        ];
    }
}
