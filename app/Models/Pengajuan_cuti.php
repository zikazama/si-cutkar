<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_cuti extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pengajuan_cuti';
    protected $table = "pengajuan_cuti";
    protected $fillable = [
        'id_karyawan',
        'tanggal_pengajuan',
        'lama_cuti',
        'keterangan',
        'status',
        'verifikasi_oleh'
    ];
}
