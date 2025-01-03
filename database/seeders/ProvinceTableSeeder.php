<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('provinces')->truncate();
        $data = [
            [
                'eng_name' => 'Province 1',
                'status' => 'active',
            ],
            [
                'eng_name' => 'Province 2',
                'status' => 'active',
            ],
            [
                'eng_name' => 'Bagmati',
                'status' => 'active',
            ],
            [
                'eng_name' => 'Gandaki',
                'status' => 'active',
            ],
            [
                'eng_name' => 'Province 5',
                'status' => 'active',
            ],
            [
                'eng_name' => 'Karnali',
                'status' => 'active',
            ],
            [
                'eng_name' => 'Province 7',
                'status' => 'active',
            ]
        ];
        DB::table('provinces')->insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
