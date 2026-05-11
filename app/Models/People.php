<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'photo',
        'notes',
    ];

    public static function createPeople(array $request)
    {
        $people = self::create($request);

        return $people;
    }
    public function updatePeople(array $request)
    {
        $this->update($request);

        return $this;
    }

    public function deletePeople()
    {
        return $this->delete();
    }

    public function imageHtml()
    {
        return "<img src='".$this->peoplePhotoFileLink()."'height='250' width='240'>";
    }

    public static function dt()
    {
        $data = self::where('created_at', '!=', NULL);
        return \Datatables::eloquent($data)
            ->editColumn('action', function ($data) {

                $action = '
                    <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item mr-1 text-primary edit" href="javascript:void(0);" data-edit-href="' . route('admin.people.update', $data->id) . '" data-get-href="' . route('admin.people.get', $data->id) . '"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        </li>
                        <li>
                            <a class="dropdown-item mr-1 delete text-danger" href="javascript:void(0);" data-delete-message="Yakin ingin menghapus?" data-delete-href="' . route('admin.people.destroy', $data->id) . '"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                        </li>
                    </ul>
                    </div>
                ';

                return $action;
            })
            ->editColumn('photo', function ($data){
                return $data->imageHtml();
            })

            ->rawColumns(['action', 'photo'])
            ->make(true);

    }

    //upload foto people
    public function peopleFilePath()
	{
		return storage_path('app/public/photo/'.$this->photo);
	}

    public function peoplePhotoFileLink()
	{
		return url('storage/photo/'.$this->photo);
	}

	public function peopleFileLinkHtml()
	{
		if($this->isHasPeoplePhoto()) {
			$href = '<a href="'.$this->peoplePhotoFileLink().'" target="_blank"> Lihat Photo people </a>';
			return $href;
		} else {
			return '<span class="text-danger"> Tidak Melampirkan Photo </span>';
		}
	}

	public function isHasPeoplePhoto()
	{
		if(empty($this->photo)) return false;
		return \File::exists($this->peopleFilePath());
	}

	public function removePeoplePhoto()
	{
		if($this->isHaspeoplePhoto()) {
			\File::delete($this->peopleFilePath());
			$this->update([
				'photo' => null
			]);
		}

		return $this;
	}

	public function saveFile($request)
	{
		if($request->hasFile('photo')) {
			$this->removePeoplePhoto();
			$file = $request->file('photo');
			$filename = date('YmdHis_').$file->getClientOriginalName();
			$file->move(storage_path('app/public/photo'), $filename);
		}

		return $filename;
	}
    
}
