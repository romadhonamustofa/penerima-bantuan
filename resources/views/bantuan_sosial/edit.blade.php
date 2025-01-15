@extends('layouts.frontend.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center"><b>EDIT BANTUAN SOSIAL</b></h2>

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

    <form action="{{ route('bantuan_sosial.update', $bantuan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input Nama Program -->
        <div class="form-group">
            <label for="nama_program">Nama Program</label>
            <input type="text" name="nama_program" class="form-control" value="{{ old('nama_program', $bantuan->nama_program) }}" required>
        </div>

        <!-- Input Jumlah Penerima Bantuan -->
        <div class="form-group">
            <label for="jumlah_penerima_bantuan">Jumlah Penerima Bantuan</label>
            <input type="number" name="jumlah_penerima_bantuan" class="form-control" value="{{ old('jumlah_penerima_bantuan', $bantuan->jumlah_penerima_bantuan) }}" required>
        </div>

        <!-- Provinsi -->
        <div class="form-group mb-3">
            <label for="wilayah_provinsi" class="font-weight-bold">Provinsi</label>
            <select name="wilayah_provinsi" id="wilayah_provinsi" class="form-control" required>
                <option value="Yogyakarta">Yogyakarta</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Surabaya">Surabaya</option>
            </select>
        </div>

        <!-- Input Wilayah Kabupaten -->
        <div class="form-group">
            <label for="wilayah_kabupaten">Wilayah Kabupaten</label>
            <select name="wilayah_kabupaten" id="wilayah_kabupaten" class="form-control" required>
                <!-- Kabupatennya akan disesuaikan dengan pilihan provinsi -->
                <option value="">Pilih Kabupaten</option>
            </select>
        </div>

        <!-- Input Wilayah Kecamatan -->
        <div class="form-group">
            <label for="wilayah_kecamatan">Wilayah Kecamatan</label>
            <select name="wilayah_kecamatan" id="wilayah_kecamatan" class="form-control" required>
                <!-- Kecamatan akan disesuaikan dengan kabupaten yang dipilih -->
                <option value="">Pilih Kecamatan</option>
            </select>
        </div>

        <!-- Input Tanggal Penyaluran -->
        <div class="form-group">
            <label for="tanggal_penyaluran">Tanggal Penyaluran</label>
            <input type="date" name="tanggal_penyaluran" class="form-control" value="{{ old('tanggal_penyaluran', $bantuan->tanggal_penyaluran) }}" required>
        </div>

        <!-- Input Bukti Penyaluran -->
        <div class="form-group">
            <label for="bukti_penyaluran">Bukti Penyaluran</label>
            <input type="file" name="bukti_penyaluran" class="form-control">
            @if($bantuan->bukti_penyaluran)
                <small>File yang diunggah sebelumnya: <a href="{{ asset('storage/'.$bantuan->bukti_penyaluran) }}" target="_blank">Lihat</a></small>
            @endif
        </div>

        <!-- Input Catatan Tambahan -->
        <div class="form-group">
            <label for="catatan_tambahan">Catatan Tambahan</label>
            <textarea name="catatan_tambahan" class="form-control">{{ old('catatan_tambahan', $bantuan->catatan_tambahan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

</div>

<!-- JavaScript / jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Script untuk mengubah dropdown Kabupaten berdasarkan Provinsi yang dipilih
    $('#wilayah_provinsi').on('change', function() {
        var provinsi = $(this).val(); // Ambil nilai provinsi yang dipilih

        // Clear kabupaten dan kecamatan sebelumnya
        $('#wilayah_kabupaten').empty();
        $('#wilayah_kecamatan').empty();

        // Cek provinsi dan update dropdown kabupaten secara dinamis
        if (provinsi == 'Yogyakarta') {
            $('#wilayah_kabupaten').append('<option value="Sleman">Sleman</option><option value="Bantul">Bantul</option>');
        } else if (provinsi == 'Jakarta') {
            $('#wilayah_kabupaten').append('<option value="Jakarta Pusat">Jakarta Pusat</option><option value="Jakarta Barat">Jakarta Barat</option>');
        } else if (provinsi == 'Surabaya') {
            $('#wilayah_kabupaten').append('<option value="Surabaya">Surabaya</option>');
        }
    });

    // Script untuk mengubah dropdown Kecamatan berdasarkan Kabupaten yang dipilih
    $('#wilayah_kabupaten').on('change', function() {
        var kabupaten = $(this).val(); // Ambil nilai kabupaten yang dipilih

        // Clear kecamatan sebelumnya
        $('#wilayah_kecamatan').empty();

        // Cek kabupaten dan update dropdown kecamatan secara dinamis
        if (kabupaten == 'Sleman') {
            $('#wilayah_kecamatan').append('<option value="Depok">Depok</option><option value="Gamping">Gamping</option>');
        } else if (kabupaten == 'Bantul') {
            $('#wilayah_kecamatan').append('<option value="Bantul">Bantul</option><option value="Pundong">Pundong</option>');
        } else if (kabupaten == 'Jakarta Pusat') {
            $('#wilayah_kecamatan').append('<option value="Menteng">Menteng</option><option value="Cempaka Putih">Cempaka Putih</option>');
        } else if (kabupaten == 'Jakarta Barat') {
            $('#wilayah_kecamatan').append('<option value="Kebon Jeruk">Kebon Jeruk</option><option value="Palmerah">Palmerah</option>');
        } else if (kabupaten == 'Surabaya') {
            $('#wilayah_kecamatan').append('<option value="Gubeng">Gubeng</option><option value="Wonokromo">Wonokromo</option>');
        }
    });
</script>

@endsection
