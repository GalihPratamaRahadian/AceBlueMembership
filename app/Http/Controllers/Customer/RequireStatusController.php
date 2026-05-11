<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\SolarTask;
use Illuminate\Http\Request;

class RequireStatusController extends Controller
{
    public function requireStatusIndex(Request $request)
    {
        if ($request->ajax()) {
            return SolarTask::dtCustomer();
        }
        return view('customer.require_status.index');
    }
}
