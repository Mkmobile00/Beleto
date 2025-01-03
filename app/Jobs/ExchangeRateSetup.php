<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\CurrencyExchange;
use Illuminate\Support\Facades\Http;

class ExchangeRateSetup
{
    function __invoke()
    {
        $this->setExchange();
    }
    public function setExchange()
    {
        $date = Carbon::now()->toDateString();
        $final_result = $this->getExchange($date);
        $count = count($final_result);
        for ($i = 0; $i < 21; $i++) {
            $currency = CurrencyRate::where('code', $final_result[$i]['currency']['iso3'])->first();
            $currEx = null;
            if (!$currency) {
                $currency = new CurrencyRate();
                $currency->code = $final_result[$i]['currency']['iso3'];
                $currency->name = $final_result[$i]['currency']['iso3'];
                $currency->unit = $final_result[$i]['currency']['unit'];
                $currency->rate = number_format((float)$final_result[$i]['sell'], 2, '.', '');
                $currency->created_by = 1;
                $currency->updated_by = 1;
                $currency->save();
            }else{
                $currEx = CurrencyExchange::where('currency_id', $currency->id)->where('date', $date)->first();
                $currency->update([
                    'unit'=>$final_result[$i]['currency']['unit'],
                ]);
            }
            if (!$currEx) {
                $currencyExchnage = new CurrencyExchange();
                $currencyExchnage->create([
                    'currency_id' => $currency->id,
                    'buy' => number_format((float)$final_result[$i]['buy'], 2, '.', ''),
                    'sell' => number_format((float)$final_result[$i]['sell'], 2, '.', ''),
                    'date' => $date,
                ]);
            }
        }
    }
    public function getExchange($date)
    {
        $url = "https://www.nrb.org.np/api/forex/v1/rates?from=" . $date . "&to=" . $date . "&per_page=100&page=1";
        $response =  Http::get($url, [
            'from' => $date,
            'to' => $date,
            'per_page' => 100,
            'page' => 1,
        ]);
        $contents = json_decode($response->getBody()->getContents(),true);
        $final_result =  $contents['data']['payload'][0]['rates'];
        // dd($final_result);
        return $final_result;
    }
}
