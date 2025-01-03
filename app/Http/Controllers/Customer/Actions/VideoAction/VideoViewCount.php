<?php
namespace App\Actions\VideoAction;

use App\Models\VideoView;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Models\VideoWatchCustomerRecord;

class VideoViewCount{

    protected $customer;
    protected $movies;
    public function __construct($movies,Customer $customer)
    {
        $this->customer=$customer;
        $this->movies=$movies;
        $this->increaseCount();
    }

    public function increaseCount(){
        $videoView=VideoView::where('video_unique_code',$this->movies->unique_code)->first();
        if(!$videoView){
            $videoView=new VideoView();
            $data=[
                'video_unique_code'=>$this->movies->unique_code,
                'view_count'=>1,
                'type'=>$this->movies->type
            ];
            $videoView->fill($data);
            $videoView->save();
        }else{
            $videoView->view_count=$videoView->view_count+1;
            $videoView->save();
        }

        VideoWatchCustomerRecord::create([
            'video_views_id'=>$videoView->id,
            'customer_id'=>$this->customer->id
        ]);
    }
}