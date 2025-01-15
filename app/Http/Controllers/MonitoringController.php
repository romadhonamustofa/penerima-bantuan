<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BantuanSosial;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index()
{
    // Mengambil total laporan
    $totalLaporan = BantuanSosial::count();

    // Mengambil jumlah penerima per program
    $jumlahPerProgram = BantuanSosial::select('nama_program', DB::raw('SUM(jumlah_penerima_bantuan) as total_penerima'))
        ->groupBy('nama_program')
        ->get();
    $jumlahPerProgramLabels = $jumlahPerProgram->pluck('nama_program')->toArray();
    $jumlahPerProgramData = $jumlahPerProgram->pluck('total_penerima')->toArray();

    // Mengambil penyaluran per wilayah
    $penyaluranPerWilayah = BantuanSosial::select(
        'wilayah_provinsi',
        'wilayah_kabupaten',
        DB::raw('SUM(jumlah_penerima_bantuan) as total_penerima')
    )
        ->groupBy('wilayah_provinsi', 'wilayah_kabupaten')
        ->get();
    $penyaluranPerWilayahLabels = $penyaluranPerWilayah->map(function ($item) {
        return $item->wilayah_provinsi . ' - ' . $item->wilayah_kabupaten;
    })->toArray();
    $penyaluranPerWilayahData = $penyaluranPerWilayah->pluck('total_penerima')->toArray();

    // Data untuk grafik tambahan (contoh: jumlah bantuan per bulan)
    $bantuanPerBulan = BantuanSosial::select(
        DB::raw('MONTHNAME(created_at) as bulan'),
        DB::raw('SUM(jumlah_penerima_bantuan) as total_bantuan')
    )
        ->groupBy('bulan')
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();
    $bantuanPerBulanLabels = $bantuanPerBulan->pluck('bulan')->toArray();
    $bantuanPerBulanData = $bantuanPerBulan->pluck('total_bantuan')->toArray();

    return view('monitoring.index', compact(
        'totalLaporan',
        'jumlahPerProgramLabels',
        'jumlahPerProgramData',
        'penyaluranPerWilayahLabels',
        'penyaluranPerWilayahData',
        'bantuanPerBulanLabels',
        'bantuanPerBulanData'
    ));
}

}
