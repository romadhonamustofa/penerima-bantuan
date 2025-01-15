@extends('layouts.backend.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title font-weight-bold" style="font-size: 28px;">Data Bantuan Sosial</h1>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <!-- Marquee -->
        <marquee behavior="scroll" direction="left">
            <b>Selamat Datang Admin Sistem Penerima Bantuan Sosial</b>
        </marquee>

        <!-- Tabel Data Bantuan Sosial -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="text-center">
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
                    @foreach($bantuanSosialList as $index => $bantuan)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $bantuan->nama_program }}</td>
                        <td>{{ $bantuan->jumlah_penerima_bantuan }}</td>
                        <td>
                            {{ $bantuan->wilayah_provinsi }}, 
                            {{ $bantuan->wilayah_kabupaten }}, 
                            {{ $bantuan->wilayah_kecamatan }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($bantuan->tanggal_penyaluran)->format('d-m-Y') }}</td>
                        <td>{{ $bantuan->catatan_tambahan ?? '-' }}</td>
                        <td>
                            <span class="badge 
                                @if($bantuan->status === 'Disetujui') badge-success 
                                @elseif($bantuan->status === 'Ditolak') badge-danger 
                                @else badge-secondary 
                                @endif">
                                {{ $bantuan->status }}
                            </span>
                        </td>
                        <td>
    <a href="{{ route('puskesmas.show', $bantuan->id) }}" class="btn btn-info btn-sm">Lihat</a>

    <!-- Form for updating status to Disetujui -->
    <form action="{{ route('bantuan_sosial.updateStatus', $bantuan->id) }}" method="POST" style="display:inline;">
        @csrf
        <input type="hidden" name="status" value="Disetujui">
        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin menyetujui data ini?')">Disetujui</button>
    </form>

    <!-- Form for updating status to Ditolak -->
    <form action="{{ route('bantuan_sosial.updateStatus', $bantuan->id) }}" method="POST" style="display:inline;">
        @csrf
        <input type="hidden" name="status" value="Ditolak">
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menolak data ini?')">Ditolak</button>
    </form>
</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $bantuanSosialList->links() }}
        </div>
    </div>
</div>
@endsection
