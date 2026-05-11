<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function userIndex()
    {
        return view('customer.index', ['title' => 'Dashboard']);
    }

    public function agreementIndex()
    {
        return view('customer.agreement.index', ['title' => 'Agreement']);
    }
}
