<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan Sosial - {{ $bantuanSosial->nama_program }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            width: 30%;
        }
        .table td {
            width: 70%;
        }
        .img-container {
            max-width: 200px;
            max-height: 150px;
        }
    </style>
</head>
<body>

    <h1>Detail Bantuan Sosial: {{ $bantuanSosial->nama_program }}</h1>

    <table class="table">
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
            <td>{{ $bantuanSosial->wilayah_provinsi }}, {{ $bantuanSosial->wilayah_kabupaten }}, {{ $bantuanSosial->wilayah_kecamatan }}</td>
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
            <td>{{ $bantuanSosial->status }}</td>
        </tr>
        <tr>
            <th style="vertical-align: top;">Bukti Penyaluran</th>
            <td>
                @if($bantuanSosial->bukti_penyaluran)
                    <a href="{{ asset('storage/' . $bantuanSosial->bukti_penyaluran) }}" download>
                        <img src="{{ asset('storage/' . $bantuanSosial->bukti_penyaluran) }}" alt="Bukti Penyaluran" class="img-container">
                    </a>
                @else
                    <p>No image available</p>
                @endif
            </td>
        </tr>
    </table>

</body>
</html>
