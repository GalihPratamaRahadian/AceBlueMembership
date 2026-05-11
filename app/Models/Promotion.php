<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function createPromotion($dataPromotion)
    {
        $dataName = $dataPromotion['name'];
        $dataPriceTotal = $dataPromotion['price_total'];
        $dataDiscount = $dataPromotion['discount'];
        $dataPrice = $dataPromotion['price'];

        $dataPromotion = self::create([
            'name' => $dataName,
            'price_total' => $dataPriceTotal,
            'discount' => $dataDiscount,
            'price' => $dataPrice
        ]);

        return $dataPromotion;
    }

    public function updatePromotion($dataPromotion)
    {
        $dataName = $dataPromotion['name'];
        $dataPriceTotal = $dataPromotion['price_total'];
        $dataDiscount = $dataPromotion['discount'];
        $dataPrice = $dataPromotion['price'];

        $this->update([
            'name' => $dataName,
            'price_total' => $dataPriceTotal,
            'discount' => $dataDiscount,
            'price' => $dataPrice
        ]);

        return $this;
    }

    public function deletePromotion()
    {
        $this->delete();
    }

    public static function dt()
    {
        $data = self::where('created_at', '!=', NULL);
        return \Datatables::eloquent($data)
            ->addColumn('action', function ($data) {
                 $action = '<div class="btn-group">
                            <button type="button" class="btn btn-outline-primary btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                            <li>
                                <a class="dropdown-item edit text-primary" href="javascript:void(0);" data-edit-href="'.route('admin.promotion.update', $data->id).'" data-get-href="'.route('admin.promotion.get', $data->id).'"><i class="fa fa-pen mr-2"></i> Edit</a>

                                <a class="dropdown-item delete text-danger" href="javascript:void(0);" data-delete-message="Yakin ingin menghapus?" data-delete-href="' . route('admin.promotion.destroy', $data->id) .'"><i class="fa fa-trash mr-2"></i> Hapus</a>
                            </li>
                            </div>
                        </div>';

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
