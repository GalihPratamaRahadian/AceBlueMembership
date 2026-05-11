<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function giftIndex()
    {
        return view('admin.gift.index');
    }
}
