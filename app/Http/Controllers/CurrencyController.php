<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function show() {
        $currencies = Currency::all();
        return view('welcome', compact('currencies'));
        
    }
}
