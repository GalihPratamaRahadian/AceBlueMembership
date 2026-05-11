<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function paymentIndex(Request $request)
    {
        if ($request->ajax()) {
            return Payment::dt();
        }
        return view('admin.payment.index');
    }

    public function paymentStore(Request $request, Payment $payment)
    {
        DB::beginTransaction();


    }
}
