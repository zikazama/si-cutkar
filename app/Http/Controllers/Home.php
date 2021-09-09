<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\View_sisa_cuti;
use App\models\Pengajuan_cuti;
use App\models\Karyawan;
use App\models\Staf_hr;

class Home extends Controller
{
    public function index(Request $request){
        $role = Session('user')['role'];
        switch ($role) {
            case 'karyawan':
                # code...
                return $this->index_karyawan($request);
                break;
            case 'staf-hr':
                # code...
                return $this->index_staf_hr($request);
                break;
            case 'admin':
                # code...
                return $this->index_admin($request);
                break;
            
            default:
                # code...
                return redirect('/login');
                break;
        }
    }

    private function index_karyawan($request){
        $id_karyawan = Session('user')['id_karyawan'];
        $sisa_cuti = View_sisa_cuti::where([
            'id_karyawan' => $id_karyawan,
            'tahun' => date('Y')
        ])
        ->first();
        $pengajuan_cuti_verifikasi = pengajuan_cuti::where([
            'id_karyawan' => $id_karyawan,
            'status' => 'verifikasi'
        ])
        ->where('tanggal_pengajuan','like',date('Y')."%")
        ->count();
        $total_pengajuan_cuti = pengajuan_cuti::where([
            'id_karyawan' => $id_karyawan,
        ])
        ->where('tanggal_pengajuan','like',date('Y')."%")
        ->count();
        $data['cuti_terpakai'] = $sisa_cuti->cuti_terpakai;
        $data['sisa_cuti'] = $sisa_cuti->sisa_cuti;
        $data['pengajuan_cuti_verifikasi'] = $pengajuan_cuti_verifikasi;
        $data['total_pengajuan_cuti'] = $total_pengajuan_cuti;
        return view('home_karyawan',$data);
    }

    private function index_staf_hr($request){
        $jumlah_karyawan = Karyawan::count();
        $pengajuan_cuti_verifikasi = pengajuan_cuti::where([
            'status' => 'verifikasi'
        ])
        ->where('tanggal_pengajuan','like',date('Y')."%")
        ->count();
        $total_pengajuan_cuti = pengajuan_cuti::where('tanggal_pengajuan','like',date('Y')."%")->count();
        $data['jumlah_karyawan'] = $jumlah_karyawan;
        $data['pengajuan_cuti_verifikasi'] = $pengajuan_cuti_verifikasi;
        $data['total_pengajuan_cuti'] = $total_pengajuan_cuti;
        return view('home_staf_hr',$data);
    }

    private function index_admin($request){
        $jumlah_karyawan = Karyawan::count();
        $jumlah_staf_hr = Staf_hr::count();
        $pengajuan_cuti_verifikasi = pengajuan_cuti::where([
            'status' => 'verifikasi'
        ])
        ->where('tanggal_pengajuan','like',date('Y')."%")
        ->count();
        $total_pengajuan_cuti = pengajuan_cuti::
        where('tanggal_pengajuan','like',date('Y')."%")
        ->count();
        $data['jumlah_karyawan'] = $jumlah_karyawan;
        $data['jumlah_staf_hr'] = $jumlah_staf_hr;
        $data['pengajuan_cuti_verifikasi'] = $pengajuan_cuti_verifikasi;
        $data['total_pengajuan_cuti'] = $total_pengajuan_cuti;
        return view('home_admin',$data);
    }
}
