<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function createPayment($dataPayment)
    {
        $nameCustomer = $dataPayment['name_customer'];
        $packetName = $dataPayment['packet_name'];
        $totalKwh = $dataPayment['total_kwh'];
        $totalPrice = $dataPayment['total_price'];
        $status = $dataPayment['status'];

        $payment = Payment::create([
            'date_transaction'  => Carbon::now('Asia/Jakarta')->setTimezone('UTC'),
            'name_customer' => $nameCustomer,
            'packet_name' => $packetName,
            'total_kwh' => $totalKwh,
            'total_price' => $totalPrice,
            'status' => $status,
        ]);

        return $payment;
    }

    public static function dt()
    {
        $data = self::where('created_at', '!=', NULL)
            ->orderBy('updated_at', 'desc');
        return \Datatables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '<div class="btn-group">
                            <button type="button" class="btn btn-outline-primary btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item detail text-info" data-bs-toggle="modal" data-bs-target="#modalDetail" href="javascript:void(0);" data-get-href="' . route('admin.payment.get', $data->id) . '"><i class="fas fa-eye"></i> Detail</a>
                                </li>
                            </div>
                        </div>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
