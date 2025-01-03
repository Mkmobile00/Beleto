<?php

namespace Database\Seeders;

use App\Models\CustomerDetail;
use Illuminate\Database\Seeder;
use App\Models\Customer\Customer;
use App\Enum\Customer\CustomerStatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Validation\Rules\Exists;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
class CustomerImportSeeder extends Seeder
{
    
    public function run(): void
    {
        Log::info('test'); // Move this inside the run method
        
        // Your other code here...
    }
    /**
     * Run the database seeds.
     */
//     public function run(): void
//     {
//         system('ipconfig /all');  
   
//    //Storing output in a variable 
//    $configdata=ob_get_contents();  
   
//    // Clear the buffer  
//    ob_clean();  
   
//    //Extract only the physical address or Mac address from the output
//    $mac = "Physical";  
//    $pmac = strpos($configdata, $mac);
   
//    // Get Physical Address  
//    $macaddr=substr($configdata,($pmac+36),17);  
   
//    //Display Mac Address  
//    dd($macaddr);
        // Customer::onlyTrashed()->forceDelete();
        // dd('ok');
        // foreach($softDeletedCustomers as $data){
        //     // dd($data);
        //     $data->delete();
        // }
        // $customer=Customer::get();
        // foreach($customer as $data){
        //     $data->delete();
        // }
        // // dd($customer[0]);
        // dd('success','ok');
        // $file = fopen(public_path('user.csv'), 'r'); 
        // // dd($file,'ok success');
        // if ($file) {
        //     while (($data = fgetcsv($file)) !== false) {
        //         if($data && $data[4]){
        //             if(!checikUnique($data[4])){
        //                 $dataValue=[
        //                     'email'=>$data[4],
        //                     'email_or_phone'=>'1',
        //                     'status'=>CustomerStatusEnum::INACTIVE->value,
        //                     'verified_from'=>'Web',
        //                     'password'=>bcrypt('kantipurcinemas123987'),
        //                     'login_type'=>'2',
        //                     'platform'=>'Windows',
        //                     'from_old'=>'1',
        //                     'old_user_id'=>$data[0]
        //                 ];
        //                 $customer=Customer::create($dataValue);
        //                 // $dataValue['customer_id']=$customer->id;
        //                 $temp=[
        //                     'first_name'=>$data[1] ?? null,
        //                     'customer_id'=>$customer->id,
        //                     'gender'=>'1',
        //                     'photo_status'=>'main'
        //                 ];
        //                 CustomerDetail::insert($temp);
        //             }
                   
        //         }
                   
                
        //     }

        //     fclose($file);
        // }

        

        // Create a new Process instance
        $process = new Process(['getmac']);
        
        // Execute the process
        $process->run();
        
        // Check if the process was successful
        if (!$process->isSuccessful()) {
            throw new \RuntimeException('Error executing the command: '.$process->getErrorOutput());
        }
        
        // Get the output of the command
        $output = $process->getOutput();
        
        // Do something with the output
        echo $output;
        dd('success');
    }
}
