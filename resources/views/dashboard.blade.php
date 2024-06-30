@extends('layouts.seller-navbar')

@section('content')
<div>
    <H2 class="text-center">DASHBOARD OWNER</H2>
</div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Product</h5>
                        <p class="card-text" style="font-size: 24px; color: #007bff;">{{ $totalProduct }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Product (Sedang Disewa)</h5>
                        <p class="card-text" style="font-size: 24px; color: #ffd500;">{{ $productSedangDisewa }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan</h5>
                        <p class="card-text" style="font-size: 24px; color: #00c832;">
                            Rp {{ number_format($pendapatan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <canvas id="pendapatanChartContainer"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('pendapatanChartContainer').getContext('2d');

            const data = @json($formattedRevenue);

            const years = [...new Set(data.map(item => item.year))];

            const datasets = years.map(year => {
                const yearData = data.filter(item => item.year === year);
                const counts = Array.from({
                    length: 12
                }, (_, i) => {
                    const monthData = yearData.find(item => item.month === (i + 1));
                    return monthData ? monthData.total : 0;
                });

                return {
                    label: year.toString(),
                    data: counts,
                    backgroundColor: 'rgba(40, 167, 69, 0.6)', // Changed to green
                    borderColor: 'rgba(40, 167, 69, 1)', // Changed to green
                    borderWidth: 1
                };
            });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                        'September', 'October', 'November', 'December'
                    ],
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Pendapatan Bulanan',
                            font: {
                                size: 20
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += 'Rp ' + context.raw.toLocaleString();
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <style>
        #pendapatanChartContainer {
            width: 100%;
            max-width: 800px;
            /* Adjust max-width as per your design */
            margin: auto;
            /* Center horizontally */
        }
    </style>
@endsection
