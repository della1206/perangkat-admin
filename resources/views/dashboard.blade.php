@extends('layouts.app')

@section('content')
<div class="bg-gray-50 p-8 rounded-lg">
    <h2 class="text-2xl font-bold mb-2">Selamat Datang di Aplikasi Perangkat Desa 👋</h2>
    <p class="text-gray-600 mb-6">
        Gunakan menu di kiri untuk mengelola data warga, lembaga desa, dan perangkat desa.
    </p>

    {{-- Kartu utama --}}
     <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Kartu Data Warga -->
        <a href="{{ route('warga.index') }}" 
           class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-blue-50 transition duration-200">
            <h3 class="font-semibold text-lg mb-2 text-gray-800">Data Warga</h3>
            <p class="text-gray-600 text-sm">Lihat dan kelola data warga desa secara lengkap.</p>
        </a>
        <!-- Kartu Lembaga Desa -->
        <a href="{{ route('lembaga.index') }}" 
           class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-green-50 transition duration-200">
            <h3 class="font-semibold text-lg mb-2 text-gray-800">Lembaga Desa</h3>
            <p class="text-gray-600 text-sm">Kelola data lembaga yang berperan dalam desa.</p>
        </a>
        <!-- Kartu Perangkat Desa -->
        <a href="{{ route('perangkat.index') }}" 
           class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-yellow-50 transition duration-200">
            <h3 class="font-semibold text-lg mb-2 text-gray-800">Perangkat Desa</h3>
            <p class="text-gray-600 text-sm">Atur struktur organisasi perangkat desa.</p>
            </a>
            </div>
        </div>
    <div class="bg-white p-6 shadow rounded-lg text-center">
    <h3 class="text-lg font-semibold mb-4">Statistik Warga Berdasarkan Jenis Kelamin</h3>
    <div class="flex justify-around">
        <div>
            <p class="text-blue-200 font-bold text-3xl">56%</p>
            <p class="text-gray-600">Laki-laki</p>
        </div>
        <div>
            <p class="text-pink-10 font-bold text-3xl">44%</p>
            <p class="text-gray-20">Perempuan</p>
        </div>
    </div>
</div>

    {{-- Statistik singkat --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
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
    <div class="bg-white p-6 shadow rounded-lg">
    <h3 class="text-lg font-semibold mb-4">Statistik Jenis Kelamin Warga</h3>
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

{{-- Grafik --}}
<div class="bg-white p-6 shadow rounded-lg mt-6">
    <h3 class="text-lg font-semibold mb-4 text-center">Statistik Warga Berdasarkan Jenis Kelamin</h3>
    <div class="flex justify-center">
        <div style="width: 650px; height: 650px;">
            <canvas id="wargaChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('wargaChart');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Laki-laki', 'Perempuan'],
        datasets: [{
            data: [140, 110], // ← ganti sesuai data kamu
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
</script>
@endsection
