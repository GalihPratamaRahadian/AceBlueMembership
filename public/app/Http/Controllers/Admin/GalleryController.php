<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function galleryIndex(Request $request)
    {
        if($request->ajax()){
            return Gallery::dt();
        }

        return view('admin.gallery.index',[
            'title' => 'Galeri'
        ]);
    }

    public function galleryStore(Request $request)
    {
        Validations::galleryValidation($request);
        DB::beginTransaction();

        try {
            $dataGallery = [
                'title' => $request->title,
                'image' => $request->image,
                'description' => $request->description,
            ];

            Gallery::createGallery($dataGallery, $request); // FIX: static dan kirim request

            DB::commit();
            return Response::success([
                'success' => 'Data berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }


    public function galleryUpdate(Request $request, Gallery $gallery)
    {
        Validations::galleryEditValidation($request);
        DB::beginTransaction();

        try{
            $dataGallery = [
                'title' => $request->title,
                'image' => $request->image,
                'description' => $request->description,
            ];

            $gallery->updateGallery($dataGallery);

            DB::commit();
            return \Res::success([
                'message' => 'Data berhasil diubah'
            ]);
        }catch(\Exception $e){
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function galleryDestroy(Gallery $gallery)
    {
        DB::beginTransaction();

        try{
            $gallery->deleteGallery();
            DB::commit();
            return Response::success([
                'success' => 'Data berhasil dihapus'
            ]);
        }catch(\Exception $e){
            DB::rollBack();
            return \Res::error($e->getMessage());
        }
    }

    public function galleryGet(Gallery $gallery)
    {
        try{
            return Response::success([
                'gallery' => $gallery
            ]);
        }catch(\Exception $e){
            return Response::error($e->getMessage());
        }
    }
}
