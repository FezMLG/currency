<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function show() {
        $currencies = Currency::all();
        return view('welcome', compact('currencies'));
    }

    public function update() {

        $url = "https://api.nbp.pl/api/exchangerates/tables/A/?format=json";

        $response = Http::get($url);
        $response->json();
        $output = $response['0']['rates'];

        foreach ($output as $key) {  
            Currency::updateOrInsert(['currency_code' => $key["code"]],['name' => $key["currency"], 'currency_code' => $key["code"], 'exchange_rate' => $key["mid"]]);
        }
        return redirect('/');
                
    }

    public function clear() {
        Currency::query()->truncate();
        return redirect('/');
    }
}
