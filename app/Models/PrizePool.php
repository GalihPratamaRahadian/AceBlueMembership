<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Yajra\DataTables\DataTables;

class PrizePool extends Model
{
    use HasFactory;

    protected $table = 'prize_pools';
    protected $guarded = [];

    public function createPrizePool($dataPrizePool, $request = null)
    {
        $name = $dataPrizePool['name'];
        $description = $dataPrizePool['description'];

        $prizePool = self::create([
            'name' => $name,
            'description' => $description
        ]);

        if ($request && $request->hasFile('picture')) {
            $prizePool->savePicture($request);
        }

        return $prizePool;
    }

    public function updatePrizePool($dataPrizePool)
    {
        $name = $dataPrizePool['name'];
        $picture = $dataPrizePool['picture'];
        $description = $dataPrizePool['description'];

        $this->update([
            'name' => $name,
            'picture' => $picture,
            'description' => $description
        ]);

        return $this;
    }

    public function deletePrizePool()
    {
        $this->delete();
    }

    public function picturePath()
    {
        return storage_path('app/public/prize_pool/' . $this->picture);
    }

    public function pictureLink()
    {
        return url('storage/prize_pool/' . $this->picture);
    }

    public function pictureHtml()
    {
        if ($this->isHasPicture()) {
            return '<img src="' . $this->pictureLink() . '?' . rand(100000000, 999999999) . '" width="100px" class="img-fluid">';
        } else {
            return '<img src="' . url('assets/img/default-avatar.jpg') . '" width="100px" class="img-fluid">';
        }
    }

    public function pictureHtmlViewImg()
    {
        if ($this->isHasPicture()) {
            return '<img src="' . $this->pictureLink() . '?' . rand(100000000, 999999999) . '" width="100px" class="img-fluid doctor-photo">';
        } else {
            return '<span class="text-danger"> Tidak Melampirkan Foto </span>';
        }
    }

    public function isHasPicture()
    {
        if (empty($this->picture)) return false;
        return \File::exists($this->picturePath());
    }

    public function deletePicture()
    {
        if ($this->isHasPicture()){
            \File::delete($this->picturePath());
            $this->update([
                'picture' => null
            ]);
        }
    }

    public function checkTempDir($dir)
    {
        if (!\File::exists($dir)) \File::makeDirectory($dir);
    }

    public function savePicture($request)
    {
        $dir = storage_path('app/public/prize_pool/');
        self::checkTempDir($dir);

        if ($request->hasFile('picture')) {
            $this->deletepicture();

            $picture = $request->file('picture');
            $filename = $request->name . '-' . rand(100000000, 999999999) . '.' . $picture->getClientOriginalExtension();

            $destinationPath = $dir . '/' . $filename;

            $manager = new ImageManager(new GdDriver()); // ✅ BENAR
            $img = $manager->read($picture->getRealPath());

            $img->scale(width: 704); // resize lebar, tinggi auto

            $img->save($destinationPath);

            $this->update([
                'picture' => $filename,
            ]);
        }

        return $this;
    }

    public static function dt()
    {
        $data = self::where('created_at', '!=', NULL);

        return \Datatables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item mr-1 text-primary detail"
                               href="javascript:void(0);"
                               data-get-href="' . route('admin.prize_pool.get', $data->id) . '">
                                <i class="fa-solid fas fa-eye"></i> Detail
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item mr-1 delete text-danger"
                               href="javascript:void(0);"
                               data-delete-message="Yakin ingin menghapus?"
                               data-delete-href="' . route('admin.prize_pool.destroy', $data->id) . '">
                                <i class="fa-solid fa-trash-can"></i> Hapus
                            </a>
                        </li>
                    </ul>
                </div>';
                return $action;
        })
        ->editColumn('picture', function ($data) {
            return $data->pictureHtmlViewImg();
        })
        ->rawColumns(['action', 'picture'])
        ->make(true);
    }
}
