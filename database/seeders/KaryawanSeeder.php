<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('karyawan')->insert([
            'nama'=>'galih',
            'nomor_induk'=>'1000',
            'alamat'=>'Cirebon',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
