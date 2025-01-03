<?php

namespace Database\Seeders;

use App\Models\PassType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PassTYpeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type=[
            [
                'title'=>'VVIP',
                'status'=>'1'
            ],
            [
                'title'=>'VIP',
                'status'=>'1'
            ],
            [
                'title'=>'Standard',
                'status'=>'1'
            ],
            [
                'title'=>'Normal',
                'status'=>'1'
            ]
        ];

        PassType::insert($type);
    }
}
