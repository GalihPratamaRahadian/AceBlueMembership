<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const TYPE_SETUJU = 'setuju';
    const TYPE_DITOLAK = 'ditolak';
    const TYPE_PENDING = 'pending';


    public function packet()
    {
        return $this->belongsTo(Packet::class, 'id_packet', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function getData()
    {
        return [
            'customer_name' =>
            [
                'key'   => 'Nama Pelanggan',
                'value' => $this->customer_name
            ],
            'address' =>
            [
                'key'   => 'Alamat',
                'value' => $this->address
            ],
            'phone_number' =>
            [
                'key'   => 'Nomor Telepon',
                'value' => $this->phone_number
            ],
            'take_packet' =>
            [
                'key'   => 'Paket',
                'value' => $this->take_packet
            ],
            'ktp' =>
            [
                'key'   => 'KTP',
                'value' => $this->ktpPhotoHtml()
            ],
            'payment_file' =>
            [
                'key'   => 'Bukti Pembayaran',
                'value' => $this->paymentPhotoHtml()
            ]
        ];
    }

    public static function createCustomer($request)
    {
        try {

            $packet = \App\Models\Packet::find($request->id_packet);

            $customer = self::create([
                'customer_name' => $request->customer_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'type' => self::TYPE_PENDING,
                'id_packet' => $packet->id ?? null,
                'take_packet' => $packet->type ?? null,
                'email' => $request->email,
                'username' => $request->username,
                'password_plain' => $request->password
            ]);

            // $customer->setUser($request->email, $request->customer_name, $request->username, $request->password);

            $customer->saveFileKtp($request->ktp);

            $customer->saveFilePayment($request->payment_file);

            return $customer;
        } catch (\Exception $e) {
            \Log::error('Gagal create customer: ' . $e->getMessage());
            throw $e;
        }
    }


    public function setUser($email = null, $name = null, $username = null, $password = null)
    {
        if (empty($this->user)) {
            // Validasi email
            if (User::where('username', $username)->where('email', '!=', $email)->exists()) {
                throw new Exception("Username tidak tersedia");
            }

            // Generate atau hash password
            $rawPassword = $password ?? rand(1000, 9999);
            $hashedPassword = Hash::make($rawPassword);

            // Buat akun user baru
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name'     => $name,
                    'username' => $username,
                    'password' => $hashedPassword,
                    'role'     => User::ROLE_CUSTOMER,
                ]
            );

            // Update customer dengan ID user
            $this->update([
                'id_user' => $user->id,
            ]);
        } else {
            // Jika user sudah ada, update jika perlu
            if (!empty($username)) {
                $user = User::where('username', $username)
                    ->where('id', '!=', $this->user->id)
                    ->first();

                if ($user) throw new \Exception('Username tidak tersedia', 1);
            }

            if (!empty($email)) {
                $user = User::where('email', $email)
                    ->where('id', '!=', $this->user->id)
                    ->first();

                if ($user) throw new \Exception('Email sudah terdaftar', 1);
            }

            $this->user->update([
                'username' => $username ?? $this->user->username,
                'email'    => $email ?? $this->user->email,
                'password' => $password ? Hash::make($password) : $this->user->password,
            ]);
        }

        return $this;
    }


    public function ktpPath()
    {
        return storage_path('app/public/customer/ktp/' . $this->ktp);
    }

    public function ktpLink()
    {
        return url('storage/customer/ktp/' . $this->ktp);
    }

    public function ktpPhotoHtml()
    {
        if ($this->isKtpHasPhoto()) {
            return '<img src="' . $this->ktpLink() . '?' . rand(100000000, 999999999) . '" width="100px" class="img-fluid">';
        } else {
            return '<img src="' . url('assets/img/default-avatar.jpg') . '" width="100px" class="img-fluid">';
        }
    }

    public function isKtpHasPhoto()
    {
        if (empty($this->ktp)) return false;
        return \File::exists($this->ktpPath());
    }

    public function ktpPhotoViewImg()
    {
        if ($this->isKtpHasPhoto()) {
            return '<img src="' . $this->ktpLink() . '?' . rand(100000000, 999999999) . '" width="100px" class="img-fluid doctor-photo">';
        } else {
            return '<span class="text-danger"> Tidak Melampirkan Foto </span>';
        }
    }

    private static function checkTempDir($dir)
    {
        if (!\File::exists($dir)) \File::makeDirectory($dir);
    }


    public function removeKtp()
    {
        if ($this->isKtpHasPhoto()) {
            \File::delete($this->ktpPath());
            $this->update([
                'ktp' => null
            ]);
        }

        return $this;
    }

    public function saveFileKtp($ktpFile)
    {
        $dir = storage_path('app/public/customer/ktp/');
        self::checkTempDir($dir);

        if ($ktpFile instanceof \Illuminate\Http\UploadedFile) {
            $this->removeKtp(); // hapus lama kalau ada

            $filename = 'ktp-' . time() . '-' . rand(1000, 9999) . '.' . $ktpFile->getClientOriginalExtension();
            $ktpFile->move($dir, $filename);

            $this->update([
                'ktp' => $filename, // hanya simpan nama file
            ]);
        }

        return $this;
    }


    public function paymentPhotoPath()
    {
        return storage_path('app/public/customer/payment_file/' . $this->payment_file);
    }

    public function paymentPhotoLink()
    {
        return url('storage/customer/payment_file/' . $this->payment_file);
    }

    public function paymentPhotoHtml()
    {
        if ($this->paymentIsHasPhoto()) {
            return '<img src="' . $this->paymentPhotoLink() . '?' . rand(100000000, 999999999) . '" width="100px" class="img-fluid">';
        } else {
            return '<img src="' . url('assets/img/default-avatar.jpg') . '" width="100px" class="img-fluid">';
        }
    }

    public function paymentIsHasPhoto()
    {
        if (empty($this->payment_file)) return false;
        return \File::exists($this->paymentPhotoPath());
    }

    public function imagePhotoPaymentViewImg()
    {
        if ($this->paymentIsHasPhoto()) {
            return '<img src="' . $this->paymentPhotoLink() . '?' . rand(100000000, 999999999) . '" width="100px" class="img-fluid doctor-photo">';
        } else {
            return '<span class="text-danger"> Tidak Melampirkan Foto </span>';
        }
    }


    public function removePhotoPayment()
    {
        if ($this->paymentIsHasPhoto()) {
            \File::delete($this->paymentPhotoPath());
            $this->update([
                'payment_file' => null
            ]);
        }

        return $this;
    }

    public function saveFilePayment($payment_file)
    {
        $dir = storage_path('app/public/customer/payment_file/');
        self::checkTempDir($dir);

        if ($payment_file instanceof \Illuminate\Http\UploadedFile) {
            $this->removePhotoPayment(); // hapus lama kalau ada

            $filename = 'payment_file-' . time() . '-' . rand(1000, 9999) . '.' . $payment_file->getClientOriginalExtension();
            $payment_file->move($dir, $filename);

            $this->update([
                'payment_file' => $filename, // hanya simpan nama file
            ]);
        }

        return $this;
    }


    public function typePacket()
    {
        return [
            [
                'type' => self::TYPE_SETUJU,
                'label' => 'setuju'
            ],
            [
                'type' => self::TYPE_DITOLAK,
                'label' => 'ditolak'
            ],
            [
                'type' => self::TYPE_PENDING,
                'label' => 'pending'
            ]
        ];
    }

    public function isTypeSetuju()
    {
        return $this->type == self::TYPE_SETUJU;
    }

    public function isTypeDitolak()
    {
        return $this->type == self::TYPE_DITOLAK;
    }

    public function isTypePending()
    {
        return $this->type == self::TYPE_PENDING;
    }

    public function typePacketLabel()
    {
        if ($this->isTypeSetuju()) {
            return '<span class="badge bg-success">' . $this->type . '</span>';
        } elseif ($this->isTypeDitolak()) {
            return '<span class="badge bg-danger">' . $this->type . '</span>';
        } elseif ($this->isTypePending()) {
            return '<span class="badge bg-warning">' . $this->type . '</span>';
        }
    }

    public static function dt()
    {
        $data = self::where('created_at', '!=', NULL);
        return \Datatables::eloquent($data)
            ->editColumn('action', function ($data) {
                if ($data->isTypeSetuju()) {
                    $action = '
    <div class="btn-group">
        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-ellipsis"></i>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item mr-1 text-primary detail"
                   href="javascript:void(0);"
                   data-get-href="' . route('admin.people.get', $data->id) . '">
                    <i class="fa-solid fas fa-eye"></i> Detail
                </a>
            </li>
            <li>
                <a class="dropdown-item mr-1 delete text-danger"
                   href="javascript:void(0);"
                   data-delete-message="Yakin ingin menghapus?"
                   data-delete-href="' . route('admin.people.destroy', $data->id) . '">
                    <i class="fa-solid fa-trash-can"></i> Hapus
                </a>
            </li>
        </ul>
    </div>';
                    return $action;
                } elseif ($data->isTypeDitolak()) {
                    $action = '
                    <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item mr-1 text-primary edit" href="javascript:void(0);" data-get-href="' . route('admin.people.get', $data->id) . '"><i class="fa-solid fas fa-eye"></i> detail</a>
                        </li>
                        <li>
                            <a class="dropdown-item mr-1 delete text-danger" href="javascript:void(0);" data-delete-message="Yakin ingin menghapus?" data-delete-href="' . route('admin.people.destroy', $data->id) . '"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                        </li>
                    </ul>
                    </div>';
                } elseif ($data->isTypePending()) {
                    $action = '<div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item mr-1 text-success approve" href="javascript:void(0)" data-href="' . route('admin.people.approve', $data->id) . '" title="Setuju Pengajuan Berlangganan">
                                <i class="fas fa-check"></i> Setuju
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item mr-1 text-danger reject" href="javascript:void(0)" data-href="' . route('admin.people.reject', $data->id) . '" title="Tolak Pengajuan Berlangganan">
                                <i class="fas fa-close"></i> Tolak
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item detail text-info" data-bs-toggle="modal" data-bs-target="#modalDetail" href="javascript:void(0);" data-get-href="' . route(auth()->user()->role . '.people.get', $data->id) . '"><i class="fas fa-eye"></i> Detail</a>
                        </li>
                    </ul>
                </div>';


                    return $action;
                }
            })

            ->editColumn('type', function ($data) {
                return $data->typePacketLabel();
            })

            ->rawColumns(['action', 'type'])
            ->make(true);
    }

    public function approveSubscriptionByAdmin()
    {
        $this->update(['type' => self::TYPE_SETUJU]);

        if (empty($this->user)) {
            $this->setUser(
                $this->email,
                $this->customer_name,
                $this->username,
                $this->password_plain
            );

            // demi keamanan
            $this->update(['password_plain' => null]);
        }

        return $this;
    }


    public function rejectSubscriptionByAdmin()
    {
        $this->update([
            'type' => self::TYPE_DITOLAK
        ]);

        return $this;
    }
}
