<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessControlDevice extends Model
{
    use HasFactory;

    protected $fillable =[
        'device_name',
        'ip_address',
        'port',
        'username',
        'password',
        'notes',
    ];

    public static function createAccessControlDevice(array $request)
    {
        $AccessControlDevice = self::create($request);

        return $AccessControlDevice;
    }
    public function updateAccessControlDevice(array $request)
    {
        $this->update($request);

        return $this;
    }

    public function deleteAccessControlDevice()
    {
        return $this->delete();
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
                            <a class="dropdown-item mr-1 text-primary edit" href="javascript:void(0);" data-edit-href="' . route('admin.access-control-device.update', $data->id) . '" data-get-href="' . route('admin.access-control-device.get', $data->id) . '"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        </li>
                        <li>
                            <a class="dropdown-item mr-1 delete text-danger" href="javascript:void(0);" data-delete-message="Yakin ingin menghapus?" data-delete-href="' . route('admin.access-control-device.destroy', $data->id) . '"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                        </li>
                    </ul>
                    </div>
                ';

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);

    }
    
}
