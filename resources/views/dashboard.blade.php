@extends('layouts.admin.app')
<!-- tes -->
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
            Gunakan menu untuk mengelola data warga, lembaga desa, dan perangkat desa.
        </p>

        <!-- Main Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <a href="{{ route('warga.index') }}"
               class="block bg-white border border-gray-200 rounded-xl p-8 text-center shadow-lg hover:shadow-2xl hover:bg-blue-50 transition-all duration-300 group transform hover:-translate-y-2">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a5.5 5.5 0 01-5.5 5.5m0-11a5.5 5.5 0 015.5 5.5"/>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800 group-hover:text-blue-700">Data Warga</h3>
                <p class="text-gray-600 mb-4">Lihat dan kelola data warga desa secara lengkap.</p>
                <div class="mt-4">
                    <span class="inline-block bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                        {{ $totalWarga }} Data Tersedia
                    </span>
                </div>
            </a>

            <a href="{{ route('lembaga.index') }}"
               class="block bg-white border border-gray-200 rounded-xl p-8 text-center shadow-lg hover:shadow-2xl hover:bg-green-50 transition-all duration-300 group transform hover:-translate-y-2">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-green-200 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800 group-hover:text-green-700">Lembaga Desa</h3>
                <p class="text-gray-600 mb-4">Kelola data lembaga yang berperan dalam desa.</p>
                <div class="mt-4">
                    <span class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                        {{ $totalLembaga }} Lembaga Aktif
                    </span>
                </div>
            </a>

            <a href="{{ route('jabatan-lembaga.index') }}"
               class="block bg-white border border-gray-200 rounded-xl p-8 text-center shadow-lg hover:shadow-2xl hover:bg-yellow-50 transition-all duration-300 group transform hover:-translate-y-2">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-yellow-200 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-800 group-hover:text-yellow-700">Jabatan Desa</h3>
                <p class="text-gray-600 mb-4">Atur struktur jabatan Desa.</p>
                <div class="mt-4">
                    <span class="inline-block bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                        {{ $totalJabatan }} Jabatan Aktif
                    </span>
                </div>
            </a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300 group transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a5.5 5.5 0 01-5.5 5.5m0-11a5.5 5.5 0 015.5 5.5"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Total Warga</h3>
                <p class="text-5xl font-extrabold text-blue-600 mb-2">{{ $totalWarga }}</p>
                <p class="text-gray-600 font-medium">Orang Terdaftar</p>
            </div>
            
            <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300 group transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Total Lembaga</h3>
                <p class="text-5xl font-extrabold text-green-600 mb-2">{{ $totalLembaga }}</p>
                <p class="text-gray-600 font-medium">Lembaga Aktif</p>
            </div>
            
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-8 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300 group transform hover:-translate-y-1">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-all duration-300 shadow-md">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Total Jabatan</h3>
                <p class="text-5xl font-extrabold text-yellow-600 mb-2">{{ $totalJabatan }}</p>
                <p class="text-gray-600 font-medium">Anggota Aktif</p>
            </div>
        </div>

        <!-- Gender Statistics -->
        <div class="bg-white p-8 shadow-xl rounded-2xl border border-gray-200">
            <h3 class="text-2xl font-bold mb-8 text-gray-800 border-b pb-4">Statistik Jenis Kelamin Warga</h3>
            <div class="space-y-8">
                <div>
                    <div class="flex justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-5 h-5 bg-blue-500 rounded-full mr-3"></div>
                            <span class="text-gray-800 font-bold text-lg">Laki-laki</span>
                        </div>
                        <span class="font-bold text-xl text-blue-600">{{ $persentaseLaki }}% ({{ $wargaLakiLaki }} orang)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-6 shadow-inner">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-6 rounded-full flex items-center justify-end pr-4 shadow-lg" style="width: {{ $persentaseLaki }}%;">
                            <span class="text-white font-bold text-sm">{{ $persentaseLaki }}%</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-5 h-5 bg-pink-500 rounded-full mr-3"></div>
                            <span class="text-gray-800 font-bold text-lg">Perempuan</span>
                        </div>
                        <span class="font-bold text-xl text-pink-600">{{ $persentasePerempuan }}% ({{ $wargaPerempuan }} orang)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-6 shadow-inner">
                        <div class="bg-gradient-to-r from-pink-400 to-pink-500 h-6 rounded-full flex items-center justify-end pr-4 shadow-lg" style="width: {{ $persentasePerempuan }}%;">
                            <span class="text-white font-bold text-sm">{{ $persentasePerempuan }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- PERANGKAT DESA DALAM SECTION - GAMBAR BESAR -->
        <div class="mb-8 rounded-xl overflow-hidden shadow-2xl border border-gray-300">
            <div class="relative bg-gradient-to-r from-blue-50 to-green-50">
                <!-- Gambar Besar -->
                <div class="w-full">
                    <div class="flex flex-col lg:flex-row h-auto">
                        <!-- Bagian Gambar (Lebih Besar) -->
                        <div class="lg:w-7/12 xl:w-8/12 h-96 lg:h-auto">
                            <img src="{{ asset('assets/img/perangkat1.png') }}"
                                 alt="Perangkat Desa"
                                 class="w-full h-full object-cover transform hover:scale-105 transition duration-700">
                        </div>
                        
                        <!-- Bagian Konten -->
                        <div class="lg:w-5/12 xl:w-4/12 p-8 md:p-10 flex flex-col justify-center bg-gradient-to-r from-blue-50/90 to-blue-100/70 backdrop-blur-sm">
                            <div class="mb-6">
                                <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-bold mb-4 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    PERANGKAT DESA 
                                </div>
                            </div>
                            <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                                Perangkat Desa
                            </h3>
                            <p class="text-gray-800 mb-8 text-lg leading-relaxed">
                                Perangkat desa aktif melayani masyarakat dalam berbagai kegiatan pembangunan desa. Mereka berperan penting dalam pengelolaan administrasi, pembangunan, dan pelayanan kepada masyarakat.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('perangkat-desa.index') }}"
                                   class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span class="font-semibold text-lg">Lihat Perangkat Desa</span>
                                </a>
                                <a href="{{ route('perangkat-desa.create') }}"
                                   class="inline-flex items-center justify-center border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-4 rounded-lg transition-all duration-300">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    <span class="font-semibold text-lg">Tambah Baru</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Chart Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Pie Chart -->
        <div class="bg-white p-8 shadow-xl rounded-2xl border border-gray-200">
            <h3 class="text-2xl font-bold mb-8 text-center text-gray-800">Distribusi Jenis Kelamin Warga</h3>
            <div class="flex flex-col items-center">
                <div style="width: 320px; height: 320px;" class="mb-8">
                    <canvas id="wargaChart"></canvas>
                </div>
                <div class="grid grid-cols-2 gap-6 w-full max-w-md">
                    <div class="bg-blue-50 p-6 rounded-xl text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <p class="text-blue-600 font-bold text-4xl mb-2">{{ $persentaseLaki }}%</p>
                        <p class="text-gray-700 font-bold text-lg">Laki-laki</p>
                        <p class="text-gray-500">{{ $wargaLakiLaki }} orang</p>
                    </div>
                    <div class="bg-pink-50 p-6 rounded-xl text-center">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a4 4 0 100-8 4 4 0 000 8zm0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <p class="text-pink-600 font-bold text-4xl mb-2">{{ $persentasePerempuan }}%</p>
                        <p class="text-gray-700 font-bold text-lg">Perempuan</p>
                        <p class="text-gray-500">{{ $wargaPerempuan }} orang</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 shadow-xl rounded-2xl border border-blue-100">
            <h3 class="text-2xl font-bold mb-6 text-gray-800">Informasi Media</h3>
            <div class="space-y-6">
                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-xl border border-gray-200">
                    <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 6a2 2 0 100 4 2 2 0 000-4z" clip-rule="evenodd"/>
                        </svg>
                        Keterangan Media
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700">Foto Perangkat Desa</span>
                            <code class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm font-mono border border-blue-200">'perangkat_desa'</code>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700">Logo Lembaga Desa</span>
                            <code class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm font-mono border border-green-200">'lembaga_desa'</code>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-xl border border-gray-200">
                    <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        Struktur Wilayah
                    </h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700">Master RW</span>
                            <span class="text-gray-600">Opsional </span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700">Master RT</span>
                            <span class="text-gray-600">Di bawah RW</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tim Pengembang Section -->
    <div class="bg-gradient-to-r from-blue-50 to-gray-50 border border-gray-200 rounded-2xl shadow-xl p-8 mb-8">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Tim Pengembang Website</h3>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Berdedikasi untuk kemajuan desa melalui teknologi yang inovatif dan solusi digital yang tepat guna
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Pengembang 1 -->
            <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-8 lg:space-y-0 lg:space-x-8">
                    <div class="flex-shrink-0 relative">
                        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-blue-100 shadow-xl">
                            <img src="{{ asset('assets/img/vaghsv.jpg') }}"
                                 alt="Della Marcelina"
                                 class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full p-3 shadow-xl">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow text-center lg:text-left">
                        <h4 class="font-bold text-2xl text-gray-900 mb-2">Della Marcelina Br Sembiring</h4>
                        <p class="text-blue-600 font-bold text-lg mb-4">Admin</p>

                        <div class="mb-6">
                            <div class="inline-flex items-center bg-blue-50 text-blue-700 px-4 py-2 rounded-full text-sm font-bold mb-3">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                </svg>
                                Sistem Informasi| NIM: 2457301032
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-6">
                            <p class="text-gray-700 mb-4 font-bold">Hubungi Saya:</p>
                            <div class="flex justify-center lg:justify-start space-x-4">
                                <a href="https://linkedin.com" target="_blank"
                                   class="social-icon bg-blue-100 text-blue-600 p-3 rounded-full hover:bg-blue-200 hover:text-blue-800 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                                <a href="https://github.com" target="_blank"
                                   class="social-icon bg-gray-100 text-gray-800 p-3 rounded-full hover:bg-gray-200 hover:text-black transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </a>
                               <a href="https://www.instagram.com/dellamrcl_?igsh=MWYzeW9qOTc5ZnlyOA=="
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="social-icon bg-gradient-to-r from-pink-500 to-purple-600 text-white p-3 rounded-full hover:from-pink-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengembang 2 -->
            <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-8 lg:space-y-0 lg:space-x-8">
                    <div class="flex-shrink-0 relative">
                        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-green-100 shadow-xl">
                            <img src="{{ asset('assets/img/alyah.jpg') }}"
                                 alt="Alyah Najwa Restu Islami"
                                 class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full p-3 shadow-xl">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow text-center lg:text-left">
                        <h4 class="font-bold text-2xl text-gray-900 mb-2">Alyah Najwa Restu Islami</h4>
                        <p class="text-green-600 font-bold text-lg mb-4">Guest</p>

                        <div class="mb-6">
                            <div class="inline-flex items-center bg-green-50 text-green-700 px-4 py-2 rounded-full text-sm font-bold mb-3">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                </svg>
                                Sistem Informasi | NIM: 2457301012 
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-6">
                           <p class="text-gray-700 mb-4 font-bold">Hubungi Saya:</p>
                            <div class="flex justify-center lg:justify-start space-x-4">
                                <a href="https://linkedin.com" target="_blank"
                                   class="social-icon bg-blue-100 text-blue-600 p-3 rounded-full hover:bg-blue-200 hover:text-blue-800 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                                <a href="https://github.com/alyahh28" target="_blank"
                                   class="social-icon bg-gray-100 text-gray-800 p-3 rounded-full hover:bg-gray-200 hover:text-black transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </a>
                               <a href="https://www.instagram.com/dellamrcl_?igsh=MWYzeW9qOTc5ZnlyOA=="
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="social-icon bg-gradient-to-r from-pink-500 to-purple-600 text-white p-3 rounded-full hover:from-pink-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-110 hover:shadow-lg">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Teknologi yang Digunakan -->
        <div class="mt-8 p-8 bg-white rounded-2xl border border-gray-200 shadow-lg">
            <div class="flex items-start space-x-6">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-grow">
                    <h4 class="font-bold text-2xl text-gray-900 mb-4">Teknologi yang Digunakan</h4>
                    <p class="text-gray-700 mb-6 text-lg leading-relaxed">
                        Perangkat Desa dikembangkan dengan teknologi modern untuk memastikan performa optimal, keamanan data, dan pengalaman pengguna yang baik.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            Laravel 10
                        </span>
                        <span class="px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            Tailwind CSS
                        </span>
                        <span class="px-4 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            JavaScript ES6+
                        </span>
                        <span class="px-4 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            MySQL 8.0
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart.js Configuration
    const ctx = document.getElementById('wargaChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $wargaLakiLaki }}, {{ $wargaPerempuan }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(244, 114, 182, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(244, 114, 182, 1)'
                    ],
                    borderWidth: 3,
                    hoverBackgroundColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(244, 114, 182, 1)'
                    ]
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
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#1f2937',
                        bodyColor: '#4b5563',
                        borderColor: '#e5e7eb',
                        borderWidth: 1,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${percentage}% (${value} orang)`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    }

    // Add hover effects to social icons
    const socialIcons = document.querySelectorAll('.social-icon');
    socialIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.15)';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Add animation to cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // Observe cards for animation
    document.querySelectorAll('.bg-white').forEach(card => {
        observer.observe(card);
    });
});
</script>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 5px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #3B82F6, #1D4ED8);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #2563EB, #1E40AF);
}
</style>
@endsection