<?php
namespace App\Http\Traits;

trait UniqueIdGenerator{

    public function getUniqueId($model,$prefix,$field)
    {
        $modelInstance = '\App\Models\\' . $model;
        $data = $modelInstance::get();
        $uniqueId=$prefix.rand(11111,99999);
        $exists=$data->where($field,$uniqueId)->first();
        if($exists)
        {
            $this->getUniqueId($model,$prefix,$field);
        }
        return $uniqueId;

    }
}