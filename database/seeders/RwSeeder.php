<?php

namespace Database\Seeders;

use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check untuk MySQL
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Rw::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Cek apakah sudah ada data warga
        if (Warga::count() < 50) {
            $this->command->warn('Membuat data warga terlebih dahulu...');
            $this->createWargaData();
        }

        // Ambil semua warga untuk dijadikan ketua RW
        $wargas = Warga::pluck('warga_id')->toArray();
        
        $rws = [];
        $usedWargaIds = []; // Untuk melacak warga yang sudah jadi ketua RW

        // Generate 50 data RW
        for ($i = 1; $i <= 50; $i++) {
            // Pilih warga yang belum jadi ketua RW
            $availableWargas = array_diff($wargas, $usedWargaIds);
            
            // Jika sudah habis, ulangi dari awal
            if (empty($availableWargas)) {
                $availableWargas = $wargas;
            }
            
            $ketuaRwWargaId = $availableWargas[array_rand($availableWargas)];
            $usedWargaIds[] = $ketuaRwWargaId;

            $rws[] = [
                'nomor_rw' => str_pad($i, 3, '0', STR_PAD_LEFT),
                'ketua_rw_warga_id' => $ketuaRwWargaId,
                'keterangan' => $this->generateKeteranganRW($i),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data RW
        Rw::insert($rws);

        $this->command->info('✅ Data RW berhasil ditambahkan: ' . count($rws) . ' data');
    }

    /**
     * Generate keterangan untuk RW
     */
    private function generateKeteranganRW(int $nomor): string
    {
        $keterangan = [
            'Wilayah RW ' . $nomor . ' mencakup beberapa perumahan',
            'RW ' . $nomor . ' terletak di daerah perkotaan',
            'RW ' . $nomor . ' merupakan wilayah padat penduduk',
            'RW ' . $nomor . ' memiliki fasilitas umum yang lengkap',
            'RW ' . $nomor . ' dekat dengan pusat kota',
            'RW ' . $nomor . ' berada di kawasan perumahan elit',
            'RW ' . $nomor . ' wilayah perbatasan kelurahan',
            'RW ' . $nomor . ' memiliki banyak UKM',
            'RW ' . $nomor . ' aktif dalam kegiatan sosial',
            'RW ' . $nomor . ' telah mendapatkan penghargaan lingkungan',
        ];
        
        return $keterangan[array_rand($keterangan)];
    }

    /**
     * Membuat data warga jika belum ada
     */
    private function createWargaData(): void
    {
        $wargaData = [];
        
        for ($i = 1; $i <= 100; $i++) {
            $jenisKelamin = rand(0, 1) ? 'L' : 'P';
            $wargaData[] = [
                'nik' => '327101' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'nama' => $this->generateNama($jenisKelamin),
                'tempat_lahir' => $this->generateKota(),
                'tanggal_lahir' => $this->generateTanggalLahir(),
                'jenis_kelamin' => $jenisKelamin,
                'alamat' => $this->generateAlamat($i),
                'agama' => $this->generateAgama(),
                'status_perkawinan' => $this->generateStatusPerkawinan(),
                'pekerjaan' => $this->generatePekerjaan(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('warga')->insert($wargaData);
        $this->command->info('📋 Data Warga berhasil dibuat: ' . count($wargaData) . ' data');
    }

    /**
     * Generate nama berdasarkan jenis kelamin
     */
    private function generateNama(string $jenisKelamin): string
    {
        $depanL = ['Ahmad', 'Budi', 'Candra', 'Dedi', 'Eko', 'Fajar', 'Gunawan', 'Hadi', 'Irfan', 'Joko', 
                  'Kurniawan', 'Lukman', 'Mulyadi', 'Nugroho', 'Oki', 'Prasetyo', 'Rahmat', 'Surya', 'Teguh', 'Wahyu'];
        
        $depanP = ['Siti', 'Rina', 'Dewi', 'Lisa', 'Maya', 'Nina', 'Putri', 'Rani', 'Sari', 'Tina',
                  'Wulan', 'Yuni', 'Ani', 'Bunga', 'Citra', 'Diana', 'Eva', 'Fitri', 'Gita', 'Hani'];
        
        $tengah = ['', ' ', ' Setiawan', ' Prasetyo', ' Kurniawan', ' Santoso', ' Wijaya', ' Hidayat', ' Purnomo'];
        
        $belakang = ['Sutrisno', 'Wibowo', 'Saputra', 'Nugraha', 'Pratama', 'Maulana', 'Firmansyah', 'Siregar', 'Hakim', 'Susanto'];

        if ($jenisKelamin === 'L') {
            $depan = $depanL[array_rand($depanL)];
        } else {
            $depan = $depanP[array_rand($depanP)];
        }
        
        return $depan . $tengah[array_rand($tengah)] . ' ' . $belakang[array_rand($belakang)];
    }

    /**
     * Generate kota random
     */
    private function generateKota(): string
    {
        $kota = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Malang', 'Medan', 'Palembang', 
                'Makassar', 'Balikpapan', 'Banjarmasin', 'Padang', 'Denpasar', 'Manado', 'Pekanbaru'];
        
        return $kota[array_rand($kota)];
    }

    /**
     * Generate tanggal lahir random (usia 25-60 tahun)
     */
    private function generateTanggalLahir(): string
    {
        $usia = rand(25, 60);
        $tahun = date('Y') - $usia;
        $bulan = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
        $hari = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);
        
        return $tahun . '-' . $bulan . '-' . $hari;
    }

    /**
     * Generate alamat
     */
    private function generateAlamat(int $i): string
    {
        $jalan = ['Jl. Melati', 'Jl. Anggrek', 'Jl. Mawar', 'Jl. Kenanga', 'Jl. Flamboyan'];
        $nomor = rand(1, 100);
        
        return $jalan[array_rand($jalan)] . ' No.' . $nomor;
    }

    /**
     * Generate agama random
     */
    private function generateAgama(): string
    {
        $agama = ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        
        return $agama[array_rand($agama)];
    }

    /**
     * Generate status perkawinan random
     */
    private function generateStatusPerkawinan(): string
    {
        $status = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
        
        return $status[array_rand($status)];
    }

    /**
     * Generate pekerjaan random
     */
    private function generatePekerjaan(): string
    {
        $pekerjaan = ['Wiraswasta', 'PNS', 'Karyawan Swasta', 'Petani', 'Pedagang', 'Guru', 'Dokter', 'Pengusaha',
                     'Buruh', 'Nelayan', 'Pensiunan', 'Ibu Rumah Tangga', 'Pelajar/Mahasiswa'];
        
        return $pekerjaan[array_rand($pekerjaan)];
    }
}