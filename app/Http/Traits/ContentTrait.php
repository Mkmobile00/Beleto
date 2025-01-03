<?php
namespace App\Http\Traits;

trait ContentTrait{

    public function premiumContent(){
        return [
            [
                'title'=>'Premium content',
                'child'=>true,
                'type'=>'option',
                'show_child'=>[
                    'Movies', 'Web Series', 'TV Shows', 'Downloads'
                ]
            ],
            [
                'title'=>'Live TV',
                'child'=>false,
                'type'=>'option',
                'show_title'=>[]
            ],
            [
                'title'=>'Ad-free',
                'child'=>false,
                'type'=>'option',
                'show_title'=>[]
            ],
            [
                'title'=>'Device',
                'child'=>true,
                'type'=>'option',
                'show_title'=>[
                    'TV', 'Laptop'
                ]
            ],
            [
                'title'=>'No. of screens',
                'child'=>false,
                'type'=>'int',
                'show_title'=>[]
            ],
            [
                'title'=>'Max video quality',
                'child'=>false,
                'type'=>'none',
                'show_title'=>[]
            ],
            [
                'title'=>'Max audio quality',
                'child'=>false,
                'type'=>'none',
                'show_title'=>[]
            ]
            
        ];
    }
}