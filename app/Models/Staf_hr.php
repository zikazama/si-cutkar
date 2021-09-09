<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staf_hr extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_staf_hr';
    protected $table = "staf_hr";
    protected $fillable = [
        'nama_staf_hr',
        'email',
        'password',
    ];
    public $timestamps = false;

}
