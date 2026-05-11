<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\MyClass\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function promotionIndex(Request $request)
    {
        if ($request->ajax()) {
            return Promotion::dt();
        }

        return view('admin.promotion.index');
    }

    public function promotionStore(Request $request, Promotion $promotion)
    {
        DB::beginTransaction();

        try{
            $dataPromotion = [
                'name'  => $request->name,
                'price_total' => $request->price_total,
                'discount' => $request->discount,
                'price'    => $request->price,
            ];

            $promotion->createPromotion($dataPromotion);

            DB::commit();
            return \Res::save();
        }catch(\Exception $e){
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function promotionUpdate(Request $request, Promotion $promotion)
    {
        DB::beginTransaction();

        try{
            $dataPromotion = [
                'name'  => $request->name,
                'price_total' => $request->price_total,
                'discount' => $request->discount,
                'price'    => $request->price,
            ];

            $promotion->updatePromotion($dataPromotion);
            DB::commit();
            return \Res::save();
        }catch(\Exception $e){
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function promotionDestroy(Promotion $promotion)
    {
        DB::beginTransaction();

        try{
            $promotion->deletePromotion();
            DB::commit();
            return \Res::save();
        }catch(\Exception $e){
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function promotionGet(Promotion $promotion)
    {
        try{
            return Response::success([
                'promotion' => $promotion
            ]);
        }catch(\Exception $e){
            return Response::error($e->getMessage());
        }
    }
}
