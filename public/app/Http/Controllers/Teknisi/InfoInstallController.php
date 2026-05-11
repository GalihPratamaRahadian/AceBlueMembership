<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoInstallController extends Controller
{
    public function infoInstallIndex() {
        return view('tecnician.info_install.index');
    }
}
