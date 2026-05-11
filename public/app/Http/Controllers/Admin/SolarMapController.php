<?php

namespace App\Http\Controllers\Admin;

use App\Models\SolarSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SolarMapController extends Controller
{
     public function index()
    {
        $sites = SolarSite::all();
        return view('admin.solar.map', compact('sites'));
    }

    public function json()
    {
        return response()->json(SolarSite::all());
    }
}
