<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Karyawan;

class Manage_karyawan extends Controller
{
    public function index()
    {
        $data['karyawan'] = Karyawan::all();
        return view('manage_karyawan', $data);
    }

    public function create()
    {
        return view('form_karyawan');
    }

    public function store(Request $request)
    {
        if (Karyawan::create($request->all())) {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('success', 'Berhasil membuat karyawan');
        } else {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('failed', 'Gagal membuat karyawan');
        }
    }

    public function edit(Request $request)
    {
        $data['karyawan'] = Karyawan::where([
            'id_karyawan' => $request->segment(3)
        ])->first();
        return view('form_karyawan', $data);
    }

    public function update(Request $request)
    {
        $karyawan = Karyawan::where([
            'id_karyawan' => $request->segment(3)
        ])->first();
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->email = $request->email;
        if ($karyawan->save()) {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('success', 'Berhasil memperbarui karyawan');
        } else {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('failed', 'Gagal memperbarui karyawan');
        }
    }

    public function show(){

    }

    public function destroy(Request $request)
    {
        $karyawan = Karyawan::find($request->segment(3));
        if ($karyawan->delete()) {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('success', 'Berhasil menghapus karyawan');
        } else {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('failed', 'Gagal menghapus karyawan');
        }
    }
}
