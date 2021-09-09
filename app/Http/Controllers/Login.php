<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\models\Admin;
use App\models\Staf_hr;
use App\models\Karyawan;

class Login extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function login_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('failed', 'Lengkapi isian form');
            return redirect('login');
        }

        $karyawan = Karyawan::where([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $check = $this->checkUser($request, $karyawan, 'karyawan');
        if($check != null){
            return $check;
        }

        $staf_hr = Staf_hr::where([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $check = $this->checkUser($request, $staf_hr, 'staf-hr');
        if($check != null){
            return $check;
        }

        $admin = Admin::where([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $check = $this->checkUser($request, $admin, 'admin');
        if($check != null){
            return $check;
        }

        return redirect('/')->with('failed', 'Data User Tidak Ditemukan');;
    }

    private function checkUser($request, $user, $role)
    {
        if ($user->exists()) {
            $user = $user->first()->toArray();
            unset($user['password']);
            $user['role'] = $role;
            $user['nama'] = $user['nama_admin'] ?? $user['nama_staf_hr'] ?? $user['nama_karyawan'];
            Session(['user' => $user]);
            switch ($role) {
                case 'karyawan':
                    # code...
                    return redirect('/karyawan/home');
                    break;

                case 'staf-hr':
                    # code...
                    return redirect('/staf-hr/home');
                    break;

                case 'admin':
                    # code...
                    return redirect('/admin/home');
                    break;

                default:
                    # code...
                    return redirect('/')->with('failed', 'Data User Tidak Ditemukan');;
                    break;
            }
        } else {
            return null;
        }
    }

    public function logout_action()
    {
        Session::flush();
        return redirect('/login');
    }
}
