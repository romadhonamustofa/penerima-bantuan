@extends('layouts.frontend.app')

@section('content')

<div class="container py-5">
    <h2 class="mb-4 text-center"><b>FORM BANTUAN SOSIAL</b></h2>

    <!-- Menampilkan notifikasi jika ada pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan notifikasi jika ada pesan error -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bantuan_sosial.store') }}" method="POST" enctype="multipart/form-data" class="shadow-lg p-4 rounded bg-light">
        @csrf

        <!-- Nama Program -->
<div class="form-group mb-3">
    <label for="nama_program" class="font-weight-bold">Nama Program</label>
    <select name="nama_program" id="nama_program" class="form-control" required>
        <option value="" disabled selected>Pilih Program Bantuan Sosial</option>
        <option value="PKH">PKH (Program Keluarga Harapan)</option>
        <option value="BLT">BLT (Bantuan Langsung Tunai)</option>
        <option value="BST">BST (Bantuan Sosial Tunai)</option>
        <option value="BPNT">BPNT (Bantuan Pangan Non Tunai)</option>
        <option value="PIP">PIP (Program Indonesia Pintar)</option>
        <option value="BSPS">BSPS (Bantuan Stimulan Perumahan Swadaya)</option>
        <option value="BUEP">BUEP (Bantuan Usaha Ekonomi Produktif)</option>
        <option value="Kartu Prakerja">Kartu Prakerja</option>
        <option value="Bantuan Beras">Bantuan Beras</option>
        <option value="Jamkesmas">Jamkesmas (Jaminan Kesehatan Masyarakat)</option>
        <option value="Bidikmisi">Bidikmisi (Bantuan Pendidikan bagi Mahasiswa)</option>
        <option value="MBR">MBR (Bantuan Perumahan untuk MBR)</option>
        <option value="Bantuan Disabilitas">Bantuan Sosial untuk Penyandang Disabilitas</option>
        <option value="Bantuan Pekerja">Bantuan untuk Pekerja Tidak Tetap</option>
    </select>
</div>


        <!-- Jumlah Penerima Bantuan -->
        <div class="form-group mb-3">
            <label for="jumlah_penerima_bantuan" class="font-weight-bold">Jumlah Penerima Bantuan</label>
            <input placeholder="Masukkan Jumlah Penerima" type="number" name="jumlah_penerima_bantuan" id="jumlah_penerima_bantuan" class="form-control" required>
        </div>

        <!-- Provinsi -->
        <div class="form-group mb-3">
    <label for="wilayah_provinsi" class="font-weight-bold">Provinsi</label>
    <select name="wilayah_provinsi" id="wilayah_provinsi" class="form-control" required>
        <option value="" disabled selected>Pilih Provinsi</option>
        <!-- Sumatera -->
        <option value="Aceh">Aceh</option>
        <option value="Sumatera Utara">Sumatera Utara</option>
        <option value="Sumatera Barat">Sumatera Barat</option>
        <option value="Riau">Riau</option>
        <option value="Kepulauan Riau">Kepulauan Riau</option>
        <option value="Jambi">Jambi</option>
        <option value="Sumatera Selatan">Sumatera Selatan</option>
        <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
        <option value="Bengkulu">Bengkulu</option>
        <option value="Lampung">Lampung</option>
        
        <!-- Jawa -->
        <option value="DKI Jakarta">DKI Jakarta</option>
        <option value="Jawa Barat">Jawa Barat</option>
        <option value="Banten">Banten</option>
        <option value="Jawa Tengah">Jawa Tengah</option>
        <option value="DI Yogyakarta">DI Yogyakarta</option>
        <option value="Jawa Timur">Jawa Timur</option>
        
        <!-- Kalimantan -->
        <option value="Kalimantan Barat">Kalimantan Barat</option>
        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
        <option value="Kalimantan Timur">Kalimantan Timur</option>
        <option value="Kalimantan Utara">Kalimantan Utara</option>
        
        <!-- Sulawesi -->
        <option value="Sulawesi Utara">Sulawesi Utara</option>
        <option value="Gorontalo">Gorontalo</option>
        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
        <option value="Sulawesi Barat">Sulawesi Barat</option>
        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
        
        <!-- Bali dan Nusa Tenggara -->
        <option value="Bali">Bali</option>
        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
        
        <!-- Maluku dan Papua -->
        <option value="Maluku">Maluku</option>
        <option value="Maluku Utara">Maluku Utara</option>
        <option value="Papua">Papua</option>
        <option value="Papua Barat">Papua Barat</option>
    </select>
</div>


       <!-- Kabupaten -->
<div class="form-group mb-3">
    <label for="wilayah_kabupaten" class="font-weight-bold">Kabupaten</label>
    <input type="text" name="wilayah_kabupaten" id="wilayah_kabupaten" class="form-control" placeholder="Masukkan Kabupaten" required>
</div>

<!-- Kecamatan -->
<div class="form-group mb-3">
    <label for="wilayah_kecamatan" class="font-weight-bold">Kecamatan</label>
    <input type="text" name="wilayah_kecamatan" id="wilayah_kecamatan" class="form-control" placeholder="Masukkan Kecamatan" required>
</div>


        <!-- Tanggal Penyaluran -->
        <div class="form-group mb-3">
            <label for="tanggal_penyaluran" class="font-weight-bold">Tanggal Penyaluran</label>
            <input type="date" name="tanggal_penyaluran" id="tanggal_penyaluran" class="form-control" required>
        </div>

        <!-- Bukti Penyaluran -->
        <div class="form-group mb-3">
            <label for="bukti_penyaluran" class="font-weight-bold">Bukti Penyaluran</label>
            <input type="file" name="bukti_penyaluran" id="bukti_penyaluran" class="form-control" accept=".jpg,.png,.pdf" required>
        </div>

        <!-- Catatan Tambahan -->
        <div class="form-group mb-4">
            <label for="catatan_tambahan" class="font-weight-bold">Catatan Tambahan</label>
            <textarea name="catatan_tambahan" id="catatan_tambahan" class="form-control" rows="4" placeholder="Opsional"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary px-4 py-2">Simpan</button>
        </div>
    </form>
</div>


@endsection
