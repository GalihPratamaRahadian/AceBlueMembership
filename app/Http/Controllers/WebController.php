<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function mainIndex()
    {
        $title = "Halaman Utama";
        return view('mainHome', [
            'title' => $title,
        ]);
    }


    public function packetIndex()
    {
        $title = "Paket";
        return view('packet', [
            'title' => $title
        ]);
    }

    public function agreementIndex()
    {
        $title = "Syarat dan Ketentuan";
        return view('agreement', [
            'title' => $title
        ]);
    }

    public function profileIndex()
    {
        $title = "Tentang Kami";
        return view('profile', [
            'title' => $title
        ]);
    }
}
