<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocalLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('locals')->truncate();
        DB::table('locals')->insert([
        [
            "id"=> "9",
            "local_level_id"=> "9",
            "province_id"=> "3",
            "local_id"=> "3.101",
            "local_name"=> "Kathmandu Metropolitan",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "10",
            "local_level_id"=> "10",
            "province_id"=> "3",
            "local_id"=> "3.102",
            "local_name"=> "Lalitpur Metropolitan",
            "dist_id"=> "28",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "11",
            "local_level_id"=> "11",
            "province_id"=> "3",
            "local_id"=> "3.103",
            "local_name"=> "Bharatpur Metropolitan",
            "dist_id"=> "35",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "12",
            "local_level_id"=> "12",
            "province_id"=> "4",
            "local_id"=> "3.104",
            "local_name"=> "Pokhara Metropolitan",
            "dist_id"=> "47",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "13",
            "local_level_id"=> "13",
            "province_id"=> "1",
            "local_id"=> "3.111",
            "local_name"=> "Itahari Sub-Metropolitan",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "14",
            "local_level_id"=> "14",
            "province_id"=> "1",
            "local_id"=> "3.112",
            "local_name"=> "Dharan Sub-Metropolitan",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "15",
            "local_level_id"=> "15",
            "province_id"=> "1",
            "local_id"=> "3.113",
            "local_name"=> "Biratnagar Metropolitan",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "16",
            "local_level_id"=> "16",
            "province_id"=> "2",
            "local_id"=> "3.114",
            "local_name"=> "Janakpur Sub-Metropolitan",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "17",
            "local_level_id"=> "17",
            "province_id"=> "3",
            "local_id"=> "3.115",
            "local_name"=> "Hetauda Sub-Metropolitan",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "18",
            "local_level_id"=> "18",
            "province_id"=> "2",
            "local_id"=> "3.116",
            "local_name"=> "Kallaiya Sub-Metropolitan",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "19",
            "local_level_id"=> "19",
            "province_id"=> "2",
            "local_id"=> "3.117",
            "local_name"=> "Jitpur-Simr Sub-Metropolitan",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "20",
            "local_level_id"=> "20",
            "province_id"=> "2",
            "local_id"=> "3.118",
            "local_name"=> "Birgunj Metropolitan",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "21",
            "local_level_id"=> "21",
            "province_id"=> "5",
            "local_id"=> "3.119",
            "local_name"=> "Butwal Sub-Metropolitan",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "22",
            "local_level_id"=> "22",
            "province_id"=> "5",
            "local_id"=> "3.12",
            "local_name"=> "Ghorahi Sub-Metropolitan",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "23",
            "local_level_id"=> "23",
            "province_id"=> "5",
            "local_id"=> "3.121",
            "local_name"=> "Tulsipur Sub-Metropolitan",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "24",
            "local_level_id"=> "24",
            "province_id"=> "5",
            "local_id"=> "3.122",
            "local_name"=> "Nepalgunj Sub-Metropolitan",
            "dist_id"=> "62",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "25",
            "local_level_id"=> "25",
            "province_id"=> "7",
            "local_id"=> "3.123",
            "local_name"=> "Dhangadi Sub-Metropolitan",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "26",
            "local_level_id"=> "26",
            "province_id"=> "1",
            "local_id"=> "3.131",
            "local_name"=> "Phungling Muncipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "27",
            "local_level_id"=> "27",
            "province_id"=> "1",
            "local_id"=> "3.132",
            "local_name"=> "Phidim Municipality",
            "dist_id"=> "2",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "28",
            "local_level_id"=> "28",
            "province_id"=> "1",
            "local_id"=> "3.133",
            "local_name"=> "Ilam Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "29",
            "local_level_id"=> "29",
            "province_id"=> "1",
            "local_id"=> "3.134",
            "local_name"=> "Dewmai Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "30",
            "local_level_id"=> "30",
            "province_id"=> "1",
            "local_id"=> "3.135",
            "local_name"=> "Mai Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "31",
            "local_level_id"=> "31",
            "province_id"=> "1",
            "local_id"=> "3.136",
            "local_name"=> "Suryodaya Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "32",
            "local_level_id"=> "32",
            "province_id"=> "1",
            "local_id"=> "3.137",
            "local_name"=> "Arjundhara Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "33",
            "local_level_id"=> "33",
            "province_id"=> "1",
            "local_id"=> "3.138",
            "local_name"=> "Kankai Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "34",
            "local_level_id"=> "34",
            "province_id"=> "1",
            "local_id"=> "3.139",
            "local_name"=> "Gaurdah Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "35",
            "local_level_id"=> "35",
            "province_id"=> "1",
            "local_id"=> "3.14",
            "local_name"=> "Damak Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "36",
            "local_level_id"=> "36",
            "province_id"=> "1",
            "local_id"=> "3.141",
            "local_name"=> "Birtamod Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "37",
            "local_level_id"=> "37",
            "province_id"=> "1",
            "local_id"=> "3.142",
            "local_name"=> "Bhadrapur Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "38",
            "local_level_id"=> "38",
            "province_id"=> "1",
            "local_id"=> "3.143",
            "local_name"=> "Mechinagar Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "39",
            "local_level_id"=> "39",
            "province_id"=> "1",
            "local_id"=> "3.144",
            "local_name"=> "Shivasatakshi Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "40",
            "local_level_id"=> "40",
            "province_id"=> "1",
            "local_id"=> "3.145",
            "local_name"=> "Khandbari Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "41",
            "local_level_id"=> "41",
            "province_id"=> "1",
            "local_id"=> "3.146",
            "local_name"=> "Chainpur Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "42",
            "local_level_id"=> "42",
            "province_id"=> "1",
            "local_id"=> "3.147",
            "local_name"=> "Dharmadevi Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "43",
            "local_level_id"=> "43",
            "province_id"=> "1",
            "local_id"=> "3.148",
            "local_name"=> "Panchkhapan Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "44",
            "local_level_id"=> "44",
            "province_id"=> "1",
            "local_id"=> "3.149",
            "local_name"=> "Madi Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "45",
            "local_level_id"=> "45",
            "province_id"=> "1",
            "local_id"=> "3.15",
            "local_name"=> "Myanglung Municipality",
            "dist_id"=> "6",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "46",
            "local_level_id"=> "46",
            "province_id"=> "1",
            "local_id"=> "3.151",
            "local_name"=> "Laligurans Municipality",
            "dist_id"=> "6",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "47",
            "local_level_id"=> "47",
            "province_id"=> "1",
            "local_id"=> "3.152",
            "local_name"=> "Bhojpur Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "48",
            "local_level_id"=> "48",
            "province_id"=> "1",
            "local_id"=> "3.153",
            "local_name"=> "Shadananda Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "49",
            "local_level_id"=> "49",
            "province_id"=> "1",
            "local_id"=> "3.154",
            "local_name"=> "Dhankuta Municipality",
            "dist_id"=> "8",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "50",
            "local_level_id"=> "50",
            "province_id"=> "1",
            "local_id"=> "3.155",
            "local_name"=> "Pakhribash Municipality",
            "dist_id"=> "8",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "51",
            "local_level_id"=> "51",
            "province_id"=> "1",
            "local_id"=> "3.156",
            "local_name"=> "Mahalaxmi Municipality",
            "dist_id"=> "8",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "52",
            "local_level_id"=> "52",
            "province_id"=> "1",
            "local_id"=> "3.157",
            "local_name"=> "Inruwa Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "53",
            "local_level_id"=> "53",
            "province_id"=> "1",
            "local_id"=> "3.158",
            "local_name"=> "Duhawi Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "54",
            "local_level_id"=> "54",
            "province_id"=> "1",
            "local_id"=> "3.159",
            "local_name"=> "Barahachhetra Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "55",
            "local_level_id"=> "55",
            "province_id"=> "1",
            "local_id"=> "3.16",
            "local_name"=> "Ramdhuni Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "56",
            "local_level_id"=> "56",
            "province_id"=> "1",
            "local_id"=> "3.161",
            "local_name"=> "Urlabari Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "57",
            "local_level_id"=> "57",
            "province_id"=> "1",
            "local_id"=> "3.162",
            "local_name"=> "Pathari Shanishchare Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "58",
            "local_level_id"=> "58",
            "province_id"=> "1",
            "local_id"=> "3.163",
            "local_name"=> "Belbari Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "59",
            "local_level_id"=> "59",
            "province_id"=> "1",
            "local_id"=> "3.164",
            "local_name"=> "Rangoli Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "60",
            "local_level_id"=> "60",
            "province_id"=> "1",
            "local_id"=> "3.165",
            "local_name"=> "Ratuwamai Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "61",
            "local_level_id"=> "61",
            "province_id"=> "1",
            "local_id"=> "3.166",
            "local_name"=> "Lotang Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "62",
            "local_level_id"=> "62",
            "province_id"=> "1",
            "local_id"=> "3.167",
            "local_name"=> "Sunawarshi Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "63",
            "local_level_id"=> "63",
            "province_id"=> "1",
            "local_id"=> "3.168",
            "local_name"=> "Sunderharaicha Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "64",
            "local_level_id"=> "64",
            "province_id"=> "1",
            "local_id"=> "3.169",
            "local_name"=> "Solududhkunda Municipality",
            "dist_id"=> "11",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "65",
            "local_level_id"=> "65",
            "province_id"=> "1",
            "local_id"=> "3.17",
            "local_name"=> "Diktel Rupakot Majhuwagadhi Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "66",
            "local_level_id"=> "66",
            "province_id"=> "1",
            "local_id"=> "3.171",
            "local_name"=> "Halesi Tuwachung Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "67",
            "local_level_id"=> "67",
            "province_id"=> "1",
            "local_id"=> "3.172",
            "local_name"=> "Katari Municipality",
            "dist_id"=> "13",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "68",
            "local_level_id"=> "68",
            "province_id"=> "1",
            "local_id"=> "3.173",
            "local_name"=> "Chaudandigadhi Municipality",
            "dist_id"=> "13",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "69",
            "local_level_id"=> "69",
            "province_id"=> "1",
            "local_id"=> "3.174",
            "local_name"=> "Triyuga Municipality",
            "dist_id"=> "13",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "70",
            "local_level_id"=> "70",
            "province_id"=> "1",
            "local_id"=> "3.175",
            "local_name"=> "Belaka Municipality",
            "dist_id"=> "13",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "71",
            "local_level_id"=> "71",
            "province_id"=> "1",
            "local_id"=> "3.176",
            "local_name"=> "Siddhricharan Municipality",
            "dist_id"=> "14",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "72",
            "local_level_id"=> "72",
            "province_id"=> "2",
            "local_id"=> "3.177",
            "local_name"=> "Kanchanrup Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "73",
            "local_level_id"=> "73",
            "province_id"=> "2",
            "local_id"=> "3.178",
            "local_name"=> "Khadak Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "74",
            "local_level_id"=> "74",
            "province_id"=> "2",
            "local_id"=> "3.179",
            "local_name"=> "Dakneshwori Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "75",
            "local_level_id"=> "75",
            "province_id"=> "2",
            "local_id"=> "3.18",
            "local_name"=> "Rajbiraj Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "76",
            "local_level_id"=> "76",
            "province_id"=> "2",
            "local_id"=> "3.181",
            "local_name"=> "Bodebarsain Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "77",
            "local_level_id"=> "77",
            "province_id"=> "2",
            "local_id"=> "3.182",
            "local_name"=> "Shubhnath Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "78",
            "local_level_id"=> "78",
            "province_id"=> "2",
            "local_id"=> "3.183",
            "local_name"=> "Surunga Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "79",
            "local_level_id"=> "79",
            "province_id"=> "2",
            "local_id"=> "3.184",
            "local_name"=> "Hanumannagar Kankalini Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "80",
            "local_level_id"=> "80",
            "province_id"=> "2",
            "local_id"=> "3.185",
            "local_name"=> "Kallyanpur Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "81",
            "local_level_id"=> "81",
            "province_id"=> "2",
            "local_id"=> "3.186",
            "local_name"=> "Golbajar Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "82",
            "local_level_id"=> "82",
            "province_id"=> "2",
            "local_id"=> "3.187",
            "local_name"=> "Dhangadhimai Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "83",
            "local_level_id"=> "83",
            "province_id"=> "2",
            "local_id"=> "3.188",
            "local_name"=> "Mirchaiya Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "84",
            "local_level_id"=> "84",
            "province_id"=> "2",
            "local_id"=> "3.189",
            "local_name"=> "Lahan Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "85",
            "local_level_id"=> "85",
            "province_id"=> "2",
            "local_id"=> "3.19",
            "local_name"=> "Siraha Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "86",
            "local_level_id"=> "86",
            "province_id"=> "2",
            "local_id"=> "3.191",
            "local_name"=> "Sukhipur Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "87",
            "local_level_id"=> "87",
            "province_id"=> "2",
            "local_id"=> "3.192",
            "local_name"=> "Kshireshwornath Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "88",
            "local_level_id"=> "88",
            "province_id"=> "2",
            "local_id"=> "3.193",
            "local_name"=> "Ganeshman Charnath Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "89",
            "local_level_id"=> "89",
            "province_id"=> "2",
            "local_id"=> "3.194",
            "local_name"=> "Dhanushdham Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "90",
            "local_level_id"=> "90",
            "province_id"=> "2",
            "local_id"=> "3.195",
            "local_name"=> "Nagrain Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "91",
            "local_level_id"=> "91",
            "province_id"=> "2",
            "local_id"=> "3.196",
            "local_name"=> "Mithila Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "92",
            "local_level_id"=> "92",
            "province_id"=> "2",
            "local_id"=> "3.197",
            "local_name"=> "Bideh Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "93",
            "local_level_id"=> "93",
            "province_id"=> "2",
            "local_id"=> "3.198",
            "local_name"=> "Sabaila Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "94",
            "local_level_id"=> "94",
            "province_id"=> "2",
            "local_id"=> "3.199",
            "local_name"=> "Shahidnagar Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "95",
            "local_level_id"=> "95",
            "province_id"=> "2",
            "local_id"=> "3.2",
            "local_name"=> "Guashala Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "96",
            "local_level_id"=> "96",
            "province_id"=> "2",
            "local_id"=> "3.201",
            "local_name"=> "Jaleshwor Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "97",
            "local_level_id"=> "97",
            "province_id"=> "2",
            "local_id"=> "3.202",
            "local_name"=> "Bardibash Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "98",
            "local_level_id"=> "98",
            "province_id"=> "2",
            "local_id"=> "3.203",
            "local_name"=> "Ishworpur Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "99",
            "local_level_id"=> "99",
            "province_id"=> "2",
            "local_id"=> "3.204",
            "local_name"=> "Godaita Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "100",
            "local_level_id"=> "100",
            "province_id"=> "2",
            "local_id"=> "3.205",
            "local_name"=> "Malangwa Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "101",
            "local_level_id"=> "101",
            "province_id"=> "2",
            "local_id"=> "3.206",
            "local_name"=> "Lalbandi Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "102",
            "local_level_id"=> "102",
            "province_id"=> "2",
            "local_id"=> "3.207",
            "local_name"=> "Barhathawa Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "103",
            "local_level_id"=> "103",
            "province_id"=> "2",
            "local_id"=> "3.208",
            "local_name"=> "Balara Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "104",
            "local_level_id"=> "104",
            "province_id"=> "2",
            "local_id"=> "3.209",
            "local_name"=> "Bagmati Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "105",
            "local_level_id"=> "105",
            "province_id"=> "2",
            "local_id"=> "3.21",
            "local_name"=> "Haripur Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "106",
            "local_level_id"=> "106",
            "province_id"=> "2",
            "local_id"=> "3.211",
            "local_name"=> "Harion Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "107",
            "local_level_id"=> "107",
            "province_id"=> "2",
            "local_id"=> "3.212",
            "local_name"=> "Haripurbi Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "108",
            "local_level_id"=> "108",
            "province_id"=> "3",
            "local_id"=> "3.213",
            "local_name"=> "Kamlamai Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "109",
            "local_level_id"=> "109",
            "province_id"=> "3",
            "local_id"=> "3.214",
            "local_name"=> "Dudhauli Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "110",
            "local_level_id"=> "110",
            "province_id"=> "3",
            "local_id"=> "3.215",
            "local_name"=> "Manthali Municipality",
            "dist_id"=> "21",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "111",
            "local_level_id"=> "111",
            "province_id"=> "3",
            "local_id"=> "3.216",
            "local_name"=> "Ramechhap Municipality",
            "dist_id"=> "21",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "112",
            "local_level_id"=> "112",
            "province_id"=> "3",
            "local_id"=> "3.217",
            "local_name"=> "Jiri Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "113",
            "local_level_id"=> "113",
            "province_id"=> "3",
            "local_id"=> "3.218",
            "local_name"=> "Bhimeshwor Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "114",
            "local_level_id"=> "114",
            "province_id"=> "3",
            "local_id"=> "3.219",
            "local_name"=> "Chautara Sangachowkgadhi Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "115",
            "local_level_id"=> "115",
            "province_id"=> "3",
            "local_id"=> "3.22",
            "local_name"=> "Melamchi Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "116",
            "local_level_id"=> "116",
            "province_id"=> "3",
            "local_id"=> "3.221",
            "local_name"=> "Barhabishe Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "117",
            "local_level_id"=> "117",
            "province_id"=> "3",
            "local_id"=> "3.222",
            "local_name"=> "Dhunibeshi Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "118",
            "local_level_id"=> "118",
            "province_id"=> "3",
            "local_id"=> "3.223",
            "local_name"=> "Nilkanth Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "119",
            "local_level_id"=> "119",
            "province_id"=> "3",
            "local_id"=> "3.224",
            "local_name"=> "Bidur Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "120",
            "local_level_id"=> "120",
            "province_id"=> "3",
            "local_id"=> "3.225",
            "local_name"=> "Belkotgadhi Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "121",
            "local_level_id"=> "121",
            "province_id"=> "3",
            "local_id"=> "3.226",
            "local_name"=> "Kangeshwori Manohara Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "122",
            "local_level_id"=> "122",
            "province_id"=> "3",
            "local_id"=> "3.227",
            "local_name"=> "Kirtipur Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "123",
            "local_level_id"=> "123",
            "province_id"=> "3",
            "local_id"=> "3.228",
            "local_name"=> "Gokarneshwor Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "124",
            "local_level_id"=> "124",
            "province_id"=> "3",
            "local_id"=> "3.229",
            "local_name"=> "Chandragiri Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "125",
            "local_level_id"=> "125",
            "province_id"=> "3",
            "local_id"=> "3.23",
            "local_name"=> "Tokha Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "126",
            "local_level_id"=> "126",
            "province_id"=> "3",
            "local_id"=> "3.231",
            "local_name"=> "Tarkeshwor Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "127",
            "local_level_id"=> "127",
            "province_id"=> "3",
            "local_id"=> "3.232",
            "local_name"=> "Dakshinkali Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "128",
            "local_level_id"=> "128",
            "province_id"=> "3",
            "local_id"=> "3.233",
            "local_name"=> "Nagarjun Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "129",
            "local_level_id"=> "129",
            "province_id"=> "3",
            "local_id"=> "3.234",
            "local_name"=> "Budhanilkanth Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "130",
            "local_level_id"=> "130",
            "province_id"=> "3",
            "local_id"=> "3.235",
            "local_name"=> "Shankharapur Municipality",
            "dist_id"=> "27",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "131",
            "local_level_id"=> "131",
            "province_id"=> "3",
            "local_id"=> "3.236",
            "local_name"=> "Godawari Municipality",
            "dist_id"=> "28",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "132",
            "local_level_id"=> "132",
            "province_id"=> "3",
            "local_id"=> "3.237",
            "local_name"=> "Mahalakshmi Municipality",
            "dist_id"=> "28",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "133",
            "local_level_id"=> "133",
            "province_id"=> "3",
            "local_id"=> "3.238",
            "local_name"=> "Changunarayan Municipality",
            "dist_id"=> "29",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "134",
            "local_level_id"=> "134",
            "province_id"=> "3",
            "local_id"=> "3.239",
            "local_name"=> "Bhaktapur Municipality",
            "dist_id"=> "29",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "135",
            "local_level_id"=> "135",
            "province_id"=> "3",
            "local_id"=> "3.24",
            "local_name"=> "Madhyapur Thimi Municipality",
            "dist_id"=> "29",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "136",
            "local_level_id"=> "136",
            "province_id"=> "3",
            "local_id"=> "3.241",
            "local_name"=> "Suryabinayak Municipality",
            "dist_id"=> "29",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "137",
            "local_level_id"=> "137",
            "province_id"=> "3",
            "local_id"=> "3.242",
            "local_name"=> "Dhulikhel Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "138",
            "local_level_id"=> "138",
            "province_id"=> "3",
            "local_id"=> "3.243",
            "local_name"=> "Namobuddha Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "139",
            "local_level_id"=> "139",
            "province_id"=> "3",
            "local_id"=> "3.244",
            "local_name"=> "Panauti Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "140",
            "local_level_id"=> "140",
            "province_id"=> "3",
            "local_id"=> "3.245",
            "local_name"=> "Panchkhal Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "141",
            "local_level_id"=> "141",
            "province_id"=> "3",
            "local_id"=> "3.246",
            "local_name"=> "Banepa Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "142",
            "local_level_id"=> "142",
            "province_id"=> "3",
            "local_id"=> "3.247",
            "local_name"=> "Mandandeupur Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "143",
            "local_level_id"=> "143",
            "province_id"=> "3",
            "local_id"=> "3.248",
            "local_name"=> "Thaha Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "144",
            "local_level_id"=> "144",
            "province_id"=> "2",
            "local_id"=> "3.249",
            "local_name"=> "Garuda Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "145",
            "local_level_id"=> "145",
            "province_id"=> "2",
            "local_id"=> "3.25",
            "local_name"=> "Gaur Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "146",
            "local_level_id"=> "146",
            "province_id"=> "2",
            "local_id"=> "3.251",
            "local_name"=> "Chandrapur Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "147",
            "local_level_id"=> "147",
            "province_id"=> "2",
            "local_id"=> "3.252",
            "local_name"=> "Kolhabi Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "148",
            "local_level_id"=> "148",
            "province_id"=> "2",
            "local_id"=> "3.253",
            "local_name"=> "Nijgadh Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "149",
            "local_level_id"=> "149",
            "province_id"=> "2",
            "local_id"=> "3.254",
            "local_name"=> "Mahagadhimai Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "150",
            "local_level_id"=> "150",
            "province_id"=> "2",
            "local_id"=> "3.255",
            "local_name"=> "Simraungadh Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "151",
            "local_level_id"=> "151",
            "province_id"=> "2",
            "local_id"=> "3.256",
            "local_name"=> "Pokhariya Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "152",
            "local_level_id"=> "152",
            "province_id"=> "3",
            "local_id"=> "3.257",
            "local_name"=> "Kalik Municipality",
            "dist_id"=> "35",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "153",
            "local_level_id"=> "153",
            "province_id"=> "3",
            "local_id"=> "3.258",
            "local_name"=> "Khairahni Municipality",
            "dist_id"=> "35",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "154",
            "local_level_id"=> "154",
            "province_id"=> "3",
            "local_id"=> "3.259",
            "local_name"=> "Madi Municipality",
            "dist_id"=> "35",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "155",
            "local_level_id"=> "155",
            "province_id"=> "3",
            "local_id"=> "3.26",
            "local_name"=> "Ratnanagar Municipality",
            "dist_id"=> "35",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "156",
            "local_level_id"=> "156",
            "province_id"=> "3",
            "local_id"=> "3.261",
            "local_name"=> "Rapti Municipality",
            "dist_id"=> "35",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "157",
            "local_level_id"=> "157",
            "province_id"=> "4",
            "local_id"=> "3.262",
            "local_name"=> "Kawasoti Municipality",
            "dist_id"=> "76",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "158",
            "local_level_id"=> "158",
            "province_id"=> "4",
            "local_id"=> "3.263",
            "local_name"=> "Gaindakot Municipality",
            "dist_id"=> "76",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "159",
            "local_level_id"=> "159",
            "province_id"=> "4",
            "local_id"=> "3.264",
            "local_name"=> "Devchuli Municipality",
            "dist_id"=> "76",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "160",
            "local_level_id"=> "160",
            "province_id"=> "5",
            "local_id"=> "3.265",
            "local_name"=> "Bardaghat Municipality",
            "dist_id"=> "36",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "161",
            "local_level_id"=> "161",
            "province_id"=> "4",
            "local_id"=> "3.266",
            "local_name"=> "Madhyabindu Municipality",
            "dist_id"=> "76",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "162",
            "local_level_id"=> "162",
            "province_id"=> "5",
            "local_id"=> "3.267",
            "local_name"=> "Ramgram Municipality",
            "dist_id"=> "36",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "163",
            "local_level_id"=> "163",
            "province_id"=> "5",
            "local_id"=> "3.268",
            "local_name"=> "Sunwal Municipality",
            "dist_id"=> "36",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "164",
            "local_level_id"=> "164",
            "province_id"=> "5",
            "local_id"=> "3.269",
            "local_name"=> "Tilottam Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "165",
            "local_level_id"=> "165",
            "province_id"=> "5",
            "local_id"=> "3.27",
            "local_name"=> "Devdah Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "166",
            "local_level_id"=> "166",
            "province_id"=> "5",
            "local_id"=> "3.271",
            "local_name"=> "Lumbini Sanskritik Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "167",
            "local_level_id"=> "167",
            "province_id"=> "5",
            "local_id"=> "3.272",
            "local_name"=> "Siddarthnagar Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "168",
            "local_level_id"=> "168",
            "province_id"=> "5",
            "local_id"=> "3.273",
            "local_name"=> "Sainamaina Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "169",
            "local_level_id"=> "169",
            "province_id"=> "5",
            "local_id"=> "3.274",
            "local_name"=> "Kaoilbastu Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "170",
            "local_level_id"=> "170",
            "province_id"=> "5",
            "local_id"=> "3.275",
            "local_name"=> "Krihnanagar Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "171",
            "local_level_id"=> "171",
            "province_id"=> "5",
            "local_id"=> "3.276",
            "local_name"=> "Banganga Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "172",
            "local_level_id"=> "172",
            "province_id"=> "5",
            "local_id"=> "3.277",
            "local_name"=> "Buddhabhumi Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "173",
            "local_level_id"=> "173",
            "province_id"=> "5",
            "local_id"=> "3.278",
            "local_name"=> "Maharajgunj Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "174",
            "local_level_id"=> "174",
            "province_id"=> "5",
            "local_id"=> "3.279",
            "local_name"=> "Shivaraj Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "175",
            "local_level_id"=> "175",
            "province_id"=> "5",
            "local_id"=> "3.28",
            "local_name"=> "Bhumikasthan Municipality",
            "dist_id"=> "39",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "176",
            "local_level_id"=> "176",
            "province_id"=> "5",
            "local_id"=> "3.281",
            "local_name"=> "Shitganga Municipality",
            "dist_id"=> "39",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "177",
            "local_level_id"=> "177",
            "province_id"=> "5",
            "local_id"=> "3.282",
            "local_name"=> "Sandihikhark Municipality",
            "dist_id"=> "39",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "178",
            "local_level_id"=> "178",
            "province_id"=> "5",
            "local_id"=> "3.283",
            "local_name"=> "Tansen Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "179",
            "local_level_id"=> "179",
            "province_id"=> "5",
            "local_id"=> "3.284",
            "local_name"=> "Ramour Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "180",
            "local_level_id"=> "180",
            "province_id"=> "5",
            "local_id"=> "3.285",
            "local_name"=> "Musikot Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "181",
            "local_level_id"=> "181",
            "province_id"=> "5",
            "local_id"=> "3.286",
            "local_name"=> "Resunga Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "182",
            "local_level_id"=> "182",
            "province_id"=> "4",
            "local_id"=> "3.287",
            "local_name"=> "Gallyang Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "183",
            "local_level_id"=> "183",
            "province_id"=> "4",
            "local_id"=> "3.288",
            "local_name"=> "Chapakot Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "184",
            "local_level_id"=> "184",
            "province_id"=> "4",
            "local_id"=> "3.289",
            "local_name"=> "Putalibajar Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "185",
            "local_level_id"=> "185",
            "province_id"=> "4",
            "local_id"=> "3.29",
            "local_name"=> "Bhirkot Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "186",
            "local_level_id"=> "186",
            "province_id"=> "4",
            "local_id"=> "3.291",
            "local_name"=> "Waling Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "187",
            "local_level_id"=> "187",
            "province_id"=> "4",
            "local_id"=> "3.292",
            "local_name"=> "Bhanu Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "188",
            "local_level_id"=> "188",
            "province_id"=> "4",
            "local_id"=> "3.293",
            "local_name"=> "Bhimad Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "189",
            "local_level_id"=> "189",
            "province_id"=> "4",
            "local_id"=> "3.294",
            "local_name"=> "Byas Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "190",
            "local_level_id"=> "190",
            "province_id"=> "4",
            "local_id"=> "3.295",
            "local_name"=> "Shuklagandaki Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "191",
            "local_level_id"=> "191",
            "province_id"=> "4",
            "local_id"=> "3.296",
            "local_name"=> "Gorkha Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "192",
            "local_level_id"=> "192",
            "province_id"=> "4",
            "local_id"=> "3.297",
            "local_name"=> "Palungtar Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "193",
            "local_level_id"=> "193",
            "province_id"=> "4",
            "local_id"=> "3.298",
            "local_name"=> "Besishahar Municipality",
            "dist_id"=> "46",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "194",
            "local_level_id"=> "194",
            "province_id"=> "4",
            "local_id"=> "3.299",
            "local_name"=> "Madhyanepal Municipality",
            "dist_id"=> "46",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "195",
            "local_level_id"=> "195",
            "province_id"=> "4",
            "local_id"=> "3.3",
            "local_name"=> "Rainas Municipality",
            "dist_id"=> "46",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "196",
            "local_level_id"=> "196",
            "province_id"=> "4",
            "local_id"=> "3.301",
            "local_name"=> "Sundarbajar Municipality",
            "dist_id"=> "46",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "197",
            "local_level_id"=> "197",
            "province_id"=> "4",
            "local_id"=> "3.302",
            "local_name"=> "Kushma Municipality",
            "dist_id"=> "48",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "198",
            "local_level_id"=> "198",
            "province_id"=> "4",
            "local_id"=> "3.303",
            "local_name"=> "Phalewash Municipality",
            "dist_id"=> "48",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "199",
            "local_level_id"=> "199",
            "province_id"=> "4",
            "local_id"=> "3.304",
            "local_name"=> "Galkot Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "200",
            "local_level_id"=> "200",
            "province_id"=> "4",
            "local_id"=> "3.305",
            "local_name"=> "Jaimini Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "201",
            "local_level_id"=> "201",
            "province_id"=> "4",
            "local_id"=> "3.306",
            "local_name"=> "Dhorpatan Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "202",
            "local_level_id"=> "202",
            "province_id"=> "4",
            "local_id"=> "3.307",
            "local_name"=> "Baglung Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "203",
            "local_level_id"=> "203",
            "province_id"=> "4",
            "local_id"=> "3.308",
            "local_name"=> "Beni Municipality",
            "dist_id"=> "50",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "204",
            "local_level_id"=> "204",
            "province_id"=> "6",
            "local_id"=> "3.309",
            "local_name"=> "Chhayanath Rara Municipality",
            "dist_id"=> "52",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "205",
            "local_level_id"=> "205",
            "province_id"=> "6",
            "local_id"=> "3.31",
            "local_name"=> "Thulibheri Municipality",
            "dist_id"=> "53",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "206",
            "local_level_id"=> "206",
            "province_id"=> "6",
            "local_id"=> "3.311",
            "local_name"=> "Tripurasundari Municipality",
            "dist_id"=> "53",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "207",
            "local_level_id"=> "207",
            "province_id"=> "6",
            "local_id"=> "3.312",
            "local_name"=> "Chandannath Municipality",
            "dist_id"=> "55",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "208",
            "local_level_id"=> "208",
            "province_id"=> "6",
            "local_id"=> "3.313",
            "local_name"=> "Khandachakra Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "209",
            "local_level_id"=> "209",
            "province_id"=> "6",
            "local_id"=> "3.314",
            "local_name"=> "Tilagufa Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "210",
            "local_level_id"=> "210",
            "province_id"=> "6",
            "local_id"=> "3.315",
            "local_name"=> "Raskot Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "211",
            "local_level_id"=> "211",
            "province_id"=> "6",
            "local_id"=> "3.316",
            "local_name"=> "Athabiskot Municipality",
            "dist_id"=> "57",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "212",
            "local_level_id"=> "212",
            "province_id"=> "6",
            "local_id"=> "3.317",
            "local_name"=> "Chaurajahari Municipality",
            "dist_id"=> "57",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "213",
            "local_level_id"=> "213",
            "province_id"=> "6",
            "local_id"=> "3.318",
            "local_name"=> "Musikot Municipality",
            "dist_id"=> "57",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "214",
            "local_level_id"=> "214",
            "province_id"=> "5",
            "local_id"=> "3.319",
            "local_name"=> "Rolpa Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "215",
            "local_level_id"=> "215",
            "province_id"=> "5",
            "local_id"=> "3.32",
            "local_name"=> "Pyuthan Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "216",
            "local_level_id"=> "216",
            "province_id"=> "5",
            "local_id"=> "3.321",
            "local_name"=> "Swargdwari Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "217",
            "local_level_id"=> "217",
            "province_id"=> "5",
            "local_id"=> "3.322",
            "local_name"=> "Lamahi Municipality",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "218",
            "local_level_id"=> "218",
            "province_id"=> "6",
            "local_id"=> "3.323",
            "local_name"=> "Bagchaur Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "219",
            "local_level_id"=> "219",
            "province_id"=> "6",
            "local_id"=> "3.324",
            "local_name"=> "Bangad Kupinde Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "220",
            "local_level_id"=> "220",
            "province_id"=> "6",
            "local_id"=> "3.325",
            "local_name"=> "Sharada Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "221",
            "local_level_id"=> "221",
            "province_id"=> "5",
            "local_id"=> "3.326",
            "local_name"=> "Kohalpur Municipality",
            "dist_id"=> "62",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "222",
            "local_level_id"=> "222",
            "province_id"=> "5",
            "local_id"=> "3.327",
            "local_name"=> "Gulariya Municipality",
            "dist_id"=> "63",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "223",
            "local_level_id"=> "223",
            "province_id"=> "5",
            "local_id"=> "3.328",
            "local_name"=> "Thakurbaba Municipality",
            "dist_id"=> "63",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "224",
            "local_level_id"=> "224",
            "province_id"=> "5",
            "local_id"=> "3.329",
            "local_name"=> "Bansgadi Municipality",
            "dist_id"=> "63",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "225",
            "local_level_id"=> "225",
            "province_id"=> "5",
            "local_id"=> "3.33",
            "local_name"=> "Madhuban Municipality",
            "dist_id"=> "63",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "226",
            "local_level_id"=> "226",
            "province_id"=> "5",
            "local_id"=> "3.331",
            "local_name"=> "Rajapur Municipality",
            "dist_id"=> "63",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "227",
            "local_level_id"=> "227",
            "province_id"=> "5",
            "local_id"=> "3.332",
            "local_name"=> "Barbardiya Municipality",
            "dist_id"=> "63",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "228",
            "local_level_id"=> "228",
            "province_id"=> "6",
            "local_id"=> "3.333",
            "local_name"=> "Gurbhakot Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "229",
            "local_level_id"=> "229",
            "province_id"=> "6",
            "local_id"=> "3.334",
            "local_name"=> "Panchpuri Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "230",
            "local_level_id"=> "230",
            "province_id"=> "6",
            "local_id"=> "3.335",
            "local_name"=> "Bheriganga Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "231",
            "local_level_id"=> "231",
            "province_id"=> "6",
            "local_id"=> "3.336",
            "local_name"=> "Lekbeshi Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "232",
            "local_level_id"=> "232",
            "province_id"=> "6",
            "local_id"=> "3.337",
            "local_name"=> "Birendranagar Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "233",
            "local_level_id"=> "233",
            "province_id"=> "6",
            "local_id"=> "3.338",
            "local_name"=> "Chhedagad Municipality",
            "dist_id"=> "65",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "234",
            "local_level_id"=> "234",
            "province_id"=> "6",
            "local_id"=> "3.339",
            "local_name"=> "Nalgaad Municipality",
            "dist_id"=> "65",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "235",
            "local_level_id"=> "235",
            "province_id"=> "6",
            "local_id"=> "3.34",
            "local_name"=> "Bheri Municipality",
            "dist_id"=> "65",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "236",
            "local_level_id"=> "236",
            "province_id"=> "6",
            "local_id"=> "3.341",
            "local_name"=> "Aathbishe Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "237",
            "local_level_id"=> "237",
            "province_id"=> "6",
            "local_id"=> "3.342",
            "local_name"=> "Chamunda Bindrasaini Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "238",
            "local_level_id"=> "238",
            "province_id"=> "6",
            "local_id"=> "3.343",
            "local_name"=> "Dullu Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "239",
            "local_level_id"=> "239",
            "province_id"=> "6",
            "local_id"=> "3.344",
            "local_name"=> "Narayan Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "240",
            "local_level_id"=> "240",
            "province_id"=> "7",
            "local_id"=> "3.345",
            "local_name"=> "Godawari Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "241",
            "local_level_id"=> "241",
            "province_id"=> "7",
            "local_id"=> "3.346",
            "local_name"=> "Gauriganga Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "242",
            "local_level_id"=> "242",
            "province_id"=> "7",
            "local_id"=> "3.347",
            "local_name"=> "Ghodaghodi Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "243",
            "local_level_id"=> "243",
            "province_id"=> "7",
            "local_id"=> "3.348",
            "local_name"=> "Tikapur Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "244",
            "local_level_id"=> "244",
            "province_id"=> "7",
            "local_id"=> "3.349",
            "local_name"=> "Bhajani Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "245",
            "local_level_id"=> "245",
            "province_id"=> "7",
            "local_id"=> "3.35",
            "local_name"=> "Lamkichuha Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "246",
            "local_level_id"=> "246",
            "province_id"=> "7",
            "local_id"=> "3.351",
            "local_name"=> "Dipayal Silgadhi Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "247",
            "local_level_id"=> "247",
            "province_id"=> "7",
            "local_id"=> "3.352",
            "local_name"=> "Shikhar Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "248",
            "local_level_id"=> "248",
            "province_id"=> "7",
            "local_id"=> "3.353",
            "local_name"=> "Kamalbajar Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "249",
            "local_level_id"=> "249",
            "province_id"=> "7",
            "local_id"=> "3.354",
            "local_name"=> "Panchdewal Binayak Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "250",
            "local_level_id"=> "250",
            "province_id"=> "7",
            "local_id"=> "3.355",
            "local_name"=> "Mangalsain Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "251",
            "local_level_id"=> "251",
            "province_id"=> "7",
            "local_id"=> "3.356",
            "local_name"=> "Sanfebagar Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "252",
            "local_level_id"=> "252",
            "province_id"=> "7",
            "local_id"=> "3.357",
            "local_name"=> "Tribeni Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "253",
            "local_level_id"=> "253",
            "province_id"=> "7",
            "local_id"=> "3.358",
            "local_name"=> "Badimalika Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "254",
            "local_level_id"=> "254",
            "province_id"=> "7",
            "local_id"=> "3.359",
            "local_name"=> "Budhiganga Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "255",
            "local_level_id"=> "255",
            "province_id"=> "7",
            "local_id"=> "3.36",
            "local_name"=> "Budhinanda Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "256",
            "local_level_id"=> "256",
            "province_id"=> "7",
            "local_id"=> "3.361",
            "local_name"=> "Jayprithvi Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "257",
            "local_level_id"=> "257",
            "province_id"=> "7",
            "local_id"=> "3.362",
            "local_name"=> "Bungal Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "258",
            "local_level_id"=> "258",
            "province_id"=> "7",
            "local_id"=> "3.363",
            "local_name"=> "Mahakali Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "259",
            "local_level_id"=> "259",
            "province_id"=> "7",
            "local_id"=> "3.364",
            "local_name"=> "Shailyashikhar Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "260",
            "local_level_id"=> "260",
            "province_id"=> "7",
            "local_id"=> "3.365",
            "local_name"=> "Dashrathchand Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "261",
            "local_level_id"=> "261",
            "province_id"=> "7",
            "local_id"=> "3.366",
            "local_name"=> "Patan Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "262",
            "local_level_id"=> "262",
            "province_id"=> "7",
            "local_id"=> "3.367",
            "local_name"=> "Purchaudi Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "263",
            "local_level_id"=> "263",
            "province_id"=> "7",
            "local_id"=> "3.368",
            "local_name"=> "Melauli Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "264",
            "local_level_id"=> "264",
            "province_id"=> "7",
            "local_id"=> "3.369",
            "local_name"=> "Amargadhi Municipality",
            "dist_id"=> "74",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "265",
            "local_level_id"=> "265",
            "province_id"=> "7",
            "local_id"=> "3.37",
            "local_name"=> "Parshuram Municipality",
            "dist_id"=> "74",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "266",
            "local_level_id"=> "266",
            "province_id"=> "7",
            "local_id"=> "3.371",
            "local_name"=> "Krishnapur Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "267",
            "local_level_id"=> "267",
            "province_id"=> "7",
            "local_id"=> "3.372",
            "local_name"=> "Punarbas Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "268",
            "local_level_id"=> "268",
            "province_id"=> "7",
            "local_id"=> "3.373",
            "local_name"=> "Bedkot Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "269",
            "local_level_id"=> "269",
            "province_id"=> "7",
            "local_id"=> "3.374",
            "local_name"=> "Belauri Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "270",
            "local_level_id"=> "270",
            "province_id"=> "7",
            "local_id"=> "3.375",
            "local_name"=> "Bhimdatta Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "271",
            "local_level_id"=> "271",
            "province_id"=> "7",
            "local_id"=> "3.376",
            "local_name"=> "Dodhara Chandani Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "272",
            "local_level_id"=> "272",
            "province_id"=> "7",
            "local_id"=> "3.377",
            "local_name"=> "Shuklaphanta Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "273",
            "local_level_id"=> "273",
            "province_id"=> "2",
            "local_id"=> "3.378",
            "local_name"=> "Rajdevi Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "274",
            "local_level_id"=> "274",
            "province_id"=> "1",
            "local_id"=> "3.401",
            "local_name"=> "Athrai Tribeni Rural-Municipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "275",
            "local_level_id"=> "275",
            "province_id"=> "1",
            "local_id"=> "3.402",
            "local_name"=> "Phaktanglung Rural-Municipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "276",
            "local_level_id"=> "276",
            "province_id"=> "1",
            "local_id"=> "3.403",
            "local_name"=> "Mikwakhola Rural-Municipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "277",
            "local_level_id"=> "277",
            "province_id"=> "1",
            "local_id"=> "3.404",
            "local_name"=> "Meringden Rural-Municipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "278",
            "local_level_id"=> "278",
            "province_id"=> "1",
            "local_id"=> "3.405",
            "local_name"=> "Mewakhola Rural-Municipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "279",
            "local_level_id"=> "279",
            "province_id"=> "1",
            "local_id"=> "3.406",
            "local_name"=> "Pathibhara Yangwarak Rural-Municipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "280",
            "local_level_id"=> "280",
            "province_id"=> "1",
            "local_id"=> "3.407",
            "local_name"=> "Sidingwa Rural-Municipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "281",
            "local_level_id"=> "281",
            "province_id"=> "1",
            "local_id"=> "3.408",
            "local_name"=> "Sirijangha Rural-Municipality",
            "dist_id"=> "1",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "282",
            "local_level_id"=> "282",
            "province_id"=> "1",
            "local_id"=> "3.409",
            "local_name"=> "Kummayak Rural-Municipality",
            "dist_id"=> "2",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "283",
            "local_level_id"=> "283",
            "province_id"=> "1",
            "local_id"=> "3.41",
            "local_name"=> "Tumwewa Rural-Municipality",
            "dist_id"=> "2",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "284",
            "local_level_id"=> "284",
            "province_id"=> "1",
            "local_id"=> "3.411",
            "local_name"=> "Phalelung Rural-Municipality",
            "dist_id"=> "2",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "285",
            "local_level_id"=> "285",
            "province_id"=> "1",
            "local_id"=> "3.412",
            "local_name"=> "Phalgunand Rural-Municipality",
            "dist_id"=> "2",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "286",
            "local_level_id"=> "286",
            "province_id"=> "1",
            "local_id"=> "3.413",
            "local_name"=> "Miklajung Rural-Municipality",
            "dist_id"=> "2",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "287",
            "local_level_id"=> "287",
            "province_id"=> "1",
            "local_id"=> "3.414",
            "local_name"=> "Yangwarak Rural-Municipality",
            "dist_id"=> "2",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "288",
            "local_level_id"=> "288",
            "province_id"=> "1",
            "local_id"=> "3.415",
            "local_name"=> "Hilihang Rural-Municipality",
            "dist_id"=> "2",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "289",
            "local_level_id"=> "289",
            "province_id"=> "1",
            "local_id"=> "3.416",
            "local_name"=> "ChulaChuli Rural-Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "290",
            "local_level_id"=> "290",
            "province_id"=> "1",
            "local_id"=> "3.417",
            "local_name"=> "Phakaphokthum Rural-Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "291",
            "local_level_id"=> "291",
            "province_id"=> "1",
            "local_id"=> "3.418",
            "local_name"=> "Maijogmai Rural-Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "292",
            "local_level_id"=> "292",
            "province_id"=> "1",
            "local_id"=> "3.419",
            "local_name"=> "Mangsebung Rural-Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "293",
            "local_level_id"=> "293",
            "province_id"=> "1",
            "local_id"=> "3.42",
            "local_name"=> "Rong Rural-Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "294",
            "local_level_id"=> "294",
            "province_id"=> "1",
            "local_id"=> "3.421",
            "local_name"=> "Sandakpur Rural-Municipality",
            "dist_id"=> "3",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "295",
            "local_level_id"=> "295",
            "province_id"=> "1",
            "local_id"=> "3.422",
            "local_name"=> "Kachankawal Rural-Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "296",
            "local_level_id"=> "296",
            "province_id"=> "1",
            "local_id"=> "3.423",
            "local_name"=> "Kamal Rural-Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "297",
            "local_level_id"=> "297",
            "province_id"=> "1",
            "local_id"=> "3.424",
            "local_name"=> "Gauriganga Rural-Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "298",
            "local_level_id"=> "298",
            "province_id"=> "1",
            "local_id"=> "3.425",
            "local_name"=> "Jhapa Rural-Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "299",
            "local_level_id"=> "299",
            "province_id"=> "1",
            "local_id"=> "3.426",
            "local_name"=> "Barhadashi Rural-Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "300",
            "local_level_id"=> "300",
            "province_id"=> "1",
            "local_id"=> "3.427",
            "local_name"=> "Buddhashanti Rural-Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "301",
            "local_level_id"=> "301",
            "province_id"=> "1",
            "local_id"=> "3.428",
            "local_name"=> "Haldibara Rural-Municipality",
            "dist_id"=> "4",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "302",
            "local_level_id"=> "302",
            "province_id"=> "1",
            "local_id"=> "3.429",
            "local_name"=> "Chichila Rural-Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "303",
            "local_level_id"=> "303",
            "province_id"=> "1",
            "local_id"=> "3.43",
            "local_name"=> "Bhotkhola Rural-Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "304",
            "local_level_id"=> "304",
            "province_id"=> "1",
            "local_id"=> "3.431",
            "local_name"=> "Makalu Rural-Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "305",
            "local_level_id"=> "305",
            "province_id"=> "1",
            "local_id"=> "3.432",
            "local_name"=> "Sabhapokhari Rural-Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "306",
            "local_level_id"=> "306",
            "province_id"=> "1",
            "local_id"=> "3.433",
            "local_name"=> "Silichong Rural-Municipality",
            "dist_id"=> "5",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "307",
            "local_level_id"=> "307",
            "province_id"=> "1",
            "local_id"=> "3.434",
            "local_name"=> "Aathrai Rural-Municipality",
            "dist_id"=> "6",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "308",
            "local_level_id"=> "308",
            "province_id"=> "1",
            "local_id"=> "3.435",
            "local_name"=> "Chhathar Rural-Municipality",
            "dist_id"=> "6",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "309",
            "local_level_id"=> "309",
            "province_id"=> "1",
            "local_id"=> "3.436",
            "local_name"=> "Phedap Rural-Municipality",
            "dist_id"=> "6",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "310",
            "local_level_id"=> "310",
            "province_id"=> "1",
            "local_id"=> "3.437",
            "local_name"=> "Menchhayayemun Rural-Municipality",
            "dist_id"=> "6",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "311",
            "local_level_id"=> "311",
            "province_id"=> "1",
            "local_id"=> "3.438",
            "local_name"=> "Arun Rural-Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "312",
            "local_level_id"=> "312",
            "province_id"=> "1",
            "local_id"=> "3.439",
            "local_name"=> "Aamchowk Rural-Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "313",
            "local_level_id"=> "313",
            "province_id"=> "1",
            "local_id"=> "3.44",
            "local_name"=> "Temkemaiyung Rural-Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "314",
            "local_level_id"=> "314",
            "province_id"=> "1",
            "local_id"=> "3.441",
            "local_name"=> "Pauwadungama Rural-Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "315",
            "local_level_id"=> "315",
            "province_id"=> "1",
            "local_id"=> "3.442",
            "local_name"=> "Ramprasadrai Rural-Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "316",
            "local_level_id"=> "316",
            "province_id"=> "1",
            "local_id"=> "3.443",
            "local_name"=> "Solpasilichho Rural-Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "317",
            "local_level_id"=> "317",
            "province_id"=> "1",
            "local_id"=> "3.444",
            "local_name"=> "Hatuwagadhi Rural-Municipality",
            "dist_id"=> "7",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "318",
            "local_level_id"=> "318",
            "province_id"=> "1",
            "local_id"=> "3.445",
            "local_name"=> "Shahidbhumi Rural-Municipality",
            "dist_id"=> "8",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "319",
            "local_level_id"=> "319",
            "province_id"=> "1",
            "local_id"=> "3.446",
            "local_name"=> "Chaubise Rural-Municipality",
            "dist_id"=> "8",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "320",
            "local_level_id"=> "320",
            "province_id"=> "1",
            "local_id"=> "3.447",
            "local_name"=> "Chhathar Jorpati Rural-Municipality",
            "dist_id"=> "8",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "321",
            "local_level_id"=> "321",
            "province_id"=> "1",
            "local_id"=> "3.448",
            "local_name"=> "Sangurigadhi Rural-Municipality",
            "dist_id"=> "8",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "322",
            "local_level_id"=> "322",
            "province_id"=> "1",
            "local_id"=> "3.449",
            "local_name"=> "Koshi Rural-Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "323",
            "local_level_id"=> "323",
            "province_id"=> "1",
            "local_id"=> "3.45",
            "local_name"=> "Gadhi Rural-Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "324",
            "local_level_id"=> "324",
            "province_id"=> "1",
            "local_id"=> "3.451",
            "local_name"=> "Dewanganj Rural-Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "325",
            "local_level_id"=> "325",
            "province_id"=> "1",
            "local_id"=> "3.452",
            "local_name"=> "Barju Rural-Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "326",
            "local_level_id"=> "326",
            "province_id"=> "1",
            "local_id"=> "3.453",
            "local_name"=> "Bhokraha Rural-Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "327",
            "local_level_id"=> "327",
            "province_id"=> "1",
            "local_id"=> "3.454",
            "local_name"=> "Harinagar Rural-Municipality",
            "dist_id"=> "9",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "328",
            "local_level_id"=> "328",
            "province_id"=> "1",
            "local_id"=> "3.455",
            "local_name"=> "Katahari Rural-Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "329",
            "local_level_id"=> "329",
            "province_id"=> "1",
            "local_id"=> "3.456",
            "local_name"=> "Kanepokhari Rural-Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "330",
            "local_level_id"=> "330",
            "province_id"=> "1",
            "local_id"=> "3.457",
            "local_name"=> "Kerabari Rural-Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "331",
            "local_level_id"=> "331",
            "province_id"=> "1",
            "local_id"=> "3.458",
            "local_name"=> "Gramthan Rural-Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "332",
            "local_level_id"=> "332",
            "province_id"=> "1",
            "local_id"=> "3.459",
            "local_name"=> "Jahada Rural-Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "333",
            "local_level_id"=> "333",
            "province_id"=> "1",
            "local_id"=> "3.46",
            "local_name"=> "Dhanpalthan Rural-Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "334",
            "local_level_id"=> "334",
            "province_id"=> "1",
            "local_id"=> "3.461",
            "local_name"=> "Budhiganga Rural-Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "335",
            "local_level_id"=> "335",
            "province_id"=> "1",
            "local_id"=> "3.462",
            "local_name"=> "Miklajung Rural-Municipality",
            "dist_id"=> "10",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "336",
            "local_level_id"=> "336",
            "province_id"=> "1",
            "local_id"=> "3.463",
            "local_name"=> "Khumbu Pasanglahmu Rural-Municipality",
            "dist_id"=> "11",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "337",
            "local_level_id"=> "337",
            "province_id"=> "1",
            "local_id"=> "3.464",
            "local_name"=> "Mapya Dudhkoshi Rural-Municipality",
            "dist_id"=> "11",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "338",
            "local_level_id"=> "338",
            "province_id"=> "1",
            "local_id"=> "3.465",
            "local_name"=> "Thulung Dudhkoshi Rural-Municipality",
            "dist_id"=> "11",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "339",
            "local_level_id"=> "339",
            "province_id"=> "1",
            "local_id"=> "3.466",
            "local_name"=> "Nechasallyan Rural-Municipality",
            "dist_id"=> "11",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "340",
            "local_level_id"=> "340",
            "province_id"=> "1",
            "local_id"=> "3.467",
            "local_name"=> "Mahakulung Rural-Municipality",
            "dist_id"=> "11",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "341",
            "local_level_id"=> "341",
            "province_id"=> "1",
            "local_id"=> "3.468",
            "local_name"=> "Likhu Pike Rural-Municipality",
            "dist_id"=> "11",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "342",
            "local_level_id"=> "342",
            "province_id"=> "1",
            "local_id"=> "3.469",
            "local_name"=> "Sotang Rural-Municipality",
            "dist_id"=> "11",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "343",
            "local_level_id"=> "343",
            "province_id"=> "1",
            "local_id"=> "3.47",
            "local_name"=> "Aiselukharka Rural-Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "344",
            "local_level_id"=> "344",
            "province_id"=> "1",
            "local_id"=> "3.471",
            "local_name"=> "Kopilasgadhi Rural-Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "345",
            "local_level_id"=> "345",
            "province_id"=> "1",
            "local_id"=> "3.472",
            "local_name"=> "Khotehang Rural-Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "346",
            "local_level_id"=> "346",
            "province_id"=> "1",
            "local_id"=> "3.473",
            "local_name"=> "Jantedhunga Rural-Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "347",
            "local_level_id"=> "347",
            "province_id"=> "1",
            "local_id"=> "3.474",
            "local_name"=> "Diprung Chuichumma Rural-Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "348",
            "local_level_id"=> "348",
            "province_id"=> "1",
            "local_id"=> "3.475",
            "local_name"=> "Rawa Besi Rural-Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "349",
            "local_level_id"=> "349",
            "province_id"=> "1",
            "local_id"=> "3.476",
            "local_name"=> "Barahapokhari Rural-Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "350",
            "local_level_id"=> "350",
            "province_id"=> "1",
            "local_id"=> "3.477",
            "local_name"=> "Sakela Rural-Municipality",
            "dist_id"=> "12",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "351",
            "local_level_id"=> "351",
            "province_id"=> "1",
            "local_id"=> "3.478",
            "local_name"=> "Udaypurgadhi Rural-Municipality",
            "dist_id"=> "13",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "352",
            "local_level_id"=> "352",
            "province_id"=> "1",
            "local_id"=> "3.479",
            "local_name"=> "Tapli Rural-Municipality",
            "dist_id"=> "13",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "353",
            "local_level_id"=> "353",
            "province_id"=> "1",
            "local_id"=> "3.48",
            "local_name"=> "Rautamai Rural-Municipality",
            "dist_id"=> "13",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "354",
            "local_level_id"=> "354",
            "province_id"=> "1",
            "local_id"=> "3.481",
            "local_name"=> "Limchungbung Rural-Municipality",
            "dist_id"=> "13",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "355",
            "local_level_id"=> "355",
            "province_id"=> "1",
            "local_id"=> "3.482",
            "local_name"=> "Khijidemba Rural-Municipality",
            "dist_id"=> "14",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "356",
            "local_level_id"=> "356",
            "province_id"=> "1",
            "local_id"=> "3.483",
            "local_name"=> "Champadevi Rural-Municipality",
            "dist_id"=> "14",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "357",
            "local_level_id"=> "357",
            "province_id"=> "1",
            "local_id"=> "3.484",
            "local_name"=> "Chisankhugadhi Rural-Municipality",
            "dist_id"=> "14",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "358",
            "local_level_id"=> "358",
            "province_id"=> "1",
            "local_id"=> "3.485",
            "local_name"=> "ManeBhanjyang Rural-Municipality",
            "dist_id"=> "14",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "359",
            "local_level_id"=> "359",
            "province_id"=> "1",
            "local_id"=> "3.486",
            "local_name"=> "Molung Rural-Municipality",
            "dist_id"=> "14",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "360",
            "local_level_id"=> "360",
            "province_id"=> "1",
            "local_id"=> "3.487",
            "local_name"=> "Likhu Rural-Municipality",
            "dist_id"=> "14",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "361",
            "local_level_id"=> "361",
            "province_id"=> "1",
            "local_id"=> "3.488",
            "local_name"=> "Sunkoshi Rural-Municipality",
            "dist_id"=> "14",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "362",
            "local_level_id"=> "362",
            "province_id"=> "2",
            "local_id"=> "3.489",
            "local_name"=> "Agnisair Krishnasawaran Rural-Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "363",
            "local_level_id"=> "363",
            "province_id"=> "2",
            "local_id"=> "3.49",
            "local_name"=> "Chhinnamasta Rural-Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "364",
            "local_level_id"=> "364",
            "province_id"=> "2",
            "local_id"=> "3.491",
            "local_name"=> "Tirahut Rural-Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "365",
            "local_level_id"=> "365",
            "province_id"=> "2",
            "local_id"=> "3.492",
            "local_name"=> "Tilathi Koiladi Rural-Municipality ",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "366",
            "local_level_id"=> "366",
            "province_id"=> "2",
            "local_id"=> "3.493",
            "local_name"=> "Bishnapur Rural-Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "367",
            "local_level_id"=> "367",
            "province_id"=> "2",
            "local_id"=> "3.494",
            "local_name"=> "Rajgadh Rural-Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "368",
            "local_level_id"=> "368",
            "province_id"=> "2",
            "local_id"=> "3.495",
            "local_name"=> "Mahadewa Rural-Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "369",
            "local_level_id"=> "369",
            "province_id"=> "2",
            "local_id"=> "3.496",
            "local_name"=> "Rupani Rural-Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "370",
            "local_level_id"=> "370",
            "province_id"=> "2",
            "local_id"=> "3.497",
            "local_name"=> "Saptakoshi Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "371",
            "local_level_id"=> "371",
            "province_id"=> "2",
            "local_id"=> "3.498",
            "local_name"=> "Anarma Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "372",
            "local_level_id"=> "372",
            "province_id"=> "2",
            "local_id"=> "3.499",
            "local_name"=> "Aurahi Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "373",
            "local_level_id"=> "373",
            "province_id"=> "2",
            "local_id"=> "3.5",
            "local_name"=> "Karjanha Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "374",
            "local_level_id"=> "374",
            "province_id"=> "2",
            "local_id"=> "3.501",
            "local_name"=> "Naraha Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "375",
            "local_level_id"=> "375",
            "province_id"=> "2",
            "local_id"=> "3.502",
            "local_name"=> "Nawarajpur Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "376",
            "local_level_id"=> "376",
            "province_id"=> "2",
            "local_id"=> "3.503",
            "local_name"=> "Bariyapatti Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "377",
            "local_level_id"=> "377",
            "province_id"=> "2",
            "local_id"=> "3.504",
            "local_name"=> "Bhagwanpur Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "378",
            "local_level_id"=> "378",
            "province_id"=> "2",
            "local_id"=> "3.505",
            "local_name"=> "Lakshmipur Patari Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "379",
            "local_level_id"=> "379",
            "province_id"=> "2",
            "local_id"=> "3.506",
            "local_name"=> "Bishnupur Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "380",
            "local_level_id"=> "380",
            "province_id"=> "2",
            "local_id"=> "3.507",
            "local_name"=> "Sankhuwanankarkatti Rural-Municipality",
            "dist_id"=> "16",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "381",
            "local_level_id"=> "381",
            "province_id"=> "2",
            "local_id"=> "3.508",
            "local_name"=> "Aurahi Rural-Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "382",
            "local_level_id"=> "382",
            "province_id"=> "2",
            "local_id"=> "3.509",
            "local_name"=> "Kamla Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "383",
            "local_level_id"=> "383",
            "province_id"=> "2",
            "local_id"=> "3.51",
            "local_name"=> "Janaknandini Rural-Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "384",
            "local_level_id"=> "384",
            "province_id"=> "2",
            "local_id"=> "3.511",
            "local_name"=> "Bateshwor Rural-Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "385",
            "local_level_id"=> "385",
            "province_id"=> "2",
            "local_id"=> "3.512",
            "local_name"=> "Mithila Bihari Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "386",
            "local_level_id"=> "386",
            "province_id"=> "2",
            "local_id"=> "3.513",
            "local_name"=> "Mukhiyapatti Musaharmiya Rural-Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "387",
            "local_level_id"=> "387",
            "province_id"=> "2",
            "local_id"=> "3.514",
            "local_name"=> "Laxminiya Rural-Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "388",
            "local_level_id"=> "388",
            "province_id"=> "2",
            "local_id"=> "3.515",
            "local_name"=> "Hansapur Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "389",
            "local_level_id"=> "389",
            "province_id"=> "2",
            "local_id"=> "3.516",
            "local_name"=> "Ekdara Rural-Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "390",
            "local_level_id"=> "390",
            "province_id"=> "2",
            "local_id"=> "3.517",
            "local_name"=> "Aurahi Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "391",
            "local_level_id"=> "391",
            "province_id"=> "2",
            "local_id"=> "3.518",
            "local_name"=> "Pipra Rural-Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "392",
            "local_level_id"=> "392",
            "province_id"=> "2",
            "local_id"=> "3.519",
            "local_name"=> "Balwa Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "393",
            "local_level_id"=> "393",
            "province_id"=> "2",
            "local_id"=> "3.52",
            "local_name"=> "Bhangaha Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "394",
            "local_level_id"=> "394",
            "province_id"=> "2",
            "local_id"=> "3.521",
            "local_name"=> "Matihani Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "395",
            "local_level_id"=> "395",
            "province_id"=> "2",
            "local_id"=> "3.522",
            "local_name"=> "Manarashishwa Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "396",
            "local_level_id"=> "396",
            "province_id"=> "2",
            "local_id"=> "3.523",
            "local_name"=> "Mahottari Rural-Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "397",
            "local_level_id"=> "397",
            "province_id"=> "2",
            "local_id"=> "3.524",
            "local_name"=> "Ramhopalpur Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "398",
            "local_level_id"=> "398",
            "province_id"=> "2",
            "local_id"=> "3.525",
            "local_name"=> "Loharpatti Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "399",
            "local_level_id"=> "399",
            "province_id"=> "2",
            "local_id"=> "3.526",
            "local_name"=> "Samsi Rural-Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "400",
            "local_level_id"=> "400",
            "province_id"=> "2",
            "local_id"=> "3.527",
            "local_name"=> "Sonma Rural-Municipality",
            "dist_id"=> "18",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "401",
            "local_level_id"=> "401",
            "province_id"=> "2",
            "local_id"=> "3.528",
            "local_name"=> "Kawilasi Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "402",
            "local_level_id"=> "402",
            "province_id"=> "2",
            "local_id"=> "3.529",
            "local_name"=> "Chakraghatta Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "403",
            "local_level_id"=> "403",
            "province_id"=> "2",
            "local_id"=> "3.53",
            "local_name"=> "Chandranagar Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "404",
            "local_level_id"=> "404",
            "province_id"=> "2",
            "local_id"=> "3.531",
            "local_name"=> "Dhankaul Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "405",
            "local_level_id"=> "405",
            "province_id"=> "2",
            "local_id"=> "3.532",
            "local_name"=> "Brahmapuri Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "406",
            "local_level_id"=> "406",
            "province_id"=> "2",
            "local_id"=> "3.533",
            "local_name"=> "Ramnagar Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "407",
            "local_level_id"=> "407",
            "province_id"=> "2",
            "local_id"=> "3.534",
            "local_name"=> "Bishnu Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "408",
            "local_level_id"=> "408",
            "province_id"=> "3",
            "local_id"=> "3.535",
            "local_name"=> "Golanjor Rural-Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "409",
            "local_level_id"=> "409",
            "province_id"=> "3",
            "local_id"=> "3.536",
            "local_name"=> "Ghyanglekh Rural-Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "410",
            "local_level_id"=> "410",
            "province_id"=> "3",
            "local_id"=> "3.537",
            "local_name"=> "Tinpatan Rural-Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "411",
            "local_level_id"=> "411",
            "province_id"=> "3",
            "local_id"=> "3.538",
            "local_name"=> "Phikkal Rural-Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "412",
            "local_level_id"=> "412",
            "province_id"=> "3",
            "local_id"=> "3.539",
            "local_name"=> "Marin Rural-Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "413",
            "local_level_id"=> "413",
            "province_id"=> "3",
            "local_id"=> "3.54",
            "local_name"=> "Sunkoshi Rural-Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "414",
            "local_level_id"=> "414",
            "province_id"=> "3",
            "local_id"=> "3.541",
            "local_name"=> "Hariharpurgadhi Rural-Municipality",
            "dist_id"=> "20",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "415",
            "local_level_id"=> "415",
            "province_id"=> "3",
            "local_id"=> "3.542",
            "local_name"=> "Umakund Rural-Municipality",
            "dist_id"=> "21",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "416",
            "local_level_id"=> "416",
            "province_id"=> "3",
            "local_id"=> "3.543",
            "local_name"=> "Khanddevi Rural-Municipality",
            "dist_id"=> "21",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "417",
            "local_level_id"=> "417",
            "province_id"=> "3",
            "local_id"=> "3.544",
            "local_name"=> "Gokulganga Rural-Municipality",
            "dist_id"=> "21",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "418",
            "local_level_id"=> "418",
            "province_id"=> "3",
            "local_id"=> "3.545",
            "local_name"=> "Doramba Shailung Rural-Municipality",
            "dist_id"=> "21",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2021-05-27"
       ],
        [
            "id"=> "419",
            "local_level_id"=> "419",
            "province_id"=> "3",
            "local_id"=> "3.546",
            "local_name"=> "Likhu Tamakoshi Rural-Municipality",
            "dist_id"=> "21",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "420",
            "local_level_id"=> "420",
            "province_id"=> "3",
            "local_id"=> "3.547",
            "local_name"=> "Sunapati Rural-Municipality",
            "dist_id"=> "21",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "421",
            "local_level_id"=> "421",
            "province_id"=> "3",
            "local_id"=> "3.548",
            "local_name"=> "Kalinchowk Rural-Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "422",
            "local_level_id"=> "422",
            "province_id"=> "3",
            "local_id"=> "3.549",
            "local_name"=> "Gaurishankar Rural-Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "423",
            "local_level_id"=> "423",
            "province_id"=> "3",
            "local_id"=> "3.55",
            "local_name"=> "Tamakoshi Rural-Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "424",
            "local_level_id"=> "424",
            "province_id"=> "3",
            "local_id"=> "3.551",
            "local_name"=> "Baiteshwor Rural-Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "425",
            "local_level_id"=> "425",
            "province_id"=> "3",
            "local_id"=> "3.552",
            "local_name"=> "Melung Rural-Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "426",
            "local_level_id"=> "426",
            "province_id"=> "3",
            "local_id"=> "3.553",
            "local_name"=> "Bigu Rural-Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "427",
            "local_level_id"=> "427",
            "province_id"=> "3",
            "local_id"=> "3.554",
            "local_name"=> "Shailung Rural-Municipality",
            "dist_id"=> "22",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "428",
            "local_level_id"=> "428",
            "province_id"=> "3",
            "local_id"=> "3.555",
            "local_name"=> "Indrawati Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "429",
            "local_level_id"=> "429",
            "province_id"=> "3",
            "local_id"=> "3.556",
            "local_name"=> "Jugal Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "430",
            "local_level_id"=> "430",
            "province_id"=> "3",
            "local_id"=> "3.557",
            "local_name"=> "Tripurasundari Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "431",
            "local_level_id"=> "431",
            "province_id"=> "3",
            "local_id"=> "3.558",
            "local_name"=> "Panchpokhari Thangpal Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "432",
            "local_level_id"=> "432",
            "province_id"=> "3",
            "local_id"=> "3.559",
            "local_name"=> "Balephi Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "433",
            "local_level_id"=> "433",
            "province_id"=> "3",
            "local_id"=> "3.56",
            "local_name"=> "Bhotekoshi Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "434",
            "local_level_id"=> "434",
            "province_id"=> "3",
            "local_id"=> "3.561",
            "local_name"=> "Lisankhu Pakhar Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "435",
            "local_level_id"=> "435",
            "province_id"=> "3",
            "local_id"=> "3.562",
            "local_name"=> "Sunkoshi Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "436",
            "local_level_id"=> "436",
            "province_id"=> "3",
            "local_id"=> "3.563",
            "local_name"=> "Helambu Rural-Municipality",
            "dist_id"=> "23",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "437",
            "local_level_id"=> "437",
            "province_id"=> "3",
            "local_id"=> "3.564",
            "local_name"=> "Uttargaya Rural-Municipality",
            "dist_id"=> "24",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "438",
            "local_level_id"=> "438",
            "province_id"=> "3",
            "local_id"=> "3.565",
            "local_name"=> "Kalika Rural-Municipality",
            "dist_id"=> "24",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "439",
            "local_level_id"=> "439",
            "province_id"=> "3",
            "local_id"=> "3.566",
            "local_name"=> "Gosaikund Rural-Municipality",
            "dist_id"=> "24",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "440",
            "local_level_id"=> "440",
            "province_id"=> "3",
            "local_id"=> "3.567",
            "local_name"=> "Naukunda Rural-Municipality",
            "dist_id"=> "24",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "441",
            "local_level_id"=> "441",
            "province_id"=> "3",
            "local_id"=> "3.568",
            "local_name"=> "Aamachhoding Rural-Municipality",
            "dist_id"=> "24",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "442",
            "local_level_id"=> "442",
            "province_id"=> "3",
            "local_id"=> "3.569",
            "local_name"=> "Khaniyabas Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "443",
            "local_level_id"=> "443",
            "province_id"=> "3",
            "local_id"=> "3.57",
            "local_name"=> "Gangajamuna Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "444",
            "local_level_id"=> "444",
            "province_id"=> "3",
            "local_id"=> "3.571",
            "local_name"=> "Gajuri Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "445",
            "local_level_id"=> "445",
            "province_id"=> "3",
            "local_id"=> "3.572",
            "local_name"=> "Galchhi Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "446",
            "local_level_id"=> "446",
            "province_id"=> "3",
            "local_id"=> "3.573",
            "local_name"=> "Jwalamukhi Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "447",
            "local_level_id"=> "447",
            "province_id"=> "3",
            "local_id"=> "3.574",
            "local_name"=> "Tripurasundari Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "448",
            "local_level_id"=> "448",
            "province_id"=> "3",
            "local_id"=> "3.575",
            "local_name"=> "Thakre Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "449",
            "local_level_id"=> "449",
            "province_id"=> "3",
            "local_id"=> "3.576",
            "local_name"=> "Netrabati Dabjong Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "450",
            "local_level_id"=> "450",
            "province_id"=> "3",
            "local_id"=> "3.577",
            "local_name"=> "Benighat Rorang Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "451",
            "local_level_id"=> "451",
            "province_id"=> "3",
            "local_id"=> "3.578",
            "local_name"=> "Rubi Bhyali Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "452",
            "local_level_id"=> "452",
            "province_id"=> "3",
            "local_id"=> "3.579",
            "local_name"=> "Siddhalek Rural-Municipality",
            "dist_id"=> "25",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "453",
            "local_level_id"=> "453",
            "province_id"=> "3",
            "local_id"=> "3.58",
            "local_name"=> "Kakani Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "454",
            "local_level_id"=> "454",
            "province_id"=> "3",
            "local_id"=> "3.581",
            "local_name"=> "Kispang Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "455",
            "local_level_id"=> "455",
            "province_id"=> "3",
            "local_id"=> "3.582",
            "local_name"=> "Tadi Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "456",
            "local_level_id"=> "456",
            "province_id"=> "3",
            "local_id"=> "3.583",
            "local_name"=> "Tarkeshwor Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "457",
            "local_level_id"=> "457",
            "province_id"=> "3",
            "local_id"=> "3.584",
            "local_name"=> "Dupcheshwor Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "458",
            "local_level_id"=> "458",
            "province_id"=> "3",
            "local_id"=> "3.585",
            "local_name"=> "Panchkanya Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "459",
            "local_level_id"=> "459",
            "province_id"=> "3",
            "local_id"=> "3.586",
            "local_name"=> "Myagang Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "460",
            "local_level_id"=> "460",
            "province_id"=> "3",
            "local_id"=> "3.587",
            "local_name"=> "Likhu Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "461",
            "local_level_id"=> "461",
            "province_id"=> "3",
            "local_id"=> "3.588",
            "local_name"=> "Shivpuri Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "462",
            "local_level_id"=> "462",
            "province_id"=> "3",
            "local_id"=> "3.589",
            "local_name"=> "Suryagadhi Rural-Municipality",
            "dist_id"=> "26",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "463",
            "local_level_id"=> "463",
            "province_id"=> "3",
            "local_id"=> "3.59",
            "local_name"=> "Konjyosom Rural-Municipality",
            "dist_id"=> "28",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "464",
            "local_level_id"=> "464",
            "province_id"=> "3",
            "local_id"=> "3.591",
            "local_name"=> "Bagmati Rural-Municipality",
            "dist_id"=> "28",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "465",
            "local_level_id"=> "465",
            "province_id"=> "3",
            "local_id"=> "3.592",
            "local_name"=> "Mahankal Rural-Municipality",
            "dist_id"=> "28",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "466",
            "local_level_id"=> "466",
            "province_id"=> "3",
            "local_id"=> "3.593",
            "local_name"=> "Khanikhola Rural-Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "467",
            "local_level_id"=> "467",
            "province_id"=> "3",
            "local_id"=> "3.594",
            "local_name"=> "Chauridewrali Rural-Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "468",
            "local_level_id"=> "468",
            "province_id"=> "3",
            "local_id"=> "3.595",
            "local_name"=> "Temal Rural-Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "469",
            "local_level_id"=> "469",
            "province_id"=> "3",
            "local_id"=> "3.596",
            "local_name"=> "Bethanchowk Rural-Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "470",
            "local_level_id"=> "470",
            "province_id"=> "3",
            "local_id"=> "3.597",
            "local_name"=> "Bhumlu Rural-Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "471",
            "local_level_id"=> "471",
            "province_id"=> "3",
            "local_id"=> "3.598",
            "local_name"=> "Mahabharat Rural-Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "472",
            "local_level_id"=> "472",
            "province_id"=> "3",
            "local_id"=> "3.599",
            "local_name"=> "Roshi Rural-Municipality",
            "dist_id"=> "30",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "473",
            "local_level_id"=> "473",
            "province_id"=> "3",
            "local_id"=> "3.6",
            "local_name"=> "Indrasarowar Rural-Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "474",
            "local_level_id"=> "474",
            "province_id"=> "3",
            "local_id"=> "3.601",
            "local_name"=> "Kailash Rural-Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "475",
            "local_level_id"=> "475",
            "province_id"=> "3",
            "local_id"=> "3.602",
            "local_name"=> "Bakaiya Rural-Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "476",
            "local_level_id"=> "476",
            "province_id"=> "3",
            "local_id"=> "3.603",
            "local_name"=> "Bagmati Rural-Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "477",
            "local_level_id"=> "477",
            "province_id"=> "3",
            "local_id"=> "3.604",
            "local_name"=> "Bhimphedi Rural-Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "478",
            "local_level_id"=> "478",
            "province_id"=> "3",
            "local_id"=> "3.605",
            "local_name"=> "Makwanpurgadghi Rural-Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "479",
            "local_level_id"=> "479",
            "province_id"=> "3",
            "local_id"=> "3.606",
            "local_name"=> "Manhari Rural-Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "480",
            "local_level_id"=> "480",
            "province_id"=> "3",
            "local_id"=> "3.607",
            "local_name"=> "Raksirang Rural-Municipality",
            "dist_id"=> "31",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "481",
            "local_level_id"=> "481",
            "province_id"=> "2",
            "local_id"=> "3.608",
            "local_name"=> "Ishnath Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "482",
            "local_level_id"=> "482",
            "province_id"=> "2",
            "local_id"=> "3.609",
            "local_name"=> "Katahariya Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "483",
            "local_level_id"=> "483",
            "province_id"=> "2",
            "local_id"=> "3.61",
            "local_name"=> "Gadhimai Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "484",
            "local_level_id"=> "484",
            "province_id"=> "2",
            "local_id"=> "3.611",
            "local_name"=> "Gajura Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "485",
            "local_level_id"=> "485",
            "province_id"=> "2",
            "local_id"=> "3.612",
            "local_name"=> "Durgabhagawati Rural-Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "486",
            "local_level_id"=> "486",
            "province_id"=> "2",
            "local_id"=> "3.613",
            "local_name"=> "Dewahigonahi Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "487",
            "local_level_id"=> "487",
            "province_id"=> "2",
            "local_id"=> "3.614",
            "local_name"=> "Paroha Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "488",
            "local_level_id"=> "488",
            "province_id"=> "2",
            "local_id"=> "3.615",
            "local_name"=> "Phatuwa Bijaypur Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "489",
            "local_level_id"=> "489",
            "province_id"=> "2",
            "local_id"=> "3.616",
            "local_name"=> "Baudhimai Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "490",
            "local_level_id"=> "490",
            "province_id"=> "2",
            "local_id"=> "3.617",
            "local_name"=> "Madhavnarayan Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "491",
            "local_level_id"=> "491",
            "province_id"=> "2",
            "local_id"=> "3.618",
            "local_name"=> "Maulapur Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "492",
            "local_level_id"=> "492",
            "province_id"=> "2",
            "local_id"=> "3.619",
            "local_name"=> "Rajpur Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "493",
            "local_level_id"=> "493",
            "province_id"=> "2",
            "local_id"=> "3.62",
            "local_name"=> "Brindawan Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "494",
            "local_level_id"=> "494",
            "province_id"=> "2",
            "local_id"=> "3.621",
            "local_name"=> "Adarsh kotwal Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "495",
            "local_level_id"=> "495",
            "province_id"=> "2",
            "local_id"=> "3.622",
            "local_name"=> "Karaiyamai Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "496",
            "local_level_id"=> "496",
            "province_id"=> "2",
            "local_id"=> "3.623",
            "local_name"=> "Devtal Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "497",
            "local_level_id"=> "497",
            "province_id"=> "2",
            "local_id"=> "3.624",
            "local_name"=> "Pachrauta Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "498",
            "local_level_id"=> "498",
            "province_id"=> "2",
            "local_id"=> "3.625",
            "local_name"=> "Parwanipur Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "499",
            "local_level_id"=> "499",
            "province_id"=> "2",
            "local_id"=> "3.626",
            "local_name"=> "Prasauni Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "500",
            "local_level_id"=> "500",
            "province_id"=> "2",
            "local_id"=> "3.627",
            "local_name"=> "Pheta Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "501",
            "local_level_id"=> "501",
            "province_id"=> "2",
            "local_id"=> "3.628",
            "local_name"=> "Baragadhi Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "502",
            "local_level_id"=> "502",
            "province_id"=> "2",
            "local_id"=> "3.629",
            "local_name"=> "Subarn Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "503",
            "local_level_id"=> "503",
            "province_id"=> "2",
            "local_id"=> "3.63",
            "local_name"=> "Chhipaharmai Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "504",
            "local_level_id"=> "504",
            "province_id"=> "2",
            "local_id"=> "3.631",
            "local_name"=> "Jagarnathpur Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "505",
            "local_level_id"=> "505",
            "province_id"=> "2",
            "local_id"=> "3.632",
            "local_name"=> "Dhobini Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "506",
            "local_level_id"=> "506",
            "province_id"=> "2",
            "local_id"=> "3.633",
            "local_name"=> "Pakaha Mainpur Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "507",
            "local_level_id"=> "507",
            "province_id"=> "2",
            "local_id"=> "3.634",
            "local_name"=> "Poterwa Sugauli Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "508",
            "local_level_id"=> "508",
            "province_id"=> "2",
            "local_id"=> "3.635",
            "local_name"=> "Parsagadhi Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "509",
            "local_level_id"=> "509",
            "province_id"=> "2",
            "local_id"=> "3.636",
            "local_name"=> "Bahadurmai Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "510",
            "local_level_id"=> "510",
            "province_id"=> "2",
            "local_id"=> "3.638",
            "local_name"=> "Chhindabasini Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "511",
            "local_level_id"=> "511",
            "province_id"=> "2",
            "local_id"=> "3.639",
            "local_name"=> "Sakuwa Prasauni Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "512",
            "local_level_id"=> "512",
            "province_id"=> "2",
            "local_id"=> "3.64",
            "local_name"=> "Thori Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "513",
            "local_level_id"=> "513",
            "province_id"=> "3",
            "local_id"=> "3.641",
            "local_name"=> "Ichchhakamana Rural-Municipality",
            "dist_id"=> "35",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "514",
            "local_level_id"=> "514",
            "province_id"=> "5",
            "local_id"=> "3.642",
            "local_name"=> "Susta Rural-Municipality",
            "dist_id"=> "36",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "515",
            "local_level_id"=> "515",
            "province_id"=> "5",
            "local_id"=> "3.643",
            "local_name"=> "Palhinandan Rural-Municipality",
            "dist_id"=> "36",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "516",
            "local_level_id"=> "516",
            "province_id"=> "5",
            "local_id"=> "3.644",
            "local_name"=> "Pratappur Rural-Municipality",
            "dist_id"=> "36",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "517",
            "local_level_id"=> "517",
            "province_id"=> "4",
            "local_id"=> "3.645",
            "local_name"=> "Baudikali Rural-Municipality",
            "dist_id"=> "76",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "518",
            "local_level_id"=> "518",
            "province_id"=> "4",
            "local_id"=> "3.646",
            "local_name"=> "Bulingtar Rural-Municipality",
            "dist_id"=> "76",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "519",
            "local_level_id"=> "519",
            "province_id"=> "4",
            "local_id"=> "3.647",
            "local_name"=> "Binayee Tribeni Rural-Municipality",
            "dist_id"=> "76",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "520",
            "local_level_id"=> "520",
            "province_id"=> "5",
            "local_id"=> "3.648",
            "local_name"=> "Sarawal Rural-Municipality",
            "dist_id"=> "36",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "521",
            "local_level_id"=> "521",
            "province_id"=> "4",
            "local_id"=> "3.649",
            "local_name"=> "Hupsekot Rural-Municipality",
            "dist_id"=> "76",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "522",
            "local_level_id"=> "522",
            "province_id"=> "5",
            "local_id"=> "3.65",
            "local_name"=> "Omsatiya Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "523",
            "local_level_id"=> "523",
            "province_id"=> "5",
            "local_id"=> "3.651",
            "local_name"=> "Kanchan Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "524",
            "local_level_id"=> "524",
            "province_id"=> "5",
            "local_id"=> "3.652",
            "local_name"=> "Kotahimai Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "525",
            "local_level_id"=> "525",
            "province_id"=> "5",
            "local_id"=> "3.653",
            "local_name"=> "Gaidahawa Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "526",
            "local_level_id"=> "526",
            "province_id"=> "5",
            "local_id"=> "3.654",
            "local_name"=> "Marchawari Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "527",
            "local_level_id"=> "527",
            "province_id"=> "5",
            "local_id"=> "3.655",
            "local_name"=> "Mayadevi Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "528",
            "local_level_id"=> "528",
            "province_id"=> "5",
            "local_id"=> "3.656",
            "local_name"=> "Rohini Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "529",
            "local_level_id"=> "529",
            "province_id"=> "5",
            "local_id"=> "3.657",
            "local_name"=> "Suddhodan Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "530",
            "local_level_id"=> "530",
            "province_id"=> "5",
            "local_id"=> "3.658",
            "local_name"=> "Sammarimai Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "531",
            "local_level_id"=> "531",
            "province_id"=> "5",
            "local_id"=> "3.659",
            "local_name"=> "Siyari Rural-Municipality",
            "dist_id"=> "37",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "532",
            "local_level_id"=> "532",
            "province_id"=> "5",
            "local_id"=> "3.66",
            "local_name"=> "Mayadevi Rural-Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "533",
            "local_level_id"=> "533",
            "province_id"=> "5",
            "local_id"=> "3.661",
            "local_name"=> "Yashodhara Rural-Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "534",
            "local_level_id"=> "534",
            "province_id"=> "5",
            "local_id"=> "3.662",
            "local_name"=> "Bijaynagar Rural-Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "535",
            "local_level_id"=> "535",
            "province_id"=> "5",
            "local_id"=> "3.663",
            "local_name"=> "Suddhodhan Rural-Municipality",
            "dist_id"=> "38",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "536",
            "local_level_id"=> "536",
            "province_id"=> "5",
            "local_id"=> "3.664",
            "local_name"=> "Chhatradev Rural-Municipality",
            "dist_id"=> "39",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "537",
            "local_level_id"=> "537",
            "province_id"=> "5",
            "local_id"=> "3.665",
            "local_name"=> "Panini Rural-Municipality",
            "dist_id"=> "39",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "538",
            "local_level_id"=> "538",
            "province_id"=> "5",
            "local_id"=> "3.666",
            "local_name"=> "Malarani Rural-Municipality",
            "dist_id"=> "39",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "539",
            "local_level_id"=> "539",
            "province_id"=> "5",
            "local_id"=> "3.667",
            "local_name"=> "Tianu Rural-Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "540",
            "local_level_id"=> "540",
            "province_id"=> "5",
            "local_id"=> "3.668",
            "local_name"=> "Nisdi Rural-Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "541",
            "local_level_id"=> "541",
            "province_id"=> "5",
            "local_id"=> "3.669",
            "local_name"=> "Purbakhola Rural-Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "542",
            "local_level_id"=> "542",
            "province_id"=> "5",
            "local_id"=> "3.67",
            "local_name"=> "Bagnaskali Rural-Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "543",
            "local_level_id"=> "543",
            "province_id"=> "5",
            "local_id"=> "3.671",
            "local_name"=> "Mathagadhi Rural-Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "544",
            "local_level_id"=> "544",
            "province_id"=> "5",
            "local_id"=> "3.672",
            "local_name"=> "Rambha Rural-Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "545",
            "local_level_id"=> "545",
            "province_id"=> "5",
            "local_id"=> "3.673",
            "local_name"=> "Ribdikot Rural-Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "546",
            "local_level_id"=> "546",
            "province_id"=> "5",
            "local_id"=> "3.674",
            "local_name"=> "Rainadevi Chhahara Rural-Municipality",
            "dist_id"=> "40",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "547",
            "local_level_id"=> "547",
            "province_id"=> "5",
            "local_id"=> "3.675",
            "local_name"=> "Isma Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "548",
            "local_level_id"=> "548",
            "province_id"=> "5",
            "local_id"=> "3.676",
            "local_name"=> "Kaligandaki Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "549",
            "local_level_id"=> "549",
            "province_id"=> "5",
            "local_id"=> "3.677",
            "local_name"=> "Gulmi Darbar Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "550",
            "local_level_id"=> "550",
            "province_id"=> "5",
            "local_id"=> "3.678",
            "local_name"=> "Chandrakot Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "551",
            "local_level_id"=> "551",
            "province_id"=> "5",
            "local_id"=> "3.679",
            "local_name"=> "Chhatrakot Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "552",
            "local_level_id"=> "552",
            "province_id"=> "5",
            "local_id"=> "3.68",
            "local_name"=> "Dhurkot Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "553",
            "local_level_id"=> "553",
            "province_id"=> "5",
            "local_id"=> "3.681",
            "local_name"=> "Madane Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "554",
            "local_level_id"=> "554",
            "province_id"=> "5",
            "local_id"=> "3.682",
            "local_name"=> "Malika Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "555",
            "local_level_id"=> "555",
            "province_id"=> "5",
            "local_id"=> "3.683",
            "local_name"=> "Ruruchhetra Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "556",
            "local_level_id"=> "556",
            "province_id"=> "5",
            "local_id"=> "3.684",
            "local_name"=> "Satyawati Rural-Municipality",
            "dist_id"=> "41",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "557",
            "local_level_id"=> "557",
            "province_id"=> "4",
            "local_id"=> "3.685",
            "local_name"=> "Arjunchaupari Rural-Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "558",
            "local_level_id"=> "558",
            "province_id"=> "4",
            "local_id"=> "3.686",
            "local_name"=> "Andhikhola Rural-Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "559",
            "local_level_id"=> "559",
            "province_id"=> "4",
            "local_id"=> "3.687",
            "local_name"=> "Kaligandaki Rural-Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "560",
            "local_level_id"=> "560",
            "province_id"=> "4",
            "local_id"=> "3.688",
            "local_name"=> "Phedikhola Rural-Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "561",
            "local_level_id"=> "561",
            "province_id"=> "4",
            "local_id"=> "3.689",
            "local_name"=> "Biruwa Rural-Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "562",
            "local_level_id"=> "562",
            "province_id"=> "4",
            "local_id"=> "3.69",
            "local_name"=> "Harinas Rural-Municipality",
            "dist_id"=> "42",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "563",
            "local_level_id"=> "563",
            "province_id"=> "4",
            "local_id"=> "3.691",
            "local_name"=> "Anbukhaireni Rural-Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "564",
            "local_level_id"=> "564",
            "province_id"=> "4",
            "local_id"=> "3.692",
            "local_name"=> "Rhishing Rural-Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "565",
            "local_level_id"=> "565",
            "province_id"=> "4",
            "local_id"=> "3.693",
            "local_name"=> "Ghiring Rural-Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "566",
            "local_level_id"=> "566",
            "province_id"=> "4",
            "local_id"=> "3.694",
            "local_name"=> "Devghat Rural-Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "567",
            "local_level_id"=> "567",
            "province_id"=> "4",
            "local_id"=> "3.695",
            "local_name"=> "Myagde Rural-Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "568",
            "local_level_id"=> "568",
            "province_id"=> "4",
            "local_id"=> "3.696",
            "local_name"=> "Bandipur Rural-Municipality",
            "dist_id"=> "43",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "569",
            "local_level_id"=> "569",
            "province_id"=> "4",
            "local_id"=> "3.697",
            "local_name"=> "Ajirkot Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "570",
            "local_level_id"=> "570",
            "province_id"=> "4",
            "local_id"=> "3.698",
            "local_name"=> "Arughat Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "571",
            "local_level_id"=> "571",
            "province_id"=> "4",
            "local_id"=> "3.699",
            "local_name"=> "Gandaki Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "572",
            "local_level_id"=> "572",
            "province_id"=> "4",
            "local_id"=> "3.7",
            "local_name"=> "Chumanuwri Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "573",
            "local_level_id"=> "573",
            "province_id"=> "4",
            "local_id"=> "3.701",
            "local_name"=> "Dharche Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "574",
            "local_level_id"=> "574",
            "province_id"=> "4",
            "local_id"=> "3.702",
            "local_name"=> "Bhimsenthapa Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "575",
            "local_level_id"=> "575",
            "province_id"=> "4",
            "local_id"=> "3.703",
            "local_name"=> "Shahid Lakhan Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "576",
            "local_level_id"=> "576",
            "province_id"=> "4",
            "local_id"=> "3.704",
            "local_name"=> "Siranchowk Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "577",
            "local_level_id"=> "577",
            "province_id"=> "4",
            "local_id"=> "3.705",
            "local_name"=> "Barpak Sulikot Rural-Municipality",
            "dist_id"=> "44",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "578",
            "local_level_id"=> "578",
            "province_id"=> "4",
            "local_id"=> "3.706",
            "local_name"=> "Chame Rural-Municipality",
            "dist_id"=> "45",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "579",
            "local_level_id"=> "579",
            "province_id"=> "4",
            "local_id"=> "3.707",
            "local_name"=> "Narpa Bhumi Rural-Municipality",
            "dist_id"=> "45",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "580",
            "local_level_id"=> "580",
            "province_id"=> "4",
            "local_id"=> "3.708",
            "local_name"=> "Nason Rural-Municipality",
            "dist_id"=> "45",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "581",
            "local_level_id"=> "581",
            "province_id"=> "4",
            "local_id"=> "3.709",
            "local_name"=> "Manang Dingsyang Rural-Municipality",
            "dist_id"=> "45",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "582",
            "local_level_id"=> "582",
            "province_id"=> "4",
            "local_id"=> "3.71",
            "local_name"=> "Kwholasothar Rural-Municipality",
            "dist_id"=> "46",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "583",
            "local_level_id"=> "583",
            "province_id"=> "4",
            "local_id"=> "3.711",
            "local_name"=> "Dudhpokhari Rural-Municipality",
            "dist_id"=> "46",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "584",
            "local_level_id"=> "584",
            "province_id"=> "4",
            "local_id"=> "3.712",
            "local_name"=> "Dordi Rural-Municipality",
            "dist_id"=> "46",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "585",
            "local_level_id"=> "585",
            "province_id"=> "4",
            "local_id"=> "3.713",
            "local_name"=> "Marsyangdi Rural-Municipality",
            "dist_id"=> "46",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "586",
            "local_level_id"=> "586",
            "province_id"=> "4",
            "local_id"=> "3.714",
            "local_name"=> "Annapurna Rural-Municipality",
            "dist_id"=> "47",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "587",
            "local_level_id"=> "587",
            "province_id"=> "4",
            "local_id"=> "3.715",
            "local_name"=> "Machhapuchhre Rural-Municipality",
            "dist_id"=> "47",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "588",
            "local_level_id"=> "588",
            "province_id"=> "4",
            "local_id"=> "3.716",
            "local_name"=> "Madi Rural-Municipality",
            "dist_id"=> "47",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "589",
            "local_level_id"=> "589",
            "province_id"=> "4",
            "local_id"=> "3.717",
            "local_name"=> "Rupa Rural-Municipality",
            "dist_id"=> "47",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "590",
            "local_level_id"=> "590",
            "province_id"=> "4",
            "local_id"=> "3.718",
            "local_name"=> "Jaljala Rural-Municipality",
            "dist_id"=> "48",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "591",
            "local_level_id"=> "591",
            "province_id"=> "4",
            "local_id"=> "3.719",
            "local_name"=> "Paiyun Rural-Municipality",
            "dist_id"=> "48",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "592",
            "local_level_id"=> "592",
            "province_id"=> "4",
            "local_id"=> "3.72",
            "local_name"=> "Mahashila Rural-Municipality",
            "dist_id"=> "48",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "593",
            "local_level_id"=> "593",
            "province_id"=> "4",
            "local_id"=> "3.721",
            "local_name"=> "Modi Rural-Municipality",
            "dist_id"=> "48",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "594",
            "local_level_id"=> "594",
            "province_id"=> "4",
            "local_id"=> "3.722",
            "local_name"=> "Bihadi Rural-Municipality",
            "dist_id"=> "48",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "595",
            "local_level_id"=> "595",
            "province_id"=> "4",
            "local_id"=> "3.723",
            "local_name"=> "Kathekhola Rural-Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "596",
            "local_level_id"=> "596",
            "province_id"=> "4",
            "local_id"=> "3.724",
            "local_name"=> "Tamankhola Rural-Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "597",
            "local_level_id"=> "597",
            "province_id"=> "4",
            "local_id"=> "3.725",
            "local_name"=> "Tarakhola Rural-Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "598",
            "local_level_id"=> "598",
            "province_id"=> "4",
            "local_id"=> "3.726",
            "local_name"=> "Nisikhola Rural-Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "599",
            "local_level_id"=> "599",
            "province_id"=> "4",
            "local_id"=> "3.727",
            "local_name"=> "Wadigad Rural-Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "600",
            "local_level_id"=> "600",
            "province_id"=> "4",
            "local_id"=> "3.728",
            "local_name"=> "Bareng Rural-Municipality",
            "dist_id"=> "49",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "601",
            "local_level_id"=> "601",
            "province_id"=> "4",
            "local_id"=> "3.729",
            "local_name"=> "Annapurna Rural-Municipality",
            "dist_id"=> "50",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "602",
            "local_level_id"=> "602",
            "province_id"=> "4",
            "local_id"=> "3.73",
            "local_name"=> "Dhaulagiri Rural-Municipality",
            "dist_id"=> "50",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "603",
            "local_level_id"=> "603",
            "province_id"=> "4",
            "local_id"=> "3.731",
            "local_name"=> "Mangala Rural-Municipality",
            "dist_id"=> "50",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "604",
            "local_level_id"=> "604",
            "province_id"=> "4",
            "local_id"=> "3.732",
            "local_name"=> "Malika Rural-Municipality",
            "dist_id"=> "50",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "605",
            "local_level_id"=> "605",
            "province_id"=> "4",
            "local_id"=> "3.733",
            "local_name"=> "Raghuganga Rural-Municipality",
            "dist_id"=> "50",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "606",
            "local_level_id"=> "606",
            "province_id"=> "4",
            "local_id"=> "3.734",
            "local_name"=> "Gharapjhong Rural-Municipality",
            "dist_id"=> "51",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "607",
            "local_level_id"=> "607",
            "province_id"=> "4",
            "local_id"=> "3.735",
            "local_name"=> "Thasang Rural-Municipality",
            "dist_id"=> "51",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "608",
            "local_level_id"=> "608",
            "province_id"=> "4",
            "local_id"=> "3.736",
            "local_name"=> "Loghekar Damodar Rural-Municipality",
            "dist_id"=> "51",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "609",
            "local_level_id"=> "609",
            "province_id"=> "4",
            "local_id"=> "3.737",
            "local_name"=> "Lomanthang Rural-Municipality",
            "dist_id"=> "51",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "610",
            "local_level_id"=> "610",
            "province_id"=> "4",
            "local_id"=> "3.738",
            "local_name"=> "Varagung Muktichhetra Rural-Municipality",
            "dist_id"=> "51",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "611",
            "local_level_id"=> "611",
            "province_id"=> "6",
            "local_id"=> "3.739",
            "local_name"=> "Khatyad Rural-Municipality",
            "dist_id"=> "52",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "612",
            "local_level_id"=> "612",
            "province_id"=> "6",
            "local_id"=> "3.74",
            "local_name"=> "Mugung Karmarong Rural-Municipality",
            "dist_id"=> "52",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "613",
            "local_level_id"=> "613",
            "province_id"=> "6",
            "local_id"=> "3.741",
            "local_name"=> "Soru Rural-Municipality",
            "dist_id"=> "52",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "614",
            "local_level_id"=> "614",
            "province_id"=> "6",
            "local_id"=> "3.742",
            "local_name"=> "Kaike Rural-Municipality",
            "dist_id"=> "53",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "615",
            "local_level_id"=> "615",
            "province_id"=> "6",
            "local_id"=> "3.743",
            "local_name"=> "Chharka tangsong Rural-Municipality",
            "dist_id"=> "53",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "616",
            "local_level_id"=> "616",
            "province_id"=> "6",
            "local_id"=> "3.744",
            "local_name"=> "Jagadulla Rural-Municipality",
            "dist_id"=> "53",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "617",
            "local_level_id"=> "617",
            "province_id"=> "6",
            "local_id"=> "3.745",
            "local_name"=> "Dolpo Buddha Rural-Municipality",
            "dist_id"=> "53",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "618",
            "local_level_id"=> "618",
            "province_id"=> "6",
            "local_id"=> "3.746",
            "local_name"=> "Mudkechula Rural-Municipality",
            "dist_id"=> "53",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "619",
            "local_level_id"=> "619",
            "province_id"=> "6",
            "local_id"=> "3.747",
            "local_name"=> "Shephoksundo Rural-Municipality",
            "dist_id"=> "53",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "620",
            "local_level_id"=> "620",
            "province_id"=> "6",
            "local_id"=> "3.748",
            "local_name"=> "Adanchuli Rural-Municipality",
            "dist_id"=> "54",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "621",
            "local_level_id"=> "621",
            "province_id"=> "6",
            "local_id"=> "3.749",
            "local_name"=> "Kharpunath Rural-Municipality",
            "dist_id"=> "54",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "622",
            "local_level_id"=> "622",
            "province_id"=> "6",
            "local_id"=> "3.75",
            "local_name"=> "Chankheli Rural-Municipality",
            "dist_id"=> "54",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "623",
            "local_level_id"=> "623",
            "province_id"=> "6",
            "local_id"=> "3.751",
            "local_name"=> "Tanjakot Rural-Municipality",
            "dist_id"=> "54",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "624",
            "local_level_id"=> "624",
            "province_id"=> "6",
            "local_id"=> "3.752",
            "local_name"=> "Namkha Rural-Municipality",
            "dist_id"=> "54",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "625",
            "local_level_id"=> "625",
            "province_id"=> "6",
            "local_id"=> "3.753",
            "local_name"=> "Sarkegad Rural-Municipality",
            "dist_id"=> "54",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "626",
            "local_level_id"=> "626",
            "province_id"=> "6",
            "local_id"=> "3.754",
            "local_name"=> "Sinkot Rural-Municipality",
            "dist_id"=> "54",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "627",
            "local_level_id"=> "627",
            "province_id"=> "6",
            "local_id"=> "3.755",
            "local_name"=> "Kanakasunadri Rural-Municipality",
            "dist_id"=> "55",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "628",
            "local_level_id"=> "628",
            "province_id"=> "6",
            "local_id"=> "3.756",
            "local_name"=> "Guthichaur Rural-Municipality",
            "dist_id"=> "55",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "629",
            "local_level_id"=> "629",
            "province_id"=> "6",
            "local_id"=> "3.757",
            "local_name"=> "Tatopani Rural-Municipality",
            "dist_id"=> "55",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "630",
            "local_level_id"=> "630",
            "province_id"=> "6",
            "local_id"=> "3.758",
            "local_name"=> "Tila Rural-Municipality",
            "dist_id"=> "55",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "631",
            "local_level_id"=> "631",
            "province_id"=> "6",
            "local_id"=> "3.759",
            "local_name"=> "Patarasi Rural-Municipality",
            "dist_id"=> "55",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "632",
            "local_level_id"=> "632",
            "province_id"=> "6",
            "local_id"=> "3.76",
            "local_name"=> "Sinja Rural-Municipality",
            "dist_id"=> "55",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "633",
            "local_level_id"=> "633",
            "province_id"=> "6",
            "local_id"=> "3.761",
            "local_name"=> "Hima Rural-Municipality",
            "dist_id"=> "55",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "634",
            "local_level_id"=> "634",
            "province_id"=> "6",
            "local_id"=> "3.762",
            "local_name"=> "Shubha Kalika Rural-Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "635",
            "local_level_id"=> "635",
            "province_id"=> "6",
            "local_id"=> "3.763",
            "local_name"=> "Narharinath Rural-Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "636",
            "local_level_id"=> "636",
            "province_id"=> "6",
            "local_id"=> "3.764",
            "local_name"=> "Pachaljharana Rural-Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "637",
            "local_level_id"=> "637",
            "province_id"=> "6",
            "local_id"=> "3.765",
            "local_name"=> "Palata Rural-Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "638",
            "local_level_id"=> "638",
            "province_id"=> "6",
            "local_id"=> "3.766",
            "local_name"=> "Mahawai Rural-Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "639",
            "local_level_id"=> "639",
            "province_id"=> "6",
            "local_id"=> "3.767",
            "local_name"=> "Sanni Tribeni Rural-Municipality",
            "dist_id"=> "56",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "640",
            "local_level_id"=> "640",
            "province_id"=> "6",
            "local_id"=> "3.768",
            "local_name"=> "Tribeni Rural-Municipality",
            "dist_id"=> "57",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "641",
            "local_level_id"=> "641",
            "province_id"=> "5",
            "local_id"=> "3.769",
            "local_name"=> "Puth Uttarganga Rural-Municipality",
            "dist_id"=> "77",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "642",
            "local_level_id"=> "642",
            "province_id"=> "6",
            "local_id"=> "3.77",
            "local_name"=> "Banfikot Rural-Municipality",
            "dist_id"=> "57",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "643",
            "local_level_id"=> "643",
            "province_id"=> "5",
            "local_id"=> "3.771",
            "local_name"=> "Bhume Rural-Municipality",
            "dist_id"=> "77",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "644",
            "local_level_id"=> "644",
            "province_id"=> "6",
            "local_id"=> "3.772",
            "local_name"=> "Sanibheri Rural-Municipality",
            "dist_id"=> "57",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "645",
            "local_level_id"=> "645",
            "province_id"=> "5",
            "local_id"=> "3.773",
            "local_name"=> "Sisne Rural-Municipality",
            "dist_id"=> "77",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "646",
            "local_level_id"=> "646",
            "province_id"=> "5",
            "local_id"=> "3.774",
            "local_name"=> "Tribeni Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "647",
            "local_level_id"=> "647",
            "province_id"=> "5",
            "local_id"=> "3.775",
            "local_name"=> "Thawang Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "648",
            "local_level_id"=> "648",
            "province_id"=> "5",
            "local_id"=> "3.776",
            "local_name"=> "Paribartan Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "649",
            "local_level_id"=> "649",
            "province_id"=> "5",
            "local_id"=> "3.777",
            "local_name"=> "Madi Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "650",
            "local_level_id"=> "650",
            "province_id"=> "5",
            "local_id"=> "3.778",
            "local_name"=> "Runtigadhi Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "651",
            "local_level_id"=> "651",
            "province_id"=> "5",
            "local_id"=> "3.779",
            "local_name"=> "Lungri Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "652",
            "local_level_id"=> "652",
            "province_id"=> "5",
            "local_id"=> "3.78",
            "local_name"=> "Gangadev Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "653",
            "local_level_id"=> "653",
            "province_id"=> "5",
            "local_id"=> "3.781",
            "local_name"=> "Sunchhahari Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "654",
            "local_level_id"=> "654",
            "province_id"=> "5",
            "local_id"=> "3.782",
            "local_name"=> "Sunil Smriti Rural-Municipality",
            "dist_id"=> "58",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "655",
            "local_level_id"=> "655",
            "province_id"=> "5",
            "local_id"=> "3.783",
            "local_name"=> "Ayirabati Rural-Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "656",
            "local_level_id"=> "656",
            "province_id"=> "5",
            "local_id"=> "3.784",
            "local_name"=> "Gaumukhi Rural-Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "657",
            "local_level_id"=> "657",
            "province_id"=> "5",
            "local_id"=> "3.785",
            "local_name"=> "Jhimruk Rural-Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "658",
            "local_level_id"=> "658",
            "province_id"=> "5",
            "local_id"=> "3.786",
            "local_name"=> "Naubahini Rural-Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "659",
            "local_level_id"=> "659",
            "province_id"=> "5",
            "local_id"=> "3.787",
            "local_name"=> "Mallarani Rural-Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "660",
            "local_level_id"=> "660",
            "province_id"=> "5",
            "local_id"=> "3.788",
            "local_name"=> "Mandavi Rural-Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "661",
            "local_level_id"=> "661",
            "province_id"=> "5",
            "local_id"=> "3.789",
            "local_name"=> "Sarumarani Rural-Municipality",
            "dist_id"=> "59",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "662",
            "local_level_id"=> "662",
            "province_id"=> "5",
            "local_id"=> "3.79",
            "local_name"=> "Gadhwa Rural-Municipality",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "663",
            "local_level_id"=> "663",
            "province_id"=> "5",
            "local_id"=> "3.791",
            "local_name"=> "Dangisharan Rural-Municipality",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "664",
            "local_level_id"=> "664",
            "province_id"=> "5",
            "local_id"=> "3.792",
            "local_name"=> "Bangalachuli Rural-Municipality",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "665",
            "local_level_id"=> "665",
            "province_id"=> "5",
            "local_id"=> "3.793",
            "local_name"=> "बबई Rural-Municipality",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "666",
            "local_level_id"=> "666",
            "province_id"=> "5",
            "local_id"=> "3.794",
            "local_name"=> "Rajpur Rural-Municipality",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "667",
            "local_level_id"=> "667",
            "province_id"=> "5",
            "local_id"=> "3.795",
            "local_name"=> "Rapti Rural-Municipality",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "668",
            "local_level_id"=> "668",
            "province_id"=> "5",
            "local_id"=> "3.796",
            "local_name"=> "Shantinagar Rural-Municipality",
            "dist_id"=> "60",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "669",
            "local_level_id"=> "669",
            "province_id"=> "6",
            "local_id"=> "3.797",
            "local_name"=> "Kapurkot Rural-Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "670",
            "local_level_id"=> "670",
            "province_id"=> "6",
            "local_id"=> "3.798",
            "local_name"=> "Kalimati Rural-Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "671",
            "local_level_id"=> "671",
            "province_id"=> "6",
            "local_id"=> "3.799",
            "local_name"=> "Kumakh Malika Rural-Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "672",
            "local_level_id"=> "672",
            "province_id"=> "6",
            "local_id"=> "3.8",
            "local_name"=> "Chhatreshwori Rural-Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "673",
            "local_level_id"=> "673",
            "province_id"=> "6",
            "local_id"=> "3.801",
            "local_name"=> "Siddha Kumakh Rural-Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "674",
            "local_level_id"=> "674",
            "province_id"=> "6",
            "local_id"=> "3.802",
            "local_name"=> "Tribeni Rural-Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "675",
            "local_level_id"=> "675",
            "province_id"=> "6",
            "local_id"=> "3.803",
            "local_name"=> "Darma Rural-Municipality",
            "dist_id"=> "61",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "676",
            "local_level_id"=> "676",
            "province_id"=> "5",
            "local_id"=> "3.804",
            "local_name"=> "Khajura Rural-Municipality",
            "dist_id"=> "62",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "677",
            "local_level_id"=> "677",
            "province_id"=> "5",
            "local_id"=> "3.805",
            "local_name"=> "Janaki Rural-Municipality",
            "dist_id"=> "62",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "678",
            "local_level_id"=> "678",
            "province_id"=> "5",
            "local_id"=> "3.806",
            "local_name"=> "Duduwa Rural-Municipality",
            "dist_id"=> "62",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "679",
            "local_level_id"=> "679",
            "province_id"=> "5",
            "local_id"=> "3.807",
            "local_name"=> "Narainapur Rural-Municipality",
            "dist_id"=> "62",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "680",
            "local_level_id"=> "680",
            "province_id"=> "5",
            "local_id"=> "3.808",
            "local_name"=> "Baijnath Rural-Municipality",
            "dist_id"=> "62",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "681",
            "local_level_id"=> "681",
            "province_id"=> "5",
            "local_id"=> "3.809",
            "local_name"=> "Raptisonari Rural-Municipality",
            "dist_id"=> "62",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "682",
            "local_level_id"=> "682",
            "province_id"=> "5",
            "local_id"=> "3.81",
            "local_name"=> "Geruwa Rural-Municipality",
            "dist_id"=> "63",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "683",
            "local_level_id"=> "683",
            "province_id"=> "5",
            "local_id"=> "3.811",
            "local_name"=> "Badhaiyatal Rural-Municipality",
            "dist_id"=> "63",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "684",
            "local_level_id"=> "684",
            "province_id"=> "6",
            "local_id"=> "3.812",
            "local_name"=> "Chingad Rural-Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "685",
            "local_level_id"=> "685",
            "province_id"=> "6",
            "local_id"=> "3.813",
            "local_name"=> "Chaukune Rural-Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "686",
            "local_level_id"=> "686",
            "province_id"=> "6",
            "local_id"=> "3.814",
            "local_name"=> "Barahtal Rural-Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "687",
            "local_level_id"=> "687",
            "province_id"=> "6",
            "local_id"=> "3.815",
            "local_name"=> "Simta Rural-Municipality",
            "dist_id"=> "64",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "688",
            "local_level_id"=> "688",
            "province_id"=> "6",
            "local_id"=> "3.816",
            "local_name"=> "Kuse Rural-Municipality",
            "dist_id"=> "65",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "689",
            "local_level_id"=> "689",
            "province_id"=> "6",
            "local_id"=> "3.817",
            "local_name"=> "JuniChande Rural-Municipality",
            "dist_id"=> "65",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "690",
            "local_level_id"=> "690",
            "province_id"=> "6",
            "local_id"=> "3.818",
            "local_name"=> "Barekot Rural-Municipality",
            "dist_id"=> "65",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "691",
            "local_level_id"=> "691",
            "province_id"=> "6",
            "local_id"=> "3.819",
            "local_name"=> "Shiwalaya Rural-Municipality",
            "dist_id"=> "65",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "692",
            "local_level_id"=> "692",
            "province_id"=> "6",
            "local_id"=> "3.82",
            "local_name"=> "Gurans Rural-Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "693",
            "local_level_id"=> "693",
            "province_id"=> "6",
            "local_id"=> "3.821",
            "local_name"=> "Thantikandh Rural-Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "694",
            "local_level_id"=> "694",
            "province_id"=> "6",
            "local_id"=> "3.822",
            "local_name"=> "Dungeshwor Rural-Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "695",
            "local_level_id"=> "695",
            "province_id"=> "6",
            "local_id"=> "3.823",
            "local_name"=> "Naumule Rural-Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "696",
            "local_level_id"=> "696",
            "province_id"=> "6",
            "local_id"=> "3.824",
            "local_name"=> "Bhagawatimai Rural-Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "697",
            "local_level_id"=> "697",
            "province_id"=> "6",
            "local_id"=> "3.825",
            "local_name"=> "Bhairavi Rural-Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "698",
            "local_level_id"=> "698",
            "province_id"=> "6",
            "local_id"=> "3.826",
            "local_name"=> "Mahabu Rural-Municipality",
            "dist_id"=> "66",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "699",
            "local_level_id"=> "699",
            "province_id"=> "7",
            "local_id"=> "3.827",
            "local_name"=> "Kailari Rural-Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "700",
            "local_level_id"=> "700",
            "province_id"=> "7",
            "local_id"=> "3.828",
            "local_name"=> "Chure Rural-Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "701",
            "local_level_id"=> "701",
            "province_id"=> "7",
            "local_id"=> "3.829",
            "local_name"=> "Janaki Rural-Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "702",
            "local_level_id"=> "702",
            "province_id"=> "7",
            "local_id"=> "3.83",
            "local_name"=> "Joshipur Rural-Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "703",
            "local_level_id"=> "703",
            "province_id"=> "7",
            "local_id"=> "3.831",
            "local_name"=> "Bardagoriya Rural-Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "704",
            "local_level_id"=> "704",
            "province_id"=> "7",
            "local_id"=> "3.832",
            "local_name"=> "Mohanyal Rural-Municipality",
            "dist_id"=> "67",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "705",
            "local_level_id"=> "705",
            "province_id"=> "7",
            "local_id"=> "3.833",
            "local_name"=> "Aadarsh Rural-Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "706",
            "local_level_id"=> "706",
            "province_id"=> "7",
            "local_id"=> "3.834",
            "local_name"=> "Kisingh Rural-Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "707",
            "local_level_id"=> "707",
            "province_id"=> "7",
            "local_id"=> "3.835",
            "local_name"=> "Jorayal Rural-Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "708",
            "local_level_id"=> "708",
            "province_id"=> "7",
            "local_id"=> "3.836",
            "local_name"=> "Purbichauki Rural-Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "709",
            "local_level_id"=> "709",
            "province_id"=> "7",
            "local_id"=> "3.837",
            "local_name"=> "Badikedar Rural-Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "710",
            "local_level_id"=> "710",
            "province_id"=> "7",
            "local_id"=> "3.838",
            "local_name"=> "Bogatan Fudsil Rural-Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "711",
            "local_level_id"=> "711",
            "province_id"=> "7",
            "local_id"=> "3.839",
            "local_name"=> "Sayal Rural-Municipality",
            "dist_id"=> "68",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "712",
            "local_level_id"=> "712",
            "province_id"=> "7",
            "local_id"=> "3.84",
            "local_name"=> "Chaurpati Rural-Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "713",
            "local_level_id"=> "713",
            "province_id"=> "7",
            "local_id"=> "3.841",
            "local_name"=> "Dhakari Rural-Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "714",
            "local_level_id"=> "714",
            "province_id"=> "7",
            "local_id"=> "3.842",
            "local_name"=> "Turmakhand Rural-Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "715",
            "local_level_id"=> "715",
            "province_id"=> "7",
            "local_id"=> "3.843",
            "local_name"=> "Bannigadhi Jaygadh Rural-Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "716",
            "local_level_id"=> "716",
            "province_id"=> "7",
            "local_id"=> "3.844",
            "local_name"=> "Mellekh Rural-Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "717",
            "local_level_id"=> "717",
            "province_id"=> "7",
            "local_id"=> "3.845",
            "local_name"=> "Ramaroshan Rural-Municipality",
            "dist_id"=> "69",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "718",
            "local_level_id"=> "718",
            "province_id"=> "7",
            "local_id"=> "3.846",
            "local_name"=> "Gaumul Rural-Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "719",
            "local_level_id"=> "719",
            "province_id"=> "7",
            "local_id"=> "3.847",
            "local_name"=> "Khaptad Chhodedah Rural-Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "720",
            "local_level_id"=> "720",
            "province_id"=> "7",
            "local_id"=> "3.848",
            "local_name"=> "Jagannath Rural-Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "721",
            "local_level_id"=> "721",
            "province_id"=> "7",
            "local_id"=> "3.849",
            "local_name"=> "Swamikartik Khapar Rural-Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "722",
            "local_level_id"=> "722",
            "province_id"=> "7",
            "local_id"=> "3.85",
            "local_name"=> "Himali Rural-Municipality",
            "dist_id"=> "70",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "723",
            "local_level_id"=> "723",
            "province_id"=> "7",
            "local_id"=> "3.851",
            "local_name"=> "Saipal Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "724",
            "local_level_id"=> "724",
            "province_id"=> "7",
            "local_id"=> "3.852",
            "local_name"=> "Kedarsyu Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "725",
            "local_level_id"=> "725",
            "province_id"=> "7",
            "local_id"=> "3.853",
            "local_name"=> "Khaptadchanna Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "726",
            "local_level_id"=> "726",
            "province_id"=> "7",
            "local_id"=> "3.854",
            "local_name"=> "Chhabispathibhera गाँउपालिका",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "727",
            "local_level_id"=> "727",
            "province_id"=> "7",
            "local_id"=> "3.855",
            "local_name"=> "Talkot Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "728",
            "local_level_id"=> "728",
            "province_id"=> "7",
            "local_id"=> "3.856",
            "local_name"=> "Thalara Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "729",
            "local_level_id"=> "729",
            "province_id"=> "7",
            "local_id"=> "3.857",
            "local_name"=> "Durgathali Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "730",
            "local_level_id"=> "730",
            "province_id"=> "7",
            "local_id"=> "3.858",
            "local_name"=> "Masta Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "731",
            "local_level_id"=> "731",
            "province_id"=> "7",
            "local_id"=> "3.859",
            "local_name"=> "Bitthadchir Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "732",
            "local_level_id"=> "732",
            "province_id"=> "7",
            "local_id"=> "3.86",
            "local_name"=> "Surma Rural-Municipality",
            "dist_id"=> "71",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "733",
            "local_level_id"=> "733",
            "province_id"=> "7",
            "local_id"=> "3.861",
            "local_name"=> "Apihimal Rural-Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "734",
            "local_level_id"=> "734",
            "province_id"=> "7",
            "local_id"=> "3.862",
            "local_name"=> "Duhun Rural-Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "735",
            "local_level_id"=> "735",
            "province_id"=> "7",
            "local_id"=> "3.863",
            "local_name"=> "Naugad Rural-Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "736",
            "local_level_id"=> "736",
            "province_id"=> "7",
            "local_id"=> "3.864",
            "local_name"=> "Byas Rural-Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "737",
            "local_level_id"=> "737",
            "province_id"=> "7",
            "local_id"=> "3.865",
            "local_name"=> "Marma Rural-Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "738",
            "local_level_id"=> "738",
            "province_id"=> "7",
            "local_id"=> "3.866",
            "local_name"=> "Malikarjun Rural-Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "739",
            "local_level_id"=> "739",
            "province_id"=> "7",
            "local_id"=> "3.867",
            "local_name"=> "Lekam Rural-Municipality",
            "dist_id"=> "72",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "740",
            "local_level_id"=> "740",
            "province_id"=> "7",
            "local_id"=> "3.868",
            "local_name"=> "Dilasaini Rural-Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "741",
            "local_level_id"=> "741",
            "province_id"=> "7",
            "local_id"=> "3.869",
            "local_name"=> "Dogdakedar Rural-Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "742",
            "local_level_id"=> "742",
            "province_id"=> "7",
            "local_id"=> "3.87",
            "local_name"=> "Pancheshwor Rural-Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "743",
            "local_level_id"=> "743",
            "province_id"=> "7",
            "local_id"=> "3.871",
            "local_name"=> "Shivnath Rural-Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "744",
            "local_level_id"=> "744",
            "province_id"=> "7",
            "local_id"=> "3.872",
            "local_name"=> "Sigas Rural-Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "745",
            "local_level_id"=> "745",
            "province_id"=> "7",
            "local_id"=> "3.873",
            "local_name"=> "Sunarya Rural-Municipality",
            "dist_id"=> "73",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "746",
            "local_level_id"=> "746",
            "province_id"=> "7",
            "local_id"=> "3.874",
            "local_name"=> "Ajaymeru Rural-Municipality",
            "dist_id"=> "74",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "747",
            "local_level_id"=> "747",
            "province_id"=> "7",
            "local_id"=> "3.875",
            "local_name"=> "Aalital Rural-Municipality",
            "dist_id"=> "74",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "748",
            "local_level_id"=> "748",
            "province_id"=> "7",
            "local_id"=> "3.876",
            "local_name"=> "GAnayapdhura Rural-Municipality",
            "dist_id"=> "74",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "749",
            "local_level_id"=> "749",
            "province_id"=> "7",
            "local_id"=> "3.877",
            "local_name"=> "Navdurga Rural-Municipality",
            "dist_id"=> "74",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "750",
            "local_level_id"=> "750",
            "province_id"=> "7",
            "local_id"=> "3.878",
            "local_name"=> "Bhageshwor Rural-Municipality",
            "dist_id"=> "74",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "751",
            "local_level_id"=> "751",
            "province_id"=> "7",
            "local_id"=> "3.879",
            "local_name"=> "Beldandi Rural-Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "752",
            "local_level_id"=> "752",
            "province_id"=> "7",
            "local_id"=> "3.88",
            "local_name"=> "Laljhadi Rural-Municipality",
            "dist_id"=> "75",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "753",
            "local_level_id"=> "753",
            "province_id"=> "2",
            "local_id"=> "3.881",
            "local_name"=> "Balan Bihul Rural-Municipality",
            "dist_id"=> "15",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "754",
            "local_level_id"=> "754",
            "province_id"=> "2",
            "local_id"=> "3.882",
            "local_name"=> "Dhanauji Rural-Municipality",
            "dist_id"=> "17",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "755",
            "local_level_id"=> "755",
            "province_id"=> "2",
            "local_id"=> "3.883",
            "local_name"=> "Basbariya Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "756",
            "local_level_id"=> "756",
            "province_id"=> "2",
            "local_id"=> "3.884",
            "local_name"=> "Kaudena Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "757",
            "local_level_id"=> "757",
            "province_id"=> "2",
            "local_id"=> "3.885",
            "local_name"=> "Parsa Rural-Municipality",
            "dist_id"=> "19",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "758",
            "local_level_id"=> "758",
            "province_id"=> "2",
            "local_id"=> "3.886",
            "local_name"=> "Yemunamai Rural-Municipality",
            "dist_id"=> "32",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "759",
            "local_level_id"=> "759",
            "province_id"=> "2",
            "local_id"=> "3.887",
            "local_name"=> "Bishrampur Rural-Municipality",
            "dist_id"=> "33",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "760",
            "local_level_id"=> "760",
            "province_id"=> "2",
            "local_id"=> "3.888",
            "local_name"=> "Kalikamai Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
       ],
        [
            "id"=> "761",
            "local_level_id"=> "761",
            "province_id"=> "2",
            "local_id"=> "3.889",
            "local_name"=> "Jirabhawani Rural-Municipality",
            "dist_id"=> "34",
            "created_at"=> "2020-01-02",
            "updated_at"=> "2020-01-02"
        ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
