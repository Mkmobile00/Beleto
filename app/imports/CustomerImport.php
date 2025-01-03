<?php

namespace App\Imports;

use App\Models\CustomerDetail;
use App\Models\Customer\Customer;
use Illuminate\Support\Collection;
use App\Enum\Customer\CustomerStatusEnum;
use Maatwebsite\Excel\Concerns\ToCollection;

class CustomerImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        dd('sanmu');
        ini_set('max_execution_time',3600);
        foreach ($rows as $key => $row) {
            if($row && $row['4']){
                $data[]=[
                    'email'=>$row['4'],
                    'email_or_phone'=>1,
                    'status'=>CustomerStatusEnum::INACTIVE->value,
                    'verified_from'=>'Web',
                    'password'=>bcrypt('kantipurcinemas123987'),
                    'login_type'=>'2',
                    'platform'=>'Windows',
                    'from_old'=>'1',
                    'old_user_id'=>$row[0]
                ];
                // dd($data,$row);
                // $customer=Customer::create($data);
                // $data['customer_id']=$customer->id;
                // $temp=[
                //     'customer_id'=>$customer->id,
                //     'gender'=>'1',
                //     'photo_status'=>'main',
                //     'first_name'=>$row[1]
                // ];
                // CustomerDetail::insert($temp);
            }
            
            // event(new SetOldCustomerSubscription($customer));
           
        }
        dd($data);
    }
   
}
