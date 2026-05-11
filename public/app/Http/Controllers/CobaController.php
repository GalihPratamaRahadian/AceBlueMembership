<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;

class CobaController extends Controller
{
    function index()
    {
        //$data = karyawan::all();
        $data = karyawan::orderBy('nomor_induk', 'asc')->get();
        return view ('karyawan/index')->with('data', $data);
    }
    function tentang()
    {
        return view("halaman/tentang");
    }
    function kontak()
    {
        $judul = 'Halaman coba Kontak';
        $data = [
            'judul'=> 'Halaman coba Kontak',
            'kontak'=>[
                'email' => 'admin123@gmail.com'
            ]
        ];
        return view ("halaman/kontak")->with($data);
    }
}
