@extends('layouts.admin.app')

@section('title', 'Aplikasi Perangkat Desa🤗')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Sistem Aplikasi Perangkat Desa👋</h1>
        <p class="text-gray-600 mt-2">Selamat datang {{ session('name') }}! Ini adalah ringkasan sistem administrasi desa.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Warga -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 stats-card">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Warga</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ \App\Models\Warga::count() }}
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('warga.index') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                Lihat detail
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Lembaga Desa -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 stats-card">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Lembaga Desa</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ \App\Models\LembagaDesa::count() }}
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-landmark text-green-600 text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('lembaga.index') }}" class="mt-4 inline-flex items-center text-green-600 hover:text-green-800 text-sm font-medium">
                Lihat detail
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Perangkat Desa -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500 stats-card">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Perangkat Desa</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ \App\Models\PerangkatDesa::count() }}
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-user-tie text-purple-600 text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('perangkat_desa.index') }}" class="mt-4 inline-flex items-center text-purple-600 hover:text-purple-800 text-sm font-medium">
                Lihat detail
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Total User -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 stats-card">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total User</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ \App\Models\User::count() }}
                    </p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-user-circle text-yellow-600 text-2xl"></i>
                </div>
            </div>
            @if(session('role') == 'Super Admin')
            <a href="{{ route('user.index') }}" class="mt-4 inline-flex items-center text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                Lihat detail
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
            @endif
        </div>
    </div>

    <!-- Welcome & User Info -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Selamat datang, {{ session('name') }}! 👋</h2>
                <p class="text-gray-600 mt-2">
                    Anda login sebagai <span class="font-semibold text-blue-600">{{ session('role') }}</span>. 
                    Sistem administrasi desa siap membantu Anda mengelola data dengan mudah dan efisien.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="inline-flex items-center bg-gray-100 px-4 py-2 rounded-lg">
                </div>
            </div>
        </div>

        @if(session('role') == 'Super Admin')
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-crown text-blue-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-blue-800">Akses Super Admin</h3>
                    <p class="mt-1 text-blue-700">
                        Anda memiliki akses penuh ke semua fitur sistem, termasuk manajemen user dan pengaturan.
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Pie/Donut Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Distribusi Data Desa</h3>
                <div class="flex items-center space-x-2">
                    <button id="pieChartBtn" class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm font-medium">Pie</button>
                    <button id="donutChartBtn" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium">Donut</button>
                </div>
            </div>
            <div class="h-80">
                <canvas id="pieChart"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                    <span class="text-sm text-gray-600">Warga</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                    <span class="text-sm text-gray-600">Lembaga</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div>
                    <span class="text-sm text-gray-600">Perangkat</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                    <span class="text-sm text-gray-600">User</span>
                </div>
            </div>
        </div>

        <!-- Line/Bar Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Statistik Perbandingan</h3>
                <div class="flex items-center space-x-2">
                    <button id="barChartBtn" class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm font-medium">Bar</button>
                    <button id="lineChartBtn" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium">Line</button>
                </div>
            </div>
            <div class="h-80">
                <canvas id="barChart"></canvas>
            </div>
            <div class="mt-4 text-sm text-gray-500">
                <p><i class="fas fa-info-circle mr-1"></i> Menampilkan perbandingan jumlah data dalam sistem</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Quick Links -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Akses Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('warga.create') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-user-plus text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Tambah Data Warga</p>
                        <p class="text-sm text-gray-600">Input data warga baru</p>
                    </div>
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                </a>
                
                <a href="{{ route('lembaga.create') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-plus-circle text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Tambah Lembaga</p>
                        <p class="text-sm text-gray-600">Buat lembaga desa baru</p>
                    </div>
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                </a>
                
                <a href="{{ route('perangkat_desa.create') }}" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition">
                    <div class="bg-purple-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-user-plus text-purple-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Tambah Perangkat</p>
                        <p class="text-sm text-gray-600">Input perangkat desa</p>
                    </div>
                    <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Statistik Sistem</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Jabatan Lembaga</span>
                    <span class="font-bold text-gray-800">
                        {{ \App\Models\JabatanLembaga::count() }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Media Upload</span>
                    <span class="font-bold text-gray-800">
                        {{ \App\Models\Media::count() }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Login Terakhir</span>
                    <span class="font-bold text-gray-800">
                        {{ date('d/m/Y H:i') }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">Role Anda</span>
                    <span class="font-bold px-3 py-1 rounded-full text-sm 
                        @if(session('role') == 'Super Admin') bg-red-100 text-red-800
                        @elseif(session('role') == 'Admin') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ session('role') }}
                    </span>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="font-medium text-gray-700 mb-3">Menu Utama</h4>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('warga.index') }}" class="bg-gray-50 hover:bg-gray-100 p-3 rounded-lg text-center transition">
                        <i class="fas fa-users text-gray-600 mb-2 text-xl"></i>
                        <p class="text-sm font-medium">Warga</p>
                    </a>
                    <a href="{{ route('lembaga.index') }}" class="bg-gray-50 hover:bg-gray-100 p-3 rounded-lg text-center transition">
                        <i class="fas fa-landmark text-gray-600 mb-2 text-xl"></i>
                        <p class="text-sm font-medium">Lembaga</p>
                    </a>
                    <a href="{{ route('perangkat_desa.index') }}" class="bg-gray-50 hover:bg-gray-100 p-3 rounded-lg text-center transition">
                        <i class="fas fa-user-tie text-gray-600 mb-2 text-xl"></i>
                        <p class="text-sm font-medium">Perangkat</p>
                    </a>
                    <a href="{{ route('jabatan-lembaga.index') }}" class="bg-gray-50 hover:bg-gray-100 p-3 rounded-lg text-center transition">
                        <i class="fas fa-sitemap text-gray-600 mb-2 text-xl"></i>
                        <p class="text-sm font-medium">Jabatan</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Note -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
        <i class="fas fa-info-circle text-blue-500 text-xl mb-3"></i>
        <h4 class="font-medium text-gray-800 mb-2">Tips Penggunaan</h4>
        <p class="text-gray-600 text-sm">
            Gunakan menu navigasi di atas untuk mengakses semua fitur. 
            Pastikan data yang dimasukkan akurat dan terupdate secara berkala.
            Untuk bantuan, hubungi administrator sistem.
        </p>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data statistik dari PHP
        const data = {
            warga: {{ \App\Models\Warga::count() }},
            lembaga: {{ \App\Models\LembagaDesa::count() }},
            perangkat: {{ \App\Models\PerangkatDesa::count() }},
            user: {{ \App\Models\User::count() }}
        };

        // Colors untuk chart
        const colors = {
            bg: [
                'rgba(59, 130, 246, 0.8)',  // Blue
                'rgba(34, 197, 94, 0.8)',   // Green
                'rgba(168, 85, 247, 0.8)',  // Purple
                'rgba(245, 158, 11, 0.8)'   // Yellow
            ],
            border: [
                'rgb(59, 130, 246)',
                'rgb(34, 197, 94)',
                'rgb(168, 85, 247)',
                'rgb(245, 158, 11)'
            ]
        };

        // 1. PIE/DOUNT CHART
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        let pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Warga', 'Lembaga', 'Perangkat Desa', 'User'],
                datasets: [{
                    data: [data.warga, data.lembaga, data.perangkat, data.user],
                    backgroundColor: colors.bg,
                    borderColor: colors.border,
                    borderWidth: 2,
                    hoverOffset: 15
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
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                const value = context.raw;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                label += value + ' (' + percentage + '%)';
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Toggle Pie/Donut
        document.getElementById('pieChartBtn').addEventListener('click', function() {
            pieChart.destroy();
            pieChart = new Chart(pieCtx, {
                type: 'pie',
                data: pieChart.data,
                options: pieChart.options
            });
            this.classList.add('bg-blue-100', 'text-blue-600');
            this.classList.remove('bg-gray-100', 'text-gray-600');
            document.getElementById('donutChartBtn').classList.add('bg-gray-100', 'text-gray-600');
            document.getElementById('donutChartBtn').classList.remove('bg-blue-100', 'text-blue-600');
        });

        document.getElementById('donutChartBtn').addEventListener('click', function() {
            pieChart.destroy();
            pieChart = new Chart(pieCtx, {
                type: 'doughnut',
                data: pieChart.data,
                options: {
                    ...pieChart.options,
                    cutout: '60%'
                }
            });
            this.classList.add('bg-blue-100', 'text-blue-600');
            this.classList.remove('bg-gray-100', 'text-gray-600');
            document.getElementById('pieChartBtn').classList.add('bg-gray-100', 'text-gray-600');
            document.getElementById('pieChartBtn').classList.remove('bg-blue-100', 'text-blue-600');
        });

        // 2. BAR/LINE CHART
        const barCtx = document.getElementById('barChart').getContext('2d');
        let barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Warga', 'Lembaga', 'Perangkat Desa', 'User'],
                datasets: [{
                    label: 'Jumlah Data',
                    data: [data.warga, data.lembaga, data.perangkat, data.user],
                    backgroundColor: colors.bg,
                    borderColor: colors.border,
                    borderWidth: 2,
                    borderRadius: 6,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            stepSize: Math.max(...[data.warga, data.lembaga, data.perangkat, data.user]) > 10 ? 5 : 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#fff',
                        borderWidth: 1
                    }
                }
            }
        });

        // Toggle Bar/Line
        document.getElementById('barChartBtn').addEventListener('click', function() {
            barChart.destroy();
            barChart = new Chart(barCtx, {
                type: 'bar',
                data: barChart.data,
                options: barChart.options
            });
            this.classList.add('bg-blue-100', 'text-blue-600');
            this.classList.remove('bg-gray-100', 'text-gray-600');
            document.getElementById('lineChartBtn').classList.add('bg-gray-100', 'text-gray-600');
            document.getElementById('lineChartBtn').classList.remove('bg-blue-100', 'text-blue-600');
        });

        document.getElementById('lineChartBtn').addEventListener('click', function() {
            barChart.destroy();
            barChart = new Chart(barCtx, {
                type: 'line',
                data: {
                    ...barChart.data,
                    datasets: [{
                        ...barChart.data.datasets[0],
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    ...barChart.options,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
            this.classList.add('bg-blue-100', 'text-blue-600');
            this.classList.remove('bg-gray-100', 'text-gray-600');
            document.getElementById('barChartBtn').classList.add('bg-gray-100', 'text-gray-600');
            document.getElementById('barChartBtn').classList.remove('bg-blue-100', 'text-blue-600');
        });

        // Animasi saat chart pertama kali dimuat
        setTimeout(() => {
            pieChart.update();
            barChart.update();
        }, 500);
    });
</script>
@endsection