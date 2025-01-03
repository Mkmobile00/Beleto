<?php
namespace App\Data\FeaturedSection;

use ReflectionClass;
use App\Enum\FeaturedSection\FeaturedSectionTypeEnum;
use App\Enum\Setting\VideoEnum;

class FeaturedType{

    protected $types;
    protected $status;
    public function __construct()
    {
        $this->getType();
        $this->getStatusType();
    }

    public function getType(){
        $this->types=new ReflectionClass(FeaturedSectionTypeEnum::class);
        $this->types=array_values($this->types->getConstants());
    }

    public function getStatusType(){
        $this->status=new ReflectionClass(VideoEnum::class);
        $this->status=array_values($this->status->getConstants());
    }

    public function getAllValues(){
        return [
            'types'=>$this->types,
            'status'=>$this->status
        ];
    }
}