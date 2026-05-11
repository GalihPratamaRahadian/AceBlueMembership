<?php

use App\Models\SolarLog;
use App\Models\SolarSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SolarApiController extends Controller
{
    protected $ip = '192.168.0.102';
    protected $port = 8899;
    protected $timeoutSeconds = 3;

     public function read(Request $request)
    {
        $siteId = $request->get('site_id', 1);
        $slave = (int) $request->query('slave', 1);
        $start = (int) $request->query('start', 0);
        $count = (int) $request->query('count', 6);

        // ===== Build Modbus Request =====
        $frameNoCrc = pack('C*',
            $slave, 0x03,
            ($start >> 8) & 0xFF, $start & 0xFF,
            ($count >> 8) & 0xFF, $count & 0xFF
        );
        $crc = $this->crc16Modbus($frameNoCrc);
        $frame = $frameNoCrc . pack('C*', $crc & 0xFF, ($crc >> 8) & 0xFF);

        // ===== TCP Connection =====
        $socket = @fsockopen($this->ip, $this->port, $errno, $errstr, $this->timeoutSeconds);
        if (!$socket) {
            return response()->json(['error' => "Cannot connect to inverter: $errstr"], 500);
        }

        fwrite($socket, $frame);
        stream_set_timeout($socket, $this->timeoutSeconds);
        $response = fread($socket, 256);
        fclose($socket);

        if (!$response) {
            return response()->json(['error' => 'Timeout reading Modbus response'], 504);
        }

        // ===== Parse Data =====
        $values = $this->parseHoldingRegisters($response);
        if (!$values) {
            return response()->json(['error' => 'Invalid response data'], 500);
        }

        // Simpan log
        $solarLog = SolarLog::create([
            'site_id'      => $siteId,
            'voltage_in'   => $values['voltage_in'],
            'current_in'   => $values['current_in'],
            'voltage_out'  => $values['voltage_out'],
            'current_out'  => $values['current_out'],
            'power_in'     => $values['voltage_in'] * $values['current_in'],
            'power_out'    => $values['voltage_out'] * $values['current_out'],
            'energy_today' => $values['energy_today'] ?? 0,
            'status'       => $values['status'],
            'logged_at'    => now(),
        ]);

        // Update status site
        $site = SolarSite::find($siteId);
        if ($site) {
            $site->update([
                'status' => $values['status'],
                'last_updated' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'parsed'  => $values,
            'log_id'  => $solarLog->id
        ]);
    }

    // === CRC Calculator ===
    private function crc16Modbus(string $data): int
    {
        $crc = 0xFFFF;
        for ($i = 0; $i < strlen($data); $i++) {
            $crc ^= ord($data[$i]);
            for ($j = 0; $j < 8; $j++) {
                $crc = ($crc & 1)
                    ? ($crc >> 1) ^ 0xA001
                    : $crc >> 1;
            }
        }
        return $crc;
    }

    // === Example parser ===
    private function parseHoldingRegisters(string $data): ?array
    {
        // Simulasi data (asli tergantung register inverter)
        return [
            'voltage_in'   => 230,
            'current_in'   => 5,
            'voltage_out'  => 220,
            'current_out'  => 4.8,
            'energy_today' => 12.5,
            'status'       => 'normal',
        ];
    }
}

