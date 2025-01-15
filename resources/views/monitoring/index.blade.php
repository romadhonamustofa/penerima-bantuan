@extends('layouts.backend.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title font-weight-bold" style="font-size: 28px;">Statistik Progres Penyaluran Bantuan</h1>
    </div>
    <div class="card-body" style="max-height: 600px; overflow-y: auto;">
        <!-- Grafik Total Laporan -->
        <div class="row">
            <div class="col-md-6">
                <canvas id="totalLaporanChart"></canvas>
            </div>
            <div class="col-md-6">
                <h4>Total Laporan yang Masuk</h4>
                <p>{{ $totalLaporan }} laporan</p>
            </div>
        </div>

        <!-- Grafik Jumlah Penerima Bantuan per Program -->
        <div class="row mt-4">
            <div class="col-md-6">
                <canvas id="jumlahPenerimaPerProgramChart"></canvas>
            </div>
            <div class="col-md-6">
                <h4>Jumlah Penerima Bantuan per Program</h4>
                <ul>
                    @foreach($jumlahPerProgramLabels as $index => $label)
                        <li>{{ $label }}: {{ $jumlahPerProgramData[$index] }} penerima</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Grafik Penyaluran Bantuan per Wilayah -->
        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="penyaluranPerWilayahChart"></canvas>
            </div>
        </div>

        <!-- Grafik Jumlah Bantuan per Bulan -->
        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="bantuanPerBulanChart"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Total Laporan
    new Chart(document.getElementById('totalLaporanChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Total Laporan'],
            datasets: [{
                label: 'Total Laporan yang Masuk',
                data: [{{ $totalLaporan }}],
                backgroundColor: ['#4CAF50'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Total Laporan yang Masuk'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Laporan: ${context.raw}`;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                }
            }
        }
    });

    // Grafik Jumlah Penerima Bantuan per Program
    new Chart(document.getElementById('jumlahPenerimaPerProgramChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($jumlahPerProgramLabels) !!},
            datasets: [{
                label: 'Jumlah Penerima Bantuan',
                data: {!! json_encode($jumlahPerProgramData) !!},
                backgroundColor: ['#FF5733', '#FFC300', '#DAF7A6', '#33FF57', '#33FFF5', '#3357FF'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Jumlah Penerima Bantuan per Program'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} penerima`;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Penerima'
                    }
                }
            }
        }
    });

    // Grafik Penyaluran Bantuan per Wilayah
    new Chart(document.getElementById('penyaluranPerWilayahChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($penyaluranPerWilayahLabels) !!},
            datasets: [{
                label: 'Jumlah Penerima Bantuan per Wilayah',
                data: {!! json_encode($penyaluranPerWilayahData) !!},
                backgroundColor: ['#2196F3', '#3F51B5', '#00BCD4', '#8BC34A'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Penyaluran Bantuan per Wilayah'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} penerima`;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Penerima'
                    }
                }
            }
        }
    });

    // Grafik Jumlah Bantuan per Bulan
    new Chart(document.getElementById('bantuanPerBulanChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($bantuanPerBulanLabels) !!},
            datasets: [{
                label: 'Jumlah Bantuan per Bulan',
                data: {!! json_encode($bantuanPerBulanData) !!},
                backgroundColor: ['#8E44AD', '#9B59B6', '#E74C3C', '#3498DB', '#2ECC71'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Jumlah Bantuan per Bulan'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} bantuan`;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Bantuan'
                    }
                }
            }
        }
    });
</script>

@endsection
