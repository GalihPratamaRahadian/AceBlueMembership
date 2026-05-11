<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function uninstallIndex()
    {
        return view('tecnician.info_uninstall.index');
    }
}
