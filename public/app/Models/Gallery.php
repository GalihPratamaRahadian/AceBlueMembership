<?php

namespace App\Models;

use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function createGallery($dataGallery, $request = null)
    {
        $title = $dataGallery['title'];
        $description = $dataGallery['description'];

        $gallery = self::create([
            'title' => $title,
            'description' => $description,
        ]);

        if ($request && $request->hasFile('image')) {
            $gallery->saveFile($request); // ✅ GUNAKAN INSTANCE YANG BARU DIBUAT
        }

        return $gallery;
    }


    public function updateGallery($dataGallery)
    {
        $title = $dataGallery['title'];
        $description = $dataGallery['description'];
        $image = $dataGallery['image'];

        $this->update([
            'title' => $title,
            'description' => $description,
            'image' => $image,
        ]);

        return $this;
    }

    public function deleteGallery()
    {
        $this->delete();
    }

    public function imagePath()
    {
        return storage_path('app/public/gallery/' . $this->image);
    }

    public function imageLink()
    {
        return url('storage/gallery/' . $this->image);
    }

    public function imageLinkHtml()
    {
        if ($this->isImageHasPhoto()) {
            $href = '<a href="'.$this->imageLink().'" target="_blank"> Lihat Foto </a>';
			return $href;
        } else {
            return '<span class="text-danger"> Tidak Melampirkan Foto </span>';
        }
    }

    public function isImageHasPhoto()
    {
       if(empty($this->image)) return false;
		return \File::exists($this->imagePath());
    }

    public function imagePhotoViewImg(){
        if($this->isImageHasPhoto()) {
            return '<img src="'.$this->imageLink().'?'.rand(100000000,999999999).'" width="100px" class="img-fluid doctor-photo">';
        } else {
            return '<span class="text-danger"> Tidak Melampirkan Foto </span>';
        }
    }

    private static function checkTempDir($dir)
	{
		if(!\File::exists($dir)) \File::makeDirectory($dir);
	}


    public function removePhoto()
	{
		if($this->isImageHasPhoto()) {
			\File::delete($this->imagePath());
			$this->update([
				'image' => null
			]);
		}

		return $this;
	}

   public function saveFile($request)
    {
        $dir = storage_path('app/public/gallery/');
        self::checkTempDir($dir);

        if($request->hasFile('image')) {
            $this->removePhoto();

            $image = $request->file('image');
            $filename = $request->title.'-'.rand(100000000,999999999).'.'.$image->getClientOriginalExtension();

            $destinationPath = $dir.'/'.$filename;

            $manager = new ImageManager(new GdDriver()); // ✅ BENAR
            $img = $manager->read($image->getRealPath());

            $img->scale(width: 704); // resize lebar, tinggi auto

            $img->save($destinationPath);

            $this->update([
                'image' => $filename,
            ]);
        }

        return $this;
    }

    public static function dt()
    {
        $data = self::where('title', '!=', NULL)
               ->orderBy('created_at', 'desc');
        return \Datatables::eloquent($data)
            ->editColumn('action', function ($data) {
                $action = '<div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item mr-1 text-primary edit" href="javascript:void(0);" data-edit-href="' . route('admin.gallery.update', $data->id) . '" data-get-href="' . route('admin.gallery.get', $data->id) . '"><i class="fa-solid fas fa-eye"></i> detail</a>
                        </li>
                        <li>
                            <a class="dropdown-item mr-1 delete text-danger" href="javascript:void(0);" data-delete-message="Yakin ingin menghapus?" data-delete-href="' . route('admin.gallery.destroy', $data->id) . '"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                        </li>
                    </ul>
                    </div>';

                    return $action;
            })

            ->editColumn('image', function ($data) {
                return $data->imagePhotoViewImg();
            })

            ->rawColumns(['action', 'image'])
            ->make(true);

    }
}

