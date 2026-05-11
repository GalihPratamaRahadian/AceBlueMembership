<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\People;
use App\Models\Customer;
use App\Myclass\Response;
use App\Myclass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccessControlDevice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\SolarTask;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // $totalAllUsers = User::count();
        $totalCustomer = User::where('role', 'customer')->count();
        // $totalCustomerTidakSetuju = Customer::where('type', 'ditolak')->count();
        // $totalCustomerPending = Customer::where('type', 'pending')->count();
        // $totalAdmin   = User::where('role', 'admin')->count();
        // $totalTeknisi = User::where('role', 'teknisi')->count();
        // $totalTeknisiBertugas = SolarTask::where('status', 'in_progress')->count();
        // return view('admin.index', [
        //     'title' => 'Dashboard'
        //     ],
        //     compact('totalAllUsers', 'totalCustomerSetuju', 'totalCustomerTidakSetuju','totalCustomerPending', 'totalAdmin', 'totalTeknisi', 'totalTeknisiBertugas'));

        if ($request->ajax()) {
            return User::dt();
        }
        return view('admin.index', ['title' => 'Dashboard'], compact('totalCustomer'));
    }

    public function userIndex(Request $request)
    {
        if ($request->ajax()) {
            return User::dt();
        }
        return view('admin.user.index', ['title' => 'user']);
    }

    public function userStore(Request $request, User $user)
    {

        Validations::userValidation($request);
        DB::beginTransaction();

        try {
            $user->createUser([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            DB::commit();
            return \Res::save();
        } catch (\Exception $e) {
            DB::rollBack();

            return \Res::error($e);
        }
    }

    public function userUpdate(Request $request, User $user)
    {
        Validations::userEditValidation($request, $user->id);
        DB::beginTransaction();

        try {
            $user->updateUser($request->except(['password', 'confirm_password']));

            if (!empty($request->password)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            DB::commit();

            return \Res::update();
        } catch (\Exception $e) {

            DB::rollBack();
            return \Res::error($e);
        }
    }

    public function userDestroy(User $user)
    {

        DB::beginTransaction();

        try {
            $user->deleteUser();
            DB::commit();

            return \Res::delete();
        } catch (Exception $e) {
            DB::rollBack();

            return \Res::error($e);
        }
    }

    public function userGet(User $user)
    {

        try {
            return Response::success([
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return Response::error($e);
        }
    }

    public function AccessControldeviceIndex(Request $request)
    {
        if ($request->ajax()) {
            return AccessControlDevice::dt();
        }
        return view('admin.access_control.index', ['title' => 'access-control-device']);
    }

    public function AccessControlDeviceStore(Request $request, AccessControlDevice $AccessControlDevice)
    {

        Validations::AccessControlDeviceValidation($request);
        DB::beginTransaction();

        try {
            $AccessControlDevice->createAccessControlDevice([
                'device_name' => $request->device_name,
                'ip_address' => $request->ip_address,
                'port' => $request->port,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'notes' => $request->notes,
            ]);

            DB::commit();
            return \Res::save();
        } catch (\Exception $e) {
            DB::rollBack();

            return \Res::error($e);
        }
    }

    public function AccessControlDeviceUpdate(Request $request, AccessControlDevice $AccessControlDevice)
    {
        Validations::AccessControlDeviceEditValidation($request, $AccessControlDevice->id);
        DB::beginTransaction();

        try {
            $AccessControlDevice->updateAccessControlDevice($request->all());

            DB::commit();

            return \Res::update();
        } catch (\Exception $e) {
            DB::rollBack();

            return \Res::error($e);
        }
    }

    public function AccessControlDeviceDestroy(AccessControlDevice $AccessControlDevice)
    {

        DB::beginTransaction();

        try {

            $AccessControlDevice->deleteAccessControlDevice();

            DB::commit();

            return \Res::delete();
        } catch (\Exception $e) {
            DB::rollBack();

            return \Res::error($e);
        }
    }

    public function AccessControlDeviceGet(AccessControlDevice $AccessControlDevice)
    {
        try {
            return Response::success([
                'AccessControlDevice' => $AccessControlDevice
            ]);
        } catch (\Exception $e) {
            return Response::error($e);
        }
    }

    public function peopleIndex(Request $request)
    {

        if ($request->ajax()) {
            return Customer::dt();
        }
        return view('admin.people.index', ['title' => 'Pelanggan']);
    }

    // public function peopleStore(Request $request, People $people)
    // {
    //     Validations::peopleValidation($request);
    //     DB::beginTransaction();

    //     try {
    //         $peopleImage    = $request->photo;
    //         $filename = null;
    //         if (!empty($peopleImage)) {
    //             $people->removePeoplePhoto();
    //             $filename = $people->saveFile($request);
    //         }
    //         $people->createPeople([
    //             'name' => $request->name,
    //             'notes' => $request->notes,
    //             'photo' => $filename,
    //         ]);

    //         DB::commit();
    //         return \Res::save();
    //     } catch (\Exception $e) {
    //         DB::rollBack();


    //         return \Res::error($e);
    //     }
    // }

    // public function peopleUpdate(Request $request, People $people)
    // {
    //     Validations::peopleEditValidation($request, $people->id);
    //     DB::beginTransaction();

    //     try {
    //         $people->updatePeople($request->all());

    //         DB::commit();

    //         return\Res::update();;
    //     } catch (Exception $e) {
    //         DB::rollBack();

    //         return \Res::error($e);
    //     }
    // }


    // public function peopleDestroy(People $people)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $people->deletePeople();
    //         DB::commit();

    //         return \Res::delete();
    //     } catch (Exception $e) {
    //         DB::rollBack();

    //         return \Res::error($e);
    //     }
    // }

    public function peopleGet(Customer $customer)
    {
        try {
            return Response::success([
                'customer' => $customer->getData()
            ]);
        } catch (Exception $e) {
            return Response::error($e);
        }
    }

    public function approve(Request $request, Customer $customer)
    {
        try {
            DB::beginTransaction();

            // Setujui langganan
            $customer->approveSubscriptionByAdmin($request);

            // ✅ Cek apakah user sudah dibuat dari proses register
            if (!$customer->user) {
                $customer->setUser(
                    $customer->email, // gunakan data yang sudah tersimpan
                    $customer->customer_name,
                    $customer->username,
                    $customer->password // pastikan ini sudah hashed saat register
                );
            }

            DB::commit();

            return \Res::success([
                'message' => 'Pelanggan berhasil disetujui'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return \Res::error($e);
        }
    }



    public function reject(Request $request, Customer $customer)
    {
        try {
            DB::beginTransaction();
            $customer->rejectSubscriptionByAdmin($request);
            DB::commit();
            return \Res::success([
                'message' => 'success'
            ]);
        }catch (Exception $e) {
            DB::rollBack();
            return \Res::error($e);
        }
    }
}
