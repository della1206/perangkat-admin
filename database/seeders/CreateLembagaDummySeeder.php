<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateLembagaDummySeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $jumlahLembaga = 50;

        echo "Menambahkan $jumlahLembaga Lembaga Desa...\n";

        // Daftar nama lembaga desa yang umum di Indonesia
        $namaLembaga = [
            'Badan Permusyawaratan Desa (BPD)',
            'Pemberdayaan Kesejahteraan Keluarga (PKK)',
            'Karang Taruna',
            'Lembaga Pemberdayaan Masyarakat Desa (LPMD)',
            'Pos Pelayanan Terpadu (Posyandu)',
            'Kelompok Tani',
            'Kelompok Nelayan',
            'Koperasi Desa',
            'Lembaga Adat Desa',
            'Kelompok Sadar Wisata (Pokdarwis)',
            'Forum Komunikasi Pemuda Desa',
            'Kelompok Usaha Bersama (KUBE)',
            'Rukun Tetangga (RT)',
            'Rukun Warga (RW)',
            'Majelis Taklim',
            'Kelompok Pengajian',
            'Sanggar Seni Desa',
            'Tim Penggerak PKK',
            'Kelompok Perempuan',
            'Forum Anak Desa'
        ];

        // Daftar nama ketua (nama Indonesia)
        $namaKetua = [
            'Budi Santoso', 'Siti Rahayu', 'Agus Wijaya', 'Dewi Lestari', 'Joko Susilo',
            'Maya Indah', 'Rudi Hartono', 'Sri Wahyuni', 'Ahmad Fauzi', 'Rina Melati',
            'Eko Prasetyo', 'Linda Sari', 'Hendra Gunawan', 'Ani Wijayanti', 'Ferdy Setiawan',
            'Nur Hasanah', 'Dedi Kurniawan', 'Yulia Fitri', 'Tono Saputra', 'Rini Anggraeni'
        ];

        // Daftar deskripsi dalam bahasa Indonesia
        $deskripsiLembaga = [
            'Lembaga ini bertugas untuk meningkatkan kesejahteraan masyarakat desa melalui berbagai program pemberdayaan.',
            'Bertujuan untuk membangun kemandirian ekonomi warga desa melalui usaha bersama dan koperasi.',
            'Fokus pada pengembangan potensi pemuda desa dalam berbagai bidang seperti olahraga, seni, dan wirausaha.',
            'Melaksanakan program kesehatan ibu dan anak serta memberikan pelayanan kesehatan dasar.',
            'Mengembangkan sektor pertanian dengan penerapan teknologi tepat guna dan pemasaran hasil pertanian.',
            'Memajukan pariwisata desa dengan melestarikan budaya lokal dan mengembangkan destinasi wisata.',
            'Menjaga ketertiban dan keamanan lingkungan serta memfasilitasi komunikasi antar warga.',
            'Meningkatkan kualitas pendidikan agama melalui kegiatan pengajian dan kajian keislaman.',
            'Melestarikan kesenian tradisional desa dan mengembangkan kreativitas seni generasi muda.',
            'Memberdayakan perempuan desa melalui pelatihan keterampilan dan usaha ekonomi produktif.',
            'Melindungi hak-hak anak dan memberikan pendidikan karakter bagi generasi penerus desa.',
            'Memfasilitasi musyawarah untuk pengambilan keputusan penting dalam pembangunan desa.',
            'Mengelola sumber daya alam desa secara berkelanjutan untuk kesejahteraan bersama.',
            'Meningkatkan akses informasi dan teknologi bagi warga desa.',
            'Mengembangkan potensi ekonomi kreatif berbasis kearifan lokal.',
            'Melaksanakan program sosial untuk membantu warga kurang mampu.',
            'Memperkuat kelembagaan desa melalui peningkatan kapasitas pengurus.',
            'Mengkoordinasikan kegiatan pembangunan fisik dan non-fisik di desa.',
            'Meningkatkan partisipasi masyarakat dalam perencanaan pembangunan desa.',
            'Melestarikan adat istiadat dan nilai-nilai kearifan lokal.'
        ];

        // Insert data ke tabel lembaga_desa
        foreach (range(1, $jumlahLembaga) as $index) {
            DB::table('lembaga_desa')->insert([
                'nama_lembaga' => $faker->randomElement($namaLembaga) . ' ' . $faker->citySuffix(),
                'ketua' => $faker->optional(0.7)->randomElement($namaKetua), // 70% punya ketua
                'deskripsi' => $faker->randomElement($deskripsiLembaga),
                'kontak' => $this->generateNomorIndonesia($faker),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        echo "Seeder Lembaga Desa selesai. $jumlahLembaga lembaga telah ditambahkan.\n";
    }

    /**
     * Generate nomor telepon Indonesia yang realistis
     */
    private function generateNomorIndonesia($faker)
    {
        $prefixes = ['+62', '0'];
        $prefix = $faker->randomElement($prefixes);
        
        if ($prefix === '+62') {
            // Format +62 8xx xxxx xxxx
            $operator = $faker->randomElement(['812', '813', '814', '815', '816', '817', '818', '819', '852', '853', '857', '858', '859']);
            $number = $faker->numerify('#### ###');
            return "$prefix $operator $number";
        } else {
            // Format 08xx xxxx xxxx
            $operator = $faker->randomElement(['0812', '0813', '0814', '0815', '0816', '0817', '0818', '0819', '0852', '0853', '0857', '0858', '0859']);
            $number = $faker->numerify('#### ###');
            return "$operator $number";
        }
    }
}