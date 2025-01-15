<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil notifikasi dari sesi
        $successMessage = Session::get('success');

        // Tampilkan halaman dashboard dan kirim notifikasi ke view
        return view('dashboard', ['successMessage' => $successMessage]);
    }
}
