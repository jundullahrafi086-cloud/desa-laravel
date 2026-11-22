@extends('layouts.main')
@section('content')
<style>
    /* Custom styles untuk peningkatan UI */
    .section-title h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #6fcf97;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }
    
    .section-title h2::after {
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg,  #6fcf97 0%, rgba(247, 247, 150, 1));
        border-radius: 2px;
    }
    
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background: linear-gradient(135deg, #6fcf97 0%, rgba(247, 247, 150, 1));
        border: none;
        padding: 15px 20px;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(111, 207, 151, 0.12);
        transition: background-color 0.3s ease;
    }
    
    .chart-container {
        position: relative;
        height: 350px;
    }
    
    .badge-custom {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        font-weight: 500;
    }
    
    @media (max-width: 768px) {
        .chart-container {
            height: 250px;
        }
    }
</style>

<section class="counts section-bg" style="background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%); padding: 60px 0; border-radius: 15px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
    <div class="container">
        <!-- Data Agama Section -->
        <div class="row my-4">
            <div class="col-12 text-center mb-4">
                <div class="section-title">
                    <h2>Data Agama</h2>
                </div>
                <p class="text-muted">Distribusi penganut agama dalam populasi</p>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-place-of-worship me-2"></i> Tabel Agama
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="text-white" style="background: linear-gradient(135deg, #667eea 0%, #6fcf97 0%);">
                                    <tr>
                                        <th scope="col" style="border: none; padding: 12px 15px; font-weight: 500;">Agama</th>
                                        <th scope="col" style="border: none; padding: 12px 15px; font-weight: 500;">Penganut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataAgamas as $agama)
                                    <tr>
                                        <td style="padding: 12px 15px; border-bottom: 1px solid #f1f1f1;">
                                            <span class="badge badge-custom bg-light text-dark">{{ $agama->agama }}</span>
                                        </td>
                                        <td style="padding: 12px 15px; border-bottom: 1px solid #f1f1f1;">{{ $agama->penganut }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-warning text-dark">
                                    <tr>
                                        <td style="padding: 12px 15px; font-weight: 600;">Total</td>
                                        <td style="padding: 12px 15px; font-weight: 600;">{{ $totalPenganut }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                    
                    </div>
                </div>
            </div>
        
            <div class="col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i> Grafik Agama
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="agamaChart"></canvas>
                        </div>                          
                    </div>
                </div>
            </div>
        </div>
    
        <hr style="border: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.3), transparent); margin: 40px 0;">
        
        <!-- Data Jenis Kelamin Section -->
        <div class="row my-4">
            <div class="col-12 text-center mb-4">
                <div class="section-title">
                    <h2>Data Jenis Kelamin</h2>
                </div>
                <p class="text-muted">Distribusi jenis kelamin dalam populasi</p>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-venus-mars me-2"></i> Tabel Jenis Kelamin
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="text-white" style="background: linear-gradient(135deg, #6fcf97 0%, #11998e 100%);">
                                    <tr>
                                        <th scope="col" style="border: none; padding: 12px 15px; font-weight: 500;">Jenis Kelamin</th>
                                        <th scope="col" style="border: none; padding: 12px 15px; font-weight: 500;">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataJenisKelamins as $dataJenisKelamin)
                                    <tr>
                                        <td style="padding: 12px 15px; border-bottom: 1px solid #f1f1f1;">
                                            <span class="badge badge-custom bg-light text-dark">{{ $dataJenisKelamin->jenis_kelamin }}</span>
                                        </td>
                                        <td style="padding: 12px 15px; border-bottom: 1px solid #f1f1f1;">{{ $dataJenisKelamin->jumlah }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-warning text-dark">
                                    <tr>
                                        <td style="padding: 12px 15px; font-weight: 600;">Total</td>
                                        <td style="padding: 12px 15px; font-weight: 600;">{{ $jumlahTotal }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                    
                    </div>
                </div>
            </div>
        
            <div class="col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-pie me-2"></i> Grafik Jenis Kelamin
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="jenisKelaminChart"></canvas>
                        </div>                          
                    </div>
                </div>
            </div>
        </div>
        
        <hr style="border: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.3), transparent); margin: 40px 0;">
        
        <!-- Data Pekerjaan Section -->
        <div class="row my-4">
            <div class="col-12 text-center mb-4">
                <div class="section-title">
                    <h2>Data Pekerjaan</h2>
                </div>
                <p class="text-muted">Distribusi jenis pekerjaan dalam populasi</p>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-briefcase me-2"></i> Tabel Pekerjaan
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="text-white" style="background: linear-gradient(135deg, #6fcf97 0%, #11998e 100%);">
                                    <tr>
                                        <th scope="col" style="border: none; padding: 12px 15px; font-weight: 500;">Pekerjaan</th>
                                        <th scope="col" style="border: none; padding: 12px 15px; font-weight: 500;">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pekerjaans as $pekerjaan)
                                    <tr>
                                        <td style="padding: 12px 15px; border-bottom: 1px solid #f1f1f1;">
                                            <span class="badge badge-custom bg-light text-dark">{{ $pekerjaan->pekerjaan }}</span>
                                        </td>
                                        <td style="padding: 12px 15px; border-bottom: 1px solid #f1f1f1;">{{ $pekerjaan->jumlah }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-warning text-dark">
                                    <tr>
                                        <td style="padding: 12px 15px; font-weight: 600;">Total</td>
                                        <td style="padding: 12px 15px; font-weight: 600;">{{ $totalPekerjaan }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                    
                    </div>
                </div>
            </div>
        
            <div class="col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i> Grafik Pekerjaan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pekerjaanChart"></canvas>
                        </div>                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart Agama
    const ctxAgama = document.getElementById('agamaChart').getContext('2d');
    const labels = {!! $labels !!};
    const dataPenganut = {!! $dataPenganut !!};
    
    const agamaChart = new Chart(ctxAgama, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Penganut Agama',
          data: dataPenganut,
          backgroundColor: [
            'rgba(255, 99, 132, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(255, 205, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(201, 203, 207, 0.7)'
          ],
          borderColor: [
            '#6fcf97 ',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1,
          borderRadius: 5
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                titleFont: {
                    size: 14,
                    weight: 'bold'
                },
                bodyFont: {
                    size: 13
                },
                padding: 10,
                cornerRadius: 5
            }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
                color: 'rgba(0, 0, 0, 0.05)'
            },
            ticks: {
                font: {
                    size: 12
                }
            }
          },
          x: {
            grid: {
                display: false
            },
            ticks: {
                font: {
                    size: 12
                }
            }
          }
        },
        animation: {
            duration: 2000,
            easing: 'easeOutQuart'
        }
      }
    });
    
    // Chart Jenis Kelamin
    const ctxJenisKelamin = document.getElementById('jenisKelaminChart').getContext('2d');
    const labelsJenisKelamin = {!! $labelsJenisKelamin !!};
    const jumlah = {!! $jumlah !!};
    
    const jenisKelaminChart = new Chart(ctxJenisKelamin, {
        type: 'doughnut', 
        data: {
            labels: labelsJenisKelamin,
            datasets: [{
                label: 'Jumlah Jenis Kelamin',
                data: jumlah,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                ],
                borderColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
                borderWidth: 1,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 13
                        },
                        padding: 15
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 10,
                    cornerRadius: 5
                }
            },
            cutout: '65%',
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });
    
    // Chart Pekerjaan (diubah menjadi bar chart)
    const ctxPekerjaan = document.getElementById('pekerjaanChart').getContext('2d');
    const labelPekerjaan = {!! $labelPekerjaan !!};
    const dataPekerjaan = {!! $jumlahPekerjaan !!};
    
    const pekerjaanChart = new Chart(ctxPekerjaan, {
        type: 'bar',
        data: {
            labels: labelPekerjaan,
            datasets: [{
                label: 'Jumlah Pekerjaan',
                data: dataPekerjaan,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 205, 86, 0.7)',
                    'rgba(201, 203, 207, 0.7)',
                    'rgba(54, 162, 235, 0.7)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(201, 203, 207)',
                    'rgb(54, 162, 235)'
                ],
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 10,
                    cornerRadius: 5
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            }
        }
    });
</script>
@endsection