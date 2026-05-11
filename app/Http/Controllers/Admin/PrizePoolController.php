<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrizePool;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrizePoolController extends Controller
{
    public function prizePoolIndex(Request $request)
    {
        if ($request->ajax()) {
            return PrizePool::dt();
        }
        return view('admin.prize_pool.index', [
                    'title' => 'Prize Pool'
                    ]);
    }

    public function prizePoolStore(Request $request, PrizePool $prizePool)
    {
        Validations::prizePoolValidation($request);
        DB::beginTransaction();
        try {
            $dataPrizePool = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            // dd($dataPrizePool);
            $prizePool->createPrizePool($dataPrizePool, $request);
            DB::commit();
            return Response::success();
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::error($e->getMessage());
        }
    }

    public function prizePoolUpdate(Request $request, PrizePool $prizePool)
    {
        Validations::prizePoolEditValidation($request);
        DB::beginTransaction();
        try {
            $dataPrizePool = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $prizePool->updatePrizePool($dataPrizePool);
            DB::commit();
            return Response::success();
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::error($e->getMessage());
        }
    }

    public function prizePoolDestroy(PrizePool $prizePool)
    {
        DB::beginTransaction();
        try {
            $prizePool->deletePrizePool();
            DB::commit();
            return Response::success();
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::error($e->getMessage());
        }
    }

    public function prizePoolGet(PrizePool $prizePool)
    {
        try{
            return Response::success([
                'prize_pool' => $prizePool
            ]);
        } catch (\Exception $e) {
            return Response::error($e->getMessage());
        }
    }

}
