<?php
namespace App\Actions\ShowDate;

use App\Actions\ShowDate\ShowTimeSlot;
use App\Models\Shows;
use Exception;
use Illuminate\Http\Request;

class ShowDateAction{
    protected $request;
    protected $dateArray;
    protected $show;

    public function __construct(Request $request,Shows $show){
        $this->request=$request;
        $this->show=$show;
        $this->arrangeDatesRequest();
        $this->finalizeShowDates();
    }

    public function arrangeDatesRequest(){
        $stringDate=$this->request->date_range;
        if(!$stringDate || $stringDate==null){
            throw new Exception();
        }
        $explodedDate=explode('-',$this->request->date_range);
        if($explodedDate < 2){
            throw new Exception();
        }
        for($i=0;$i<=(count($explodedDate)-1);$i++){
            $this->dateArray[]=trim($explodedDate[$i]);
        }
        $this->dateArray=collect($this->dateArray)->unique();
    }

    public function finalizeShowDates(){
        foreach($this->dateArray as $date){
            $data=[
                'show_id'=>$this->show->id,
                'date'=>$date,
            ];
            $createdData=(new ShowDateModel($data))->create();
            if(!$createdData){
                throw new Exception();
            }
            (new ShowTimeSlot($createdData))->create($this->request->start_time,$this->request->end_time);
        }
    }
}
