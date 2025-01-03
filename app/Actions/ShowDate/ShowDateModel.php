<?php
namespace App\Actions\ShowDate;

use App\Models\ShowDates;
use Exception;

class ShowDateModel{

    protected $data;
    protected $showDate;
    public function __construct($data)
    {
        $this->data=$data;
        $this->showDate=new ShowDates();
    }

    public function create(){
        $this->showDate->fill($this->data);
        $this->showDate->save();
        if(!$this->showDate){
            throw new Exception();
        }
        return $this->showDate;
    }

}
