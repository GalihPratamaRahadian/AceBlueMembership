<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const TYPE_PAKET_BASIC = 'basic';
    const TYPE_PAKET_PREMIUM = 'premium';
    const TYPE_PAKET_ULTIMATE = 'ultimate';

    public function promotion()
    {
        return $this->hasMany(Promotion::class, 'packet_id', 'id');
    }

    public function createPacket($dataPacket)
    {
        $packetName = $dataPacket['packet_name'];
        $type = $dataPacket['type'];
        $price = $dataPacket['price'];
        $description = $dataPacket['description'];
        $kwhTotal = $dataPacket['kwh_total'];
        $packet = self::create([
            'packet_name' => $packetName,
            'type'        => $type,
            'price'       => $price,
            'description' => $description,
            'kwh_total'   => $kwhTotal
        ]);

        return $packet;
    }

    public function updatePacket($dataPacket)
    {
        $packetName = $dataPacket['packet_name'];
        $type = $dataPacket['type'];
        $price = $dataPacket['price'];
        $description = $dataPacket['description'];
        $kwhTotal = $dataPacket['kwh_total'];

        $this->update([
            'packet_name' => $packetName,
            'type'        => $type,
            'price'       => $price,
            'description' => $description,
            'kwh_total'   => $kwhTotal
        ]);
    }

    public function deletePacket()
    {
        $this->delete();
    }

    public function typePacket()
    {
        return [
            [
                'type' => self::TYPE_PAKET_BASIC,
                'label' => 'basic'
            ],
            [
                'type' => self::TYPE_PAKET_PREMIUM,
                'label' => 'premium'
            ],
            [
                'type' => self::TYPE_PAKET_ULTIMATE,
                'label' => 'ultimate'
            ]
        ];
    }

    public function isTypeBasic()
    {
        return $this->type == self::TYPE_PAKET_BASIC;
    }

    public function isTypePremium()
    {
        return $this->type == self::TYPE_PAKET_PREMIUM;
    }

    public function isTypeUltimate()
    {
        return $this->type == self::TYPE_PAKET_ULTIMATE;
    }

    public static function dt()
    {
        $data = self::select('id', 'packet_name', 'type', 'price', 'description', 'kwh_total') // <-- Tambahkan ini
                    ->whereNotNull('created_at')
                    ->orderBy('updated_at', 'desc');

        return \Datatables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '<div class="btn-group">
                            <button type="button" class="btn btn-outline-primary btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                            <li>
                                <a class="dropdown-item edit text-primary" href="javascript:void(0);" data-edit-href="'.route('admin.packet.update', $data->id).'" data-get-href="'.route('admin.packet.get', $data->id).'"><i class="fa fa-pen mr-2"></i> Edit</a>

                                <a class="dropdown-item delete text-danger" href="javascript:void(0);" data-delete-message="Yakin ingin menghapus?" data-delete-href="' . route('admin.packet.destroy', $data->id) .'"><i class="fa fa-trash mr-2"></i> Hapus</a>
                            </li>
                            </div>
                        </div>';

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
