<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use App\MyClass\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacketController extends Controller
{
    public function packetIndex(Request $request)
    {
        if ($request->ajax()) {
            return Packet::dt();
        }

        return view('admin.packet.index',[
            'title' => 'Paket',
        ]);
    }

    public function packetStore(Request $request, Packet $packet)
    {
        DB::beginTransaction();

        try{
            $dataPacket = [
                'packet_name'   => $request->packet_name,
                'type'          => $request->type,
                'price'         => $request->price,
                'description'   => $request->description,
                'kwh_total'     => $request->kwh_total
            ];

            $packet->createPacket($dataPacket);

            DB::commit();
            return \Res::save();
        }catch(\Exception $e){
            DB::rollBack();
            return \Res::error($e);
        }
    }

    public function packetUpdate(Request $request, Packet $packet)
    {
        DB::beginTransaction();

        try{
            $dataPacket = [
                'packet_name'   => $request->packet_name,
                'type'          => $request->type,
                'price'         => $request->price,
                'description'   => $request->description,
                'kwh_total'     => $request->kwh_total
            ];

            $packet->updatePacket($dataPacket);

            DB::commit();
            return \Res::save();
        }catch(\Exception $e){
            DB::rollBack();
            return \Res::error($e);
        }
    }

    public function packetDestroy(Packet $packet)
    {
        DB::beginTransaction();
        try{
            $packet->deletePacket();
            DB::commit();
            return \Res::save();
        }catch(\Exception $e){
            DB::rollBack();
            return \Res::error($e);
        }
    }

    public function getPacket(Packet $packet)
    {
        try{
            return Response::success([
                'packet' => $packet
            ]);
        }catch(\Exception $e){
            return \Res::error($e);
        }
    }
}
