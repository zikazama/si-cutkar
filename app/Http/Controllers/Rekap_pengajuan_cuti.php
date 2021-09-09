<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\View_sisa_cuti;

class Rekap_pengajuan_cuti extends Controller
{
    public function index(){
        $data['sisa_cuti'] = View_sisa_cuti::all();
        return view('rekap_pengajuan_cuti',$data);
    }
}
