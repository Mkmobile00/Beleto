<?php
namespace App\Data\Currency;

use App\Models\CurrencyRate;
use Illuminate\Support\Arr;

class CurrencyData
{
    protected $filters;
    function __construct($filters=[])
    {
        $this->filters = $filters;
    }
    public function getData()
    {
        $currencies = CurrencyRate::select([
            'id',
            'name',
            'code',
            'symbol',
        ])->orderBy('name')->get();
        return $currencies;
    }
    public function getSelectionData(){
        $currencies = CurrencyRate::select([
            'id',
            'name',
            'code',
            'symbol',
        ])
        ->whereHas('exchange')
        ->when(Arr::get($this->filters, 'currency_code'), function($q, $value){
            $q->where('code', strtoupper($value));
        })->orderBy('name')->get();

        $currencies = collect($currencies)->map(function($row, $index) {
            $text = $row['code'];
            $symbol = $row['code'];
            if($row['symbol'] !== null){
                $text = $row['code'].'['.$row['symbol'].']';
                $symbol = $row['symbol'];
            }
            return [
                'id'=>$row['id'],
                'text'=>$text,
                'value'=>$row['code'],
                'code'=>$row['code'],
                'symbol'=>$symbol,
            ];
        })->toArray();
        $start_currency = [
            "id"=>null,
            "text"=> "NPR",
            "value"=>"NPR",
            "code"=>"NPR",
            "symbol"=>"NPR",
        ];
        array_unshift($currencies, $start_currency);
        return $currencies;
    }
}
