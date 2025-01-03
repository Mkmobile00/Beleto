<?php
namespace App\Http\Traits;

use Exception;
use App\Models\Movie;
use App\Models\PushNotification;
use App\Actions\Customer\NotificationArray;
use App\Enum\PushNotification\NotificationUserType;
use App\Models\Customer\Customer;
use App\Models\CustomerNotificationList;

trait NotificationTrait{

    
    public function pushNotification(PushNotification $pushNotification){
        switch($pushNotification->for){
            case NotificationUserType::ALL:
                $this->saveCustomerNotification($pushNotification);
                $this->pushGeneralNotification($pushNotification);
                $this->pushGeneralNotification1($pushNotification);
                break;
            case NotificationUserType::SELECTED:
                $customer=$pushNotification->customer->pluck('customer_id');
                foreach($customer as $id){
                    $this->pushInvidualNotification($pushNotification,$id);
                    $this->saveCustomerNotificationSelected($pushNotification,$id);
                }
                break;
            default:
            throw new Exception();
            break;
        }
    }
    public function pushGeneralNotification($pushNotification)
    {
        
        $serverKey = 'AAAAmfXJoYU:APA91bFJNiXLlmldpWTd1-pmy5bENGm8L9arH9Mw4JRNwngdhrbWE7UaRtEM9Fq3IQihBAzaU-bNEggwIWMaZPq5TKJF-Wqla88MB30eZLsEFpznavIlxxEQbvV0Z6sTQhYx_RWTjvpu';
        $notification = [
            'title' => $pushNotification->title,
            'type'=>'general',
            'body'=>(string)$pushNotification->description ?? '',
            'summary'=>$pushNotification->summary ?? '',
            'sound' => 'default',
            'icon'=>$pushNotification->image ?? '',
            'is_personal'=>false,
            'image'=>$pushNotification->image ?? '',
        ];
        $message = [
            'to' => '/topics/generalkantipur',
            'notification' => $notification,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($message),
            CURLOPT_HTTPHEADER => [
                'Authorization: key=' . $serverKey,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
    }
    public function pushGeneralNotification1($pushNotification)
    {
        
        $serverKey = 'AAAAH76kRls:APA91bHEjr3fdgztul44hPn_3HUIYXvaYYl3IKv2hOJ-mbrgPFWeUREI13hisxL8F4MuIYPGjwm3QaZsNGZZk0dQF2bHj4JfWOylTglVQrn33C_Tf-0Bumxlw6swaHfo5hc5hUu-_Ojv';
        $notification = [
            'title' => $pushNotification->title,
            'type'=>'general',
            'body'=>(string)$pushNotification->description ?? '',
            'summary'=>$pushNotification->summary ?? '',
            'sound' => 'default',
            'icon'=>$pushNotification->image ?? '',
            'is_personal'=>false,
            'image'=>$pushNotification->image ?? '',
        ];
        $message = [
            'to' => '/topics/generalkantipur',
            'notification' => $notification,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($message),
            CURLOPT_HTTPHEADER => [
                'Authorization: key=' . $serverKey,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
    }

    public function pushInvidualNotification($pushNotification,$id){
        $serverKey = 'AAAAmfXJoYU:APA91bFJNiXLlmldpWTd1-pmy5bENGm8L9arH9Mw4JRNwngdhrbWE7UaRtEM9Fq3IQihBAzaU-bNEggwIWMaZPq5TKJF-Wqla88MB30eZLsEFpznavIlxxEQbvV0Z6sTQhYx_RWTjvpu';
        $notification = [
            'title' => $pushNotification->title,
            'type'=>'general',
            'body'=>(string)$pushNotification->description ?? '',
            'summary'=>$pushNotification->summary ?? '',
            'sound' => 'default',
            'icon'=>$pushNotification->image ?? '',
            'is_personal'=>false,
            'image'=>$pushNotification->image ?? '',
            ''
        ];
        $message = [
            'to' => '/topics/individual_'.$id,
            'notification' => $notification,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($message),
            CURLOPT_HTTPHEADER => [
                'Authorization: key=' . $serverKey,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
    }

    public function newMovieNotification(Movie $movie){
        $serverKey = 'AAAAmfXJoYU:APA91bFJNiXLlmldpWTd1-pmy5bENGm8L9arH9Mw4JRNwngdhrbWE7UaRtEM9Fq3IQihBAzaU-bNEggwIWMaZPq5TKJF-Wqla88MB30eZLsEFpznavIlxxEQbvV0Z6sTQhYx_RWTjvpu';
        $notification = [
            'title' => $movie->title,
            'type'=>'general',
            'body'=>(string)$movie->description ?? '',
            'summary'=>$movie->description ?? '',
            'sound' => 'default',
            'icon'=>$movie->poster ?? '',
            'is_personal'=>false,
            'image'=>$movie->poster ?? '',
            ''
        ];
        $message = [
            'to' => '/topics/generalkantipur',
            'notification' => $notification,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($message),
            CURLOPT_HTTPHEADER => [
                'Authorization: key=' . $serverKey,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
    }
    public function newMovieNotification1(Movie $movie){
        $serverKey = 'AAAAH76kRls:APA91bHEjr3fdgztul44hPn_3HUIYXvaYYl3IKv2hOJ-mbrgPFWeUREI13hisxL8F4MuIYPGjwm3QaZsNGZZk0dQF2bHj4JfWOylTglVQrn33C_Tf-0Bumxlw6swaHfo5hc5hUu-_Ojv';
        $notification = [
            'title' => $movie->title,
            'type'=>'general',
            'body'=>(string)$movie->description ?? '',
            'summary'=>$movie->description ?? '',
            'sound' => 'default',
            'icon'=>$movie->poster ?? '',
            'is_personal'=>false,
            'image'=>$movie->poster ?? '',
            ''
        ];
        $message = [
            'to' => '/topics/generalkantipur',
            'notification' => $notification,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($message),
            CURLOPT_HTTPHEADER => [
                'Authorization: key=' . $serverKey,
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
    }

    public function saveCustomerNotification($pushNotification){
        $customers=Customer::get();
        foreach($customers as $customer){
            $paymentData = (new NotificationArray(
                $customer->id,
                get_class($pushNotification->getModel()),
                $pushNotification->id
            ))->getData();
            CustomerNotificationList::create($paymentData);
        }
        
    }
    public function saveCustomerNotificationSelected($pushNotification,$id){
        $paymentData = (new NotificationArray(
            $id,
            get_class($pushNotification->getModel()),
            $pushNotification->id
        ))->getData();
        CustomerNotificationList::create($paymentData);
        
    }
}