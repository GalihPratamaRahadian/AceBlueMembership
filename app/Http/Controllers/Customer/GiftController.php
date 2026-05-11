<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function giftIndex(){
        return view('customer.gift.index');
    }
}
