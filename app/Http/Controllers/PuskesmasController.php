<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puskesmas;
use App\Models\BantuanSosial;
use Barryvdh\DomPDF\Facade\Pdf;



class PuskesmasController extends Controller
{
    public function index()
    {
        // Mengambil data Bantuan Sosial dengan pagination
        $bantuanSosialList = BantuanSosial::paginate(10);

        // Mengambil data Puskesmas jika diperlukan
        $puskesmasList = Puskesmas::all();

        // Mengirim data ke tampilan
        return view('puskesmas.index', compact('bantuanSosialList', 'puskesmasList'));
    }

    public function updateStatus(Request $request, $id)
{
    $bantuan = BantuanSosial::findOrFail($id);
    $status = $request->status;

    // Validasi status
    if (in_array($status, ['Disetujui', 'Ditolak'])) {
        $bantuan->update(['status' => $status]);
        return redirect()->back()->with('success', "Status berhasil diperbarui menjadi $status!");
    }

    return redirect()->back()->with('error', 'Status tidak valid.');
}

public function show($id)
{
    $bantuanSosial = BantuanSosial::findOrFail($id);
    return view('puskesmas.show', compact('bantuanSosial'));
}



public function exportToPdf($id)
{
    // Ambil data bantuan sosial berdasarkan ID
    $bantuanSosial = BantuanSosial::findOrFail($id);
    
    // Generate PDF dengan view yang sudah dibuat
    $pdf = Pdf::loadView('pdf.bantuan_sosial', compact('bantuanSosial'));
    
    // Unduh PDF
    return $pdf->download('bantuan_sosial_' . $id . '.pdf');
}


}
