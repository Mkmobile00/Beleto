<?php
namespace App\Actions\ShowDate;

use App\Models\ShowDates;
use App\Models\ShowDatesTimeSlot;

 class ShowTimeSlot{

    protected $showDate;
    protected $startTime;
    protected $endTime;
    protected $timeSlot=[];
    protected $showDateTimeSlot;
    public function __construct(ShowDates $showDate)
    {
        $this->showDate=$showDate;
        $this->showDateTimeSlot=new ShowDatesTimeSlot();
    }

    public function create(Array $startTime,Array $endTime){
        $this->startTime=$startTime;
        $this->endTime=$endTime;
        $this->arrangeSlotTimeArray();
        $this->showDateTimeSlot->insert($this->timeSlot);

    }

    public function arrangeSlotTimeArray(){
        foreach($this->startTime as $key=>$time){
            $this->timeSlot[]=[
                'show_date_id'=>$this->showDate->id,
                'start_time'=>$time,
                'end_time'=>$this->endTime[$key]
            ];
        }
    }
 }
