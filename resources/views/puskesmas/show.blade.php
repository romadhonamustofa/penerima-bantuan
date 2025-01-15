@extends('layouts.backend.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title font-weight-bold" style="font-size: 28px;">Detail Bantuan Sosial</h1>

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
        <marquee behavior="scroll" direction="left">
            <b>Detail Data Bantuan Sosial</b>
        </marquee>

        <!-- Tabel Detail Bantuan Sosial -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Program</th>
                        <td>{{ $bantuanSosial->nama_program }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Penerima</th>
                        <td>{{ $bantuanSosial->jumlah_penerima_bantuan }}</td>
                    </tr>
                    <tr>
                        <th>Wilayah</th>
                        <td>
                            {{ $bantuanSosial->wilayah_provinsi }},
                            {{ $bantuanSosial->wilayah_kabupaten }},
                            {{ $bantuanSosial->wilayah_kecamatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Penyaluran</th>
                        <td>{{ \Carbon\Carbon::parse($bantuanSosial->tanggal_penyaluran)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>{{ $bantuanSosial->catatan_tambahan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge 
                                @if($bantuanSosial->status === 'Disetujui') badge-success 
                                @elseif($bantuanSosial->status === 'Ditolak') badge-danger 
                                @else badge-secondary 
                                @endif">
                                {{ $bantuanSosial->status }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: top;">Bukti Penyaluran</th>
                        <td>
                            @if($bantuanSosial->bukti_penyaluran)
                            <a href="{{ asset('storage/' . $bantuanSosial->bukti_penyaluran) }}" download>
                                <img src="{{ asset('storage/' . $bantuanSosial->bukti_penyaluran) }}" alt="Bukti Penyaluran" style="max-width: 200px; max-height: 150px;">
                            </a>
                            @else
                                <p>No image available</p>
                            @endif
                        </td>
                    </tr>

                </thead>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('puskesmas.index') }}" class="btn btn-secondary">Kembali</a>
            <div>
            <a href="{{ url('bantuan-sosial/' . $bantuanSosial->id . '/export-pdf') }}" class="btn btn-danger">Export to PDF</a>
        </div>
        </div>
    </div>
</div>
@endsection
