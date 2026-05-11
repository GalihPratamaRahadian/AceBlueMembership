<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\MyClass\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function accessRegisterIndex()
    {
        return view('auth.register', [
            'title' => 'Daftar Akun Pelanggan'
        ]);
    }

    public function saveRegister(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required',
            'ktp'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        DB::beginTransaction();

        try{
            $phoneNumber = $request->phone_number;
            $registerPhone = Customer::where('phone_number', $phoneNumber)->first();

            if($registerPhone){
                return \Res::invalid([
					'message'	=> 'Nomor '.$request->phone_number.' tidak dapat digunakan',
				]);
            }

            if(!$registerPhone){
                $user = User::where('username', $phoneNumber)->first();
                if($user){
                    return \Res::invalid([
                        'message'	=> 'Nomor '.$request->phone_number.' tidak dapat digunakan',
                    ]);
                }
            }

            if(!$registerPhone){
                $customer = Customer::where('phone_number', $phoneNumber)->first();
                if($customer){
                    return \Res::invalid([
                        'message'	=> 'Nomor '.$request->phone_number.' tidak dapat digunakan',
                    ]);
                }
            }

            Customer::createCustomer($request);
            DB::commit();
            return response()->json([
                'code'    => 200,
                'message' => 'Register Data Berhasil, Silahkan Tunggu Konfirmasi Admin Maksimal 1x24 Jam'
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
             return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
