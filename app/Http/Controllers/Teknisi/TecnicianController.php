<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TecnicianController extends Controller
{
    public function index()
    {
        return view('tecnician.index');
    }
}
