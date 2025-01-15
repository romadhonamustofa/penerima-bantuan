<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'nama_puskesmas',
        'jumlah_balita_ditimbang',
        'status_gizi_kurang',
        'status_gizi_buruk',
        'pemberian_vit_a',
        'status_gizi_stunting',
    ];
}
