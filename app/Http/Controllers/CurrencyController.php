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
            Currency::updateOrInsert(['code' => $key["code"]],['currency' => $key["currency"], 'code' => $key["code"], 'mid' => $key["mid"]]);
        }
        return redirect('/');
                
    }
}
