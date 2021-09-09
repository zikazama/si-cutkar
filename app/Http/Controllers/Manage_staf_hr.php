<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Staf_hr;

class Manage_staf_hr extends Controller
{
    public function index()
    {
        $data['staf_hr'] = Staf_hr::all();
        return view('manage_staf_hr', $data);
    }

    public function create()
    {
        return view('form_staf_hr');
    }

    public function store(Request $request)
    {
        if (Staf_hr::create($request->all())) {
            return redirect(Session('user')['role'].'/manage-staf-hr')->with('success', 'Berhasil membuat staf HR');
        } else {
            return redirect(Session('user')['role'].'/manage-staf-hr')->with('failed', 'Gagal membuat staf HR');
        }
    }

    public function edit(Request $request)
    {
        $data['staf_hr'] = Staf_hr::where([
            'id_staf_hr' => $request->segment(3)
        ])->first();
        return view('form_staf_hr', $data);
    }

    public function update(Request $request)
    {
        $staf_hr = Staf_hr::where([
            'id_staf_hr' => $request->segment(3)
        ])->first();
        $staf_hr->nama_staf_hr = $request->nama_staf_hr;
        $staf_hr->email = $request->email;
        if ($staf_hr->save()) {
            return redirect(Session('user')['role'].'/manage-staf-hr')->with('success', 'Berhasil memperbarui staf HR');
        } else {
            return redirect(Session('user')['role'].'/manage-staf-hr')->with('failed', 'Gagal memperbarui staf HR');
        }
    }

    public function show(){

    }

    public function destroy(Request $request)
    {
        $staf_hr = Staf_hr::find($request->segment(3));
        if ($staf_hr->delete()) {
            return redirect(Session('user')['role'].'/manage-staf-hr')->with('success', 'Berhasil menghapus staf HR');
        } else {
            return redirect(Session('user')['role'].'/manage-staf-hr')->with('failed', 'Gagal menghapus staf HR');
        }
    }
}
