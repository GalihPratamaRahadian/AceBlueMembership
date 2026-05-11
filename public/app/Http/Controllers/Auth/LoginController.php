<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function login(request $request)
     {

        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('username' =>$input['username'], 'password' =>$input['password']))){
            if (auth()->user()->role == User::ROLE_ADMIN){
                return redirect()->route('admin')->with('success', 'Login Berhasil');
            }
            if (auth()->user()->role == User::ROLE_CUSTOMER){
                return redirect()->route('customer')->with('success', 'Login Berhasil');
            }
            if (auth()->user()->role == User::ROLE_TECHNICIAN){
                return redirect()->route('teknisi')->with('success', 'Login Berhasil');
            }
        }else{
            return redirect()->back()->with('error', 'Username atau Password salah');
        }
     }

     public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

}
