<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CallCenterController extends Controller
{
    public function callCenterIndex()
    {
        return view('customer.call_center.index');
    }
}
