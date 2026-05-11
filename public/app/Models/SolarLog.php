<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarLog extends Model
{
    use HasFactory;

    protected $table = 'solar_logs';

    protected $guarded = ['id'];

    public function site()
    {
        return $this->belongsTo(SolarSite::class, 'site_id');
    }

    public static function createSolarLog($dataLog)
    {
        $powerIn = $dataLog['power_in'];
        $powerOut = $dataLog['power_out'];
        $currentIn = $dataLog['current_in'];
        $currentOut = $dataLog['current_out'];
        $voltageIn = $dataLog['voltage_in'];
        $voltageOut = $dataLog['voltage_out'];
        $energyToday = $dataLog['energy_today'];
        $status = $dataLog['status'];

        $powerIn ??= $voltageIn * $currentIn;
        $powerOut ??= $voltageOut * $currentOut;

        $solarLog = self::create([
            'voltage_in'   => $voltageIn,
            'current_in'   => $currentIn,
            'voltage_out'  => $voltageOut,
            'current_out'  => $currentOut,
            'power_in'     => $powerIn,
            'power_out'    => $powerOut,
            'energy_today' => $energyToday,
            'status'       => $status,
            'logged_at'    => now(),
        ]);

        return $solarLog;
    }

    // ===== Custom UPDATE method =====
    public function updateSolarLog(array $data)
    {
        $this->update([
            'voltage_in'   => $data['voltage_in'],
            'current_in'   => $data['current_in'],
            'voltage_out'  => $data['voltage_out'],
            'current_out'  => $data['current_out'],
            'power_in'     => $data['power_in'],
            'power_out'    => $data['power_out'],
            'energy_today' => $data['energy_today'],
            'status'       => $data['status'],
            'logged_at'    => $data['logged_at'],
        ]);

        return $this;
    }

    // ===== DELETE method =====
    public function deleteSolarLog()
    {
        $this->delete();
    }

    // ===== DataTables method =====
    public static function dt()
    {
        $data = self::select(['solar_logs.*'])
            ->orderBy('logged_at', 'desc');

        return \Datatables::eloquent($data)
            ->addColumn('action', function ($data) {
                return '
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-round dropdown-toggle" data-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                            <li>
                                <a class="dropdown-item delete text-danger" href="javascript:void(0);" data-delete-message="Yakin ingin menghapus?" data-delete-href="' . route('admin.solar_log.destroy', $data->id) .'"><i class="fa fa-trash mr-2"></i> Hapus</a>
                            </li>
                        </div>
                    </div>';
            })
            ->editColumn('status', function ($data) {
                return match ($data->status) {
                    'normal' => '<span class="badge bg-success">Normal</span>',
                    'overvoltage' => '<span class="badge bg-danger text-white">Overvoltage</span>',
                    'undervoltage' => '<span class="badge bg-warning">Undervoltage</span>',
                    default => '<span class="badge bg-secondary">' . e($data->status) . '</span>',
                };
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
}
