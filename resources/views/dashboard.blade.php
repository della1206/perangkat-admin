@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Search Bar -->
    <div class="flex justify-start mb-6">
        <div class="relative w-full max-w-sm">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" />
            </svg>
            <input
                type="text"
                placeholder="Cari data warga, lembaga, atau perangkat..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
            >
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="bg-gray-50 p-8 rounded-lg mb-8">
        <h2 class="text-2xl font-bold mb-2">Selamat Datang di Aplikasi Perangkat Desa 👋</h2>
        <p class="text-gray-600 mb-6">
            Gunakan menu di kiri untuk mengelola data warga, lembaga desa, dan perangkat desa.
        </p>

        <!-- Main Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('warga.index') }}" 
               class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-blue-50 transition duration-200">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Data Warga</h3>
                <p class="text-gray-600 text-sm">Lihat dan kelola data warga desa secara lengkap.</p>
            </a>
            
            <a href="{{ route('lembaga.index') }}" 
               class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-green-50 transition duration-200">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Lembaga Desa</h3>
                <p class="text-gray-600 text-sm">Kelola data lembaga yang berperan dalam desa.</p>
            </a>

            <a href="{{ route('perangkat-desa.index') }}" 
               class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-yellow-50 transition duration-200">
                <h3 class="font-semibold text-lg mb-2 text-gray-800">Perangkat Desa</h3>
                <p class="text-gray-600 text-sm">Atur struktur organisasi perangkat desa.</p>
            </a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-100 p-4 rounded-lg text-center">
                <h3 class="text-lg font-semibold">Total Warga</h3>
                <p class="text-3xl font-bold text-blue-600">250</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg text-center">
                <h3 class="text-lg font-semibold">Total Lembaga</h3>
                <p class="text-3xl font-bold text-green-600">5</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg text-center">
                <h3 class="text-lg font-semibold">Total Perangkat</h3>
                <p class="text-3xl font-bold text-yellow-600">10</p>
            </div>
        </div>

        <!-- Gender Statistics -->
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Statistik Berdasarkan Jenis Kelamin</h3>
            <div class="mb-2 flex justify-between">
                <span class="text-blue-400 font-semibold">Laki-laki</span>
                <span>56%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                <div class="bg-blue-500 h-3 rounded-full" style="width: 56%;"></div>
            </div>
            <div class="mb-2 flex justify-between">
                <span class="text-pink-500 font-semibold">Perempuan</span>
                <span>44%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-pink-400 h-3 rounded-full" style="width: 44%;"></div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Pie Chart -->
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-center">Statistik Warga Berdasarkan Jenis Kelamin</h3>
            <div class="flex justify-center">
                <div style="width: 300px; height: 300px;">
                    <canvas id="wargaChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Simple Gender Stats -->
        <div class="bg-white p-6 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold mb-4">Statistik Warga</h3>
            <div class="flex justify-around">
                <div>
                    <p class="text-blue-500 font-bold text-3xl">56%</p>
                    <p class="text-gray-600">Laki-laki</p>
                </div>
                <div>
                    <p class="text-pink-500 font-bold text-3xl">44%</p>
                    <p class="text-gray-600">Perempuan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Table -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 w-full">
        <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Keterangan Media</h3>
        <table class="w-full text-sm text-gray-700 border-collapse">
            <thead class="bg-blue-100 border-b">
                <tr>
                    <th class="text-left font-semibold py-3 px-4 border-r border-gray-300 w-1/2">Keterangan</th>
                    <th class="text-left font-semibold py-3 px-4 w-1/2">Media</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="py-3 px-4 border-r border-gray-200">Master RW</td>
                    <td class="py-3 px-4 text-gray-500 italic">Opsional dipakai untuk referensi.</td>
                </tr>
                <tr class="border-b">
                    <td class="py-3 px-4 border-r border-gray-200">Master RT</td>
                    <td class="py-3 px-4 text-gray-500 italic">Di bawah RW.</td>
                </tr>
                <tr class="border-b">
                    <td class="py-3 px-4 border-r border-gray-200">Foto</td>
                    <td class="py-3 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-mono">
                            'perangkat_desa'
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="py-3 px-4 border-r border-gray-200">Logo</td>
                    <td class="py-3 px-4">
                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-mono">
                            'lembaga_desa'
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('wargaChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [140, 110],
                    backgroundColor: ['#3B82F6', '#F472B6'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${percentage}% (${value})`;
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection