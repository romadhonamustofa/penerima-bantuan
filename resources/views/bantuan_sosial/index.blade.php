@extends('layouts.frontend.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center"><b>DAFTAR BANTUAN SOSIAL</b></h2>

    <!-- Tabel Daftar Bantuan Sosial -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="text-center text-white" style="background-color: #1a033f;">
                <tr>
                    <th>NO</th>
                    <th>Nama Program</th>
                    <th>Jumlah Penerima</th>
                    <th>Wilayah</th>
                    <th>Tanggal Penyaluran</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bantuanSosial as $index => $bantuan)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bantuan->nama_program }}</td>
                    <td>{{ $bantuan->jumlah_penerima_bantuan }}</td>
                    <td>{{ $bantuan->wilayah_provinsi }}, {{ $bantuan->wilayah_kabupaten }}, {{ $bantuan->wilayah_kecamatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($bantuan->tanggal_penyaluran)->format('d-m-Y') }}</td>
                    <td>{{ $bantuan->catatan_tambahan ?? '-' }}</td>
                    <td>
                        <span class="badge 
                            @if($bantuan->status == 'Menunggu') bg-secondary
                            @elseif($bantuan->status == 'Disetujui') bg-success 
                            @elseif($bantuan->status == 'Ditolak') bg-danger
                            @else bg-secondary 
                            @endif">
                            {{ $bantuan->status }}
                        </span>
                    </td>
                    <td>
                        @if($bantuan->status === 'Menunggu')
                            <a href="{{ route('bantuan_sosial.edit', $bantuan->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('bantuan_sosial.destroy', $bantuan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                            </form>
                        @else
                            <span class="text-muted">Laporan yang sudah diverifikasi tidak dapat diperbarui!</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $bantuanSosial->links() }}
    </div>
</div>
@endsection
