<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanSosial extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi plural Laravel
    protected $table = 'bantuan_sosial';

    // Tentukan kolom yang bisa diisi (Mass Assignment)

    protected $fillable = [
        'nama_program',
        'jumlah_penerima_bantuan',
        'wilayah_provinsi',
        'wilayah_kabupaten',
        'wilayah_kecamatan',
        'tanggal_penyaluran',
        'bukti_penyaluran',
        'catatan_tambahan',
        'status',
    ];

    // Default value untuk kolom status
    protected $attributes = [
        'status' => 'Menunggu',
    ];
}
