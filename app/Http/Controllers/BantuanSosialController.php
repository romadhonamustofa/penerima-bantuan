<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BantuanSosial;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class BantuanSosialController extends Controller
{
    // Method untuk menampilkan daftar bantuan sosial
    public function index()
    {
        // Mengambil semua data bantuan sosial dan menggunakan pagination
        $bantuanSosial = BantuanSosial::paginate(10);

        // Menampilkan view index dengan data bantuan sosial
        return view('bantuan_sosial.index', compact('bantuanSosial'));
    }

    public function create()
    {
        return view('bantuan_sosial.create');
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_program' => 'required',
            'jumlah_penerima_bantuan' => 'required|integer',
            'wilayah_provinsi' => 'required',
            'wilayah_kabupaten' => 'required',
            'wilayah_kecamatan' => 'required',
            'tanggal_penyaluran' => 'required|date',
            'bukti_penyaluran' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'catatan_tambahan' => 'nullable|string',
        ]);

        try {
            // Menyimpan file bukti penyaluran
            $filePath = $request->file('bukti_penyaluran')->store('uploads', 'public');

            // Menyimpan data bantuan sosial ke database
            BantuanSosial::create([
                'nama_program' => $request->nama_program,
                'jumlah_penerima_bantuan' => $request->jumlah_penerima_bantuan,
                'wilayah_provinsi' => $request->wilayah_provinsi,
                'wilayah_kabupaten' => $request->wilayah_kabupaten,
                'wilayah_kecamatan' => $request->wilayah_kecamatan,
                'tanggal_penyaluran' => $request->tanggal_penyaluran,
                'bukti_penyaluran' => $filePath,
                'catatan_tambahan' => $request->catatan_tambahan,
                'status' => 'Menunggu', // Status default saat menyimpan
            ]);

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('bantuan_sosial.create')->with('success', 'Data bantuan sosial berhasil disimpan!');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect dengan pesan error
            return redirect()->route('bantuan_sosial.create')->withErrors('Data gagal disimpan, coba lagi.' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Mencari data berdasarkan ID
        $bantuan = BantuanSosial::findOrFail($id);

        // Mengecek apakah status bukan 'menunggu' sebelum mengizinkan edit
        if ($bantuan->status !== 'Menunggu') {
            return redirect()->route('bantuan_sosial.index')->with('error', 'Laporan yang sudah diverifikasi tidak dapat diedit.');
        }

        // Menampilkan form edit dengan data bantuan sosial
        return view('bantuan_sosial.edit', compact('bantuan'));
    }

    public function update(Request $request, $id)
    {
        $bantuan = BantuanSosial::findOrFail($id);

        // Mengecek apakah status bukan 'menunggu'
        if ($bantuan->status !== 'Menunggu') {
            return redirect()->route('bantuan_sosial.index')->with('error', 'Laporan yang sudah diverifikasi tidak dapat diperbarui.');
        }

        // Validasi data input
        $request->validate([
            'nama_program' => 'required',
            'jumlah_penerima_bantuan' => 'required|integer',
            'wilayah_provinsi' => 'required',
            'wilayah_kabupaten' => 'required',
            'wilayah_kecamatan' => 'required',
            'tanggal_penyaluran' => 'required|date',
            'catatan_tambahan' => 'nullable|string',
        ]);

        // Menangani file jika ada yang diunggah
        if ($request->hasFile('bukti_penyaluran')) {
            // Menghapus file lama jika ada
            if ($bantuan->bukti_penyaluran && Storage::exists('public/' . $bantuan->bukti_penyaluran)) {
                Storage::delete('public/' . $bantuan->bukti_penyaluran);
            }
            // Menyimpan file baru
            $filePath = $request->file('bukti_penyaluran')->store('uploads', 'public');
            $bantuan->bukti_penyaluran = $filePath;
        }

        // Update data bantuan sosial
        $bantuan->update([
            'nama_program' => $request->nama_program,
            'jumlah_penerima_bantuan' => $request->jumlah_penerima_bantuan,
            'wilayah_provinsi' => $request->wilayah_provinsi,
            'wilayah_kabupaten' => $request->wilayah_kabupaten,
            'wilayah_kecamatan' => $request->wilayah_kecamatan,
            'tanggal_penyaluran' => $request->tanggal_penyaluran,
            'catatan_tambahan' => $request->catatan_tambahan,
        ]);

        return redirect()->route('bantuan_sosial.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $bantuan = BantuanSosial::findOrFail($id);

        // Mengecek apakah status bukan 'menunggu'
        if ($bantuan->status !== 'Menunggu') {
            return redirect()->route('bantuan_sosial.index')->with('error', 'Laporan yang sudah diverifikasi tidak dapat dihapus.');
        }

        try {
            // Menghapus file bukti penyaluran jika ada
            if ($bantuan->bukti_penyaluran && Storage::exists('public/' . $bantuan->bukti_penyaluran)) {
                Storage::delete('public/' . $bantuan->bukti_penyaluran);
            }

            // Menghapus data bantuan sosial
            $bantuan->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('bantuan_sosial.index')->with('success', 'Laporan berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect dengan pesan error
            return redirect()->route('bantuan_sosial.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $bantuan = BantuanSosial::findOrFail($id);
        $status = $request->status;

        // Validasi status
        if (in_array($status, ['Disetujui', 'Ditolak'])) {
            $bantuan->update(['status' => $status]);
            return redirect()->route('puskesmas.index')->with('success', "Status berhasil diperbarui menjadi $status!");
        }

        return redirect()->route('puskesmas.index')->with('error', 'Status tidak valid.');
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
