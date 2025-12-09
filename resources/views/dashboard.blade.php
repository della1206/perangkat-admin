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

        <!-- Slideshow Perangkat Desa -->
        <div class="mb-8 rounded-lg overflow-hidden shadow-lg border border-gray-200">
            <div class="relative h-64 md:h-80 bg-gradient-to-r from-blue-50 to-green-50">
                <!-- Slide 1: Perangkat Desa dalam Aksi -->
                <div class="absolute inset-0 slide active opacity-100 transition-opacity duration-500">
                    <div class="flex flex-col md:flex-row h-full">
                        <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-center bg-gradient-to-r from-blue-50/80 to-blue-100/50">
                            <div class="mb-4">
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    PERANGKAT DESA
                                </div>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Perangkat Desa dalam Aksi</h3>
                            <p class="text-gray-700 mb-6 text-lg">Perangkat desa aktif melayani masyarakat dalam berbagai kegiatan pembangunan desa.</p>
                            <div class="flex space-x-4">
                                <a href="{{ route('perangkat-desa.index') }}"
                                   class="inline-flex items-center bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Lihat Perangkat Desa
                                </a>
                                <a href="{{ route('perangkat-desa.create') }}"
                                   class="inline-flex items-center border border-blue-600 text-blue-600 px-5 py-3 rounded-lg hover:bg-blue-50 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Baru
                                </a>
                            </div>
                        </div>
                        <div class="md:w-1/2 h-full overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                 alt="Perangkat Desa dalam Aksi"
                                 class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Lembaga Desa -->
                <div class="absolute inset-0 slide opacity-0 transition-opacity duration-500">
                    <div class="flex flex-col md:flex-row h-full">
                        <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-center bg-gradient-to-r from-green-50/80 to-green-100/50">
                            <div class="mb-4">
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-semibold mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4z" clip-rule="evenodd"/>
                                    </svg>
                                    LEMBAGA DESA
                                </div>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Lembaga Desa Berperan Aktif</h3>
                            <p class="text-gray-700 mb-6 text-lg">Berbagai lembaga desa bekerja sama membangun desa yang mandiri dan sejahtera.</p>
                            <div class="flex space-x-4">
                                <a href="{{ route('lembaga.index') }}"
                                   class="inline-flex items-center bg-green-600 text-white px-5 py-3 rounded-lg hover:bg-green-700 transition shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Lihat Lembaga Desa
                                </a>
                                <a href="{{ route('lembaga.create') }}"
                                   class="inline-flex items-center border border-green-600 text-green-600 px-5 py-3 rounded-lg hover:bg-green-50 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Baru
                                </a>
                            </div>
                        </div>
                        <div class="md:w-1/2 h-full overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                 alt="Musyawarah Desa"
                                 class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Data Warga -->
                <div class="absolute inset-0 slide opacity-0 transition-opacity duration-500">
                    <div class="flex flex-col md:flex-row h-full">
                        <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-center bg-gradient-to-r from-yellow-50/80 to-yellow-100/50">
                            <div class="mb-4">
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-sm font-semibold mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    DATA WARGA
                                </div>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Data Warga Terkelola dengan Baik</h3>
                            <p class="text-gray-700 mb-6 text-lg">Kelola data warga desa secara digital untuk pelayanan yang lebih cepat dan akurat.</p>
                            <div class="flex space-x-4">
                                <a href="{{ route('warga.index') }}"
                                   class="inline-flex items-center bg-yellow-600 text-white px-5 py-3 rounded-lg hover:bg-yellow-700 transition shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a5.5 5.5 0 01-5.5 5.5m0-11a5.5 5.5 0 015.5 5.5"/>
                                    </svg>
                                    Lihat Data Warga
                                </a>
                                <a href="{{ route('warga.create') }}"
                                   class="inline-flex items-center border border-yellow-600 text-yellow-600 px-5 py-3 rounded-lg hover:bg-yellow-50 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Baru
                                </a>
                            </div>
                        </div>
                        <div class="md:w-1/2 h-full overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1551135049-8a33b2fb2f5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                 alt="Pelayanan Masyarakat"
                                 class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>

                <!-- Slide Navigation -->
                <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 p-3 rounded-full hover:bg-white transition shadow-lg prev-slide group">
                    <svg class="w-6 h-6 text-gray-800 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 p-3 rounded-full hover:bg-white transition shadow-lg next-slide group">
                    <svg class="w-6 h-6 text-gray-800 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Slide Indicators -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3">
                    <button class="slide-indicator w-3 h-3 rounded-full bg-white/80 hover:bg-white transition active transform scale-125"></button>
                    <button class="slide-indicator w-3 h-3 rounded-full bg-white/50 hover:bg-white transition"></button>
                    <button class="slide-indicator w-3 h-3 rounded-full bg-white/50 hover:bg-white transition"></button>
                </div>
            </div>
        </div>

        <!-- Main Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('warga.index') }}"
               class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-blue-50 transition duration-200 group">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a5.5 5.5 0 01-5.5 5.5m0-11a5.5 5.5 0 015.5 5.5"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2 text-gray-800 group-hover:text-blue-700">Data Warga</h3>
                <p class="text-gray-600 text-sm">Lihat dan kelola data warga desa secara lengkap.</p>
            </a>

            <a href="{{ route('lembaga.index') }}"
               class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-green-50 transition duration-200 group">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2 text-gray-800 group-hover:text-green-700">Lembaga Desa</h3>
                <p class="text-gray-600 text-sm">Kelola data lembaga yang berperan dalam desa.</p>
            </a>

            <a href="{{ route('perangkat-desa.index') }}"
               class="block bg-white border border-gray-200 rounded-lg p-6 text-center shadow hover:shadow-lg hover:bg-yellow-50 transition duration-200 group">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-200 transition">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2 text-gray-800 group-hover:text-yellow-700">Perangkat Desa</h3>
                <p class="text-gray-600 text-sm">Atur struktur organisasi perangkat desa.</p>
            </a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-100 p-6 rounded-lg text-center shadow-sm hover:shadow transition group">
                <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-300 transition">
                    <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a5.5 5.5 0 01-5.5 5.5m0-11a5.5 5.5 0 015.5 5.5"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700">Total Warga</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">250</p>
                <p class="text-sm text-gray-500 mt-1">Orang</p>
            </div>
            <div class="bg-green-100 p-6 rounded-lg text-center shadow-sm hover:shadow transition group">
                <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-green-300 transition">
                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700">Total Lembaga</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">5</p>
                <p class="text-sm text-gray-500 mt-1">Lembaga</p>
            </div>
            <div class="bg-yellow-100 p-6 rounded-lg text-center shadow-sm hover:shadow transition group">
                <div class="w-12 h-12 bg-yellow-200 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-yellow-300 transition">
                    <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700">Total Perangkat</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">10</p>
                <p class="text-sm text-gray-500 mt-1">Orang</p>
            </div>
        </div>

        <!-- Gender Statistics -->
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold mb-6 text-gray-700">Statistik Berdasarkan Jenis Kelamin</h3>
            <div class="mb-4">
                <div class="flex justify-between mb-2">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-gray-700 font-medium">Laki-laki</span>
                    </div>
                    <span class="font-semibold">56% (140 orang)</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-500 h-3 rounded-full" style="width: 56%;"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-2">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-pink-500 rounded-full mr-2"></div>
                        <span class="text-gray-700 font-medium">Perempuan</span>
                    </div>
                    <span class="font-semibold">44% (110 orang)</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-pink-400 h-3 rounded-full" style="width: 44%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Pie Chart -->
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-center text-gray-700">Statistik Warga Berdasarkan Jenis Kelamin</h3>
            <div class="flex justify-center">
                <div style="width: 300px; height: 300px;">
                    <canvas id="wargaChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Simple Gender Stats -->
        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="text-lg font-semibold mb-6 text-center text-gray-700">Distribusi Jenis Kelamin</h3>
            <div class="flex justify-around">
                <div class="text-center">
                    <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <p class="text-blue-600 font-bold text-3xl mb-1">56%</p>
                    <p class="text-gray-600 font-medium">Laki-laki</p>
                    <p class="text-sm text-gray-500">140 orang</p>
                </div>
                <div class="text-center">
                    <div class="w-24 h-24 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a4 4 0 100-8 4 4 0 000 8zm0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <p class="text-pink-600 font-bold text-3xl mb-1">44%</p>
                    <p class="text-gray-600 font-medium">Perempuan</p>
                    <p class="text-sm text-gray-500">110 orang</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Table -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 w-full mb-8">
        <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Keterangan Media</h3>
        <table class="w-full text-sm text-gray-700 border-collapse">
            <thead class="bg-blue-100 border-b">
                <tr>
                    <th class="text-left font-semibold py-3 px-4 border-r border-gray-300 w-1/2">Keterangan</th>
                    <th class="text-left font-semibold py-3 px-4 w-1/2">Media</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 border-r border-gray-200 font-medium">Master RW</td>
                    <td class="py-3 px-4 text-gray-600">Opsional dipakai untuk referensi.</td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 border-r border-gray-200 font-medium">Master RT</td>
                    <td class="py-3 px-4 text-gray-600">Di bawah RW.</td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 border-r border-gray-200 font-medium">Foto</td>
                    <td class="py-3 px-4">
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm font-mono border border-red-200">
                            'perangkat_desa'
                        </span>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 border-r border-gray-200 font-medium">Logo</td>
                    <td class="py-3 px-4">
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm font-mono border border-red-200">
                            'lembaga_desa'
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Tim Pengembang Section -->
    <div class="bg-gradient-to-r from-blue-50 to-gray-50 border border-gray-200 rounded-lg shadow-sm p-8 w-full">
        <div class="flex items-center justify-center mb-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Tim Pengembang Aplikasi</h3>
                <p class="text-gray-600">Berdedikasi untuk kemajuan desa melalui teknologi</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Pengembang 1 -->
            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition duration-300">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
                    <div class="flex-shrink-0 relative">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-blue-100 shadow-lg">
                            <!-- Ganti dengan foto asli pengembang -->
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                 alt="Foto Pengembang"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-blue-600 text-white rounded-full p-2 shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow text-center md:text-left">
                        <h4 class="font-bold text-xl text-gray-800 mb-1">Muhammad Arif</h4>
                        <p class="text-blue-600 font-medium mb-2">Full Stack Developer</p>

                        <div class="mb-4">
                            <div class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm mb-2">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                </svg>
                                Teknik Informatika
                            </div>
                            <p class="text-gray-600">NIM: 123456789</p>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <p class="text-gray-700 mb-3 font-medium">Hubungi Saya:</p>
                            <div class="flex justify-center md:justify-start space-x-3">
                                <a href="https://linkedin.com/in/username" target="_blank"
                                   class="social-icon bg-blue-100 text-blue-600 p-2 rounded-full hover:bg-blue-200 hover:text-blue-800 transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                                <a href="https://github.com/username" target="_blank"
                                   class="social-icon bg-gray-100 text-gray-800 p-2 rounded-full hover:bg-gray-200 hover:text-black transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </a>
                                <a href="https://instagram.com/username" target="_blank"
                                   class="social-icon bg-pink-100 text-pink-600 p-2 rounded-full hover:bg-pink-200 hover:text-pink-800 transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                                <a href="mailto:arif@example.com"
                                   class="social-icon bg-red-100 text-red-600 p-2 rounded-full hover:bg-red-200 hover:text-red-800 transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12.713l-11.985-9.713h23.97l-11.985 9.713zm0 2.574l-12-9.725v15.438h24v-15.438l-12 9.725z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengembang 2 -->
            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition duration-300">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
                    <div class="flex-shrink-0 relative">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-green-100 shadow-lg">
                            <!-- Ganti dengan foto asli pengembang -->
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                 alt="Foto Pengembang"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-green-600 text-white rounded-full p-2 shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow text-center md:text-left">
                        <h4 class="font-bold text-xl text-gray-800 mb-1">Siti Aminah</h4>
                        <p class="text-green-600 font-medium mb-2">UI/UX Designer & Frontend Developer</p>

                        <div class="mb-4">
                            <div class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm mb-2">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                </svg>
                                Sistem Informasi
                            </div>
                            <p class="text-gray-600">NIM: 987654321</p>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <p class="text-gray-700 mb-3 font-medium">Hubungi Saya:</p>
                            <div class="flex justify-center md:justify-start space-x-3">
                                <a href="https://linkedin.com/in/username" target="_blank"
                                   class="social-icon bg-blue-100 text-blue-600 p-2 rounded-full hover:bg-blue-200 hover:text-blue-800 transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                                <a href="https://github.com/username" target="_blank"
                                   class="social-icon bg-gray-100 text-gray-800 p-2 rounded-full hover:bg-gray-200 hover:text-black transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/username" target="_blank"
                                   class="social-icon bg-blue-100 text-blue-400 p-2 rounded-full hover:bg-blue-200 hover:text-blue-600 transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a href="https://dribbble.com/username" target="_blank"
                                   class="social-icon bg-pink-100 text-pink-500 p-2 rounded-full hover:bg-pink-200 hover:text-pink-700 transition transform hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.628 0-12 5.373-12 12s5.372 12 12 12 12-5.373 12-12-5.372-12-12-12zm9.885 11.441c-2.575-.422-4.943-.445-7.103-.073-.244-.563-.497-1.125-.767-1.68 2.31-1 4.165-2.358 5.548-4.082 1.35 1.594 2.197 3.619 2.322 5.835zm-3.842-7.282c-1.205 1.554-2.868 2.783-4.986 3.68-1.016-1.861-2.178-3.676-3.488-5.438.779-.197 1.591-.314 2.431-.314 2.275 0 4.368.779 6.043 2.072zm-10.516-.993c1.331 1.742 2.511 3.538 3.537 5.381-2.43.715-5.331 1.082-8.684 1.105.692-2.835 2.601-5.193 5.147-6.486zm-5.44 8.834c3.642-.029 6.688-.427 9.243-1.194.221.382.427.749.62 1.104-3.328 1.22-6.158 3.322-8.56 6.283-1.56-3.972-2.108-8.375-1.303-12.193zM4.44 16.795c2.379-2.972 5.229-5.05 8.594-6.244.134.232.261.468.381.707-2.974 1.056-5.571 2.862-7.954 5.455-1.118 1.361-2.021 2.882-2.738 4.534.351-1.829 1.029-3.557 1.717-5.452zm10.867 6.044c-2.329-2.089-4.327-4.959-5.93-8.586 1.293-.204 2.651-.309 4.041-.309 1.521 0 2.979.131 4.354.372-1.132 2.755-1.962 5.158-2.465 7.523zm2.517-9.128c-1.37-.239-2.841-.371-4.417-.371-1.521 0-2.979.131-4.354.372 1.602 3.627 3.6 6.496 5.929 8.586.503-2.365 1.333-4.768 2.465-7.523z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Proyek -->
        <div class="mt-8 p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 mb-2">Tentang Aplikasi Perangkat Desa</h4>
                    <p class="text-gray-600">
                        Aplikasi Perangkat Desa dikembangkan sebagai solusi digital untuk administrasi desa yang lebih efektif, transparan, dan akuntabel.
                        Sistem ini membantu dalam pengelolaan data warga, lembaga desa, dan struktur organisasi perangkat desa secara terintegrasi.
                    </p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">Laravel</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Tailwind CSS</span>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">JavaScript</span>
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">MySQL</span>
                        <span class="px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-sm">Chart.js</span>
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
                    data: [140, 110],
                    backgroundColor: ['#3B82F6', '#F472B6'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const value = context.raw;
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${percentage}% (${value} orang)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Slideshow Functionality
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.slide-indicator');
    const prevBtn = document.querySelector('.prev-slide');
    const nextBtn = document.querySelector('.next-slide');

    let currentSlide = 0;
    const totalSlides = slides.length;

    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
            slide.classList.remove('opacity-100');
            slide.classList.add('opacity-0');
        });

        // Remove active class from all indicators
        indicators.forEach(indicator => {
            indicator.classList.remove('active');
            indicator.classList.remove('bg-white');
            indicator.classList.remove('transform', 'scale-125');
            indicator.classList.add('bg-white/50');
        });

        // Show current slide
        slides[index].classList.add('active', 'opacity-100');
        slides[index].classList.remove('opacity-0');

        // Update indicator
        indicators[index].classList.add('active', 'bg-white', 'transform', 'scale-125');
        indicators[index].classList.remove('bg-white/50');

        currentSlide = index;
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    // Event Listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', nextSlide);
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', prevSlide);
    }

    // Indicator click events
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            showSlide(index);
        });
    });

    // Auto slide
    let slideInterval = setInterval(nextSlide, 6000);

    // Pause on hover
    const slideshowContainer = document.querySelector('.relative.h-64');
    if (slideshowContainer) {
        slideshowContainer.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });

        slideshowContainer.addEventListener('mouseleave', () => {
            slideInterval = setInterval(nextSlide, 6000);
        });
    }

    // Initialize first slide
    showSlide(0);
});
</script>
@endsection
