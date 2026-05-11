<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SolarLog;
use App\MyClass\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SolarLogController extends Controller
{
    public function solarLogIndex(Request $request)
    {
        if ($request->ajax()) {
            return SolarLog::dt();
        }

        return view('admin.solar_log.index'); // ganti view sesuai struktur kamu
    }

    public function solarLogStore(Request $request, SolarLog $solarLog)
    {
        DB::beginTransaction();

        try {
            $dataLog = [
                'voltage_in'   => $request->voltage_in,
                'current_in'   => $request->current_in,
                'voltage_out'  => $request->voltage_out,
                'current_out'  => $request->current_out,
                'power_in'     => $request->power_in,
                'power_out'    => $request->power_out,
                'energy_today' => $request->energy_today,
                'status'       => $request->status,
            ];

            SolarLog::createSolarLog($dataLog);

            DB::commit();
            return \Res::save();
        } catch (\Exception $e) {
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function solarLogUpdate(Request $request, SolarLog $solarLog)
    {
        DB::beginTransaction();

        try {
            $dataLog = [
                'voltage_in'   => $request->voltage_in,
                'current_in'   => $request->current_in,
                'voltage_out'  => $request->voltage_out,
                'current_out'  => $request->current_out,
                'power_in'     => $request->power_in,
                'power_out'    => $request->power_out,
                'energy_today' => $request->energy_today,
                'status'       => $request->status,
                'logged_at'    => $request->logged_at,
            ];

            $solarLog->updateSolarLog($dataLog);

            DB::commit();
            return \Res::save();
        } catch (\Exception $e) {
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function solarLogDestroy(SolarLog $solarLog)
    {
        DB::beginTransaction();

        try {
            $solarLog->deleteSolarLog();
            DB::commit();
            return \Res::save();
        } catch (\Exception $e) {
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function solarLogGet(SolarLog $solarLog)
    {
        try {
            return Response::success([
                'solar_log' => $solarLog
            ]);
        } catch (\Exception $e) {
            return Response::error($e->getMessage());
        }
    }


    // Endpoint data untuk DataTables
    // public function getData()
    // {
    //     // Ambil data dari API SRNE (contoh, ganti dengan request asli)
    //     $response = Http::get('https://api.srne.com/device/data', [
    //         'token' => config('services.srne.token'),
    //         'device_id' => config('services.srne.device_id')
    //     ]);

    //     if ($response->failed()) {
    //         return response()->json(['error' => 'Gagal mengambil data dari SRNE'], 500);
    //     }

    //     $data = $response->json();

    //     // Simpan ke database (opsional)
    //     $solarLog = SolarLog::create([
    //         'voltage_in'  => $data['voltage_in'] ?? null,
    //         'voltage_out' => $data['voltage_out'] ?? null,
    //         'current_in'  => $data['current_in'] ?? null,
    //         'current_out' => $data['current_out'] ?? null,
    //         'power_in'    => $data['power_in'] ?? null,
    //         'power_out'   => $data['power_out'] ?? null,
    //         'energy_today'=> $data['energy_today'] ?? null,
    //         'logged_at'   => now(),
    //     ]);

    //     // Tentukan status online/offline
    //     $status = 'Offline';
    //     if ($solarLog->logged_at && now()->diffInMinutes($solarLog->logged_at) <= 5) {
    //         $status = 'Online';
    //     }

    //     return response()->json([
    //         'voltage_in'  => $solarLog->voltage_in,
    //         'voltage_out' => $solarLog->voltage_out,
    //         'current_in'  => $solarLog->current_in,
    //         'current_out' => $solarLog->current_out,
    //         'power_in'    => $solarLog->power_in,
    //         'power_out'   => $solarLog->power_out,
    //         'energy_today'=> $solarLog->energy_today,
    //         'logged_at'   => $solarLog->logged_at->format('Y-m-d H:i:s'),
    //         'status'      => $status
    //     ]);
    // }

}
