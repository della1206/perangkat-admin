<?php

namespace Database\Seeders;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check untuk MySQL
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Rt::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil semua RW
        $rws = Rw::all();
        
        // Jika belum ada RW, jalankan seeder RW terlebih dahulu
        if ($rws->isEmpty()) {
            $this->command->warn('Data RW tidak ditemukan. Menjalankan RwSeeder...');
            $this->call(RwSeeder::class);
            $rws = Rw::all();
        }

        // Ambil semua warga
        $wargas = Warga::pluck('warga_id')->toArray();

        $rts = [];
        $rtCounter = 1;
        $usedWargaIds = []; // Untuk melacak warga yang sudah jadi ketua RT

        // Generate 50 data RT (1-4 RT per RW)
        foreach ($rws as $rw) {
            // Setiap RW memiliki 1-4 RT
            $jumlahRt = rand(1, 4);
            
            for ($i = 1; $i <= $jumlahRt; $i++) {
                // Jika sudah 50 RT, berhenti
                if ($rtCounter > 50) {
                    break 2;
                }

                // Pilih warga yang belum jadi ketua RT dan bukan ketua RW
                $availableWargas = array_diff($wargas, $usedWargaIds, [$rw->ketua_rw_warga_id]);
                
                // Jika sudah habis, cari warga yang bukan ketua RW saja
                if (empty($availableWargas)) {
                    $availableWargas = array_diff($wargas, [$rw->ketua_rw_warga_id]);
                }
                
                // Jika masih kosong, skip (null)
                $ketuaRtWargaId = !empty($availableWargas) ? $availableWargas[array_rand($availableWargas)] : null;
                
                if ($ketuaRtWargaId) {
                    $usedWargaIds[] = $ketuaRtWargaId;
                }

                $rts[] = [
                    'rw_id' => $rw->rw_id,
                    'nomor_rt' => str_pad($i, 2, '0', STR_PAD_LEFT),
                    'ketua_rt_warga_id' => $ketuaRtWargaId,
                    'keterangan' => $this->generateKeteranganRT($i, $rw->nomor_rw),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                $rtCounter++;
            }
        }

        // Jika belum mencapai 50 data, tambahkan lagi
        if (count($rts) < 50) {
            $remaining = 50 - count($rts);
            $rwIds = $rws->pluck('rw_id')->toArray();
            
            for ($i = 1; $i <= $remaining; $i++) {
                $rwId = $rwIds[array_rand($rwIds)];
                $rw = Rw::find($rwId);
                
                // Cari nomor RT yang belum digunakan di RW ini
                $existingRts = array_filter($rts, function($rt) use ($rwId) {
                    return $rt['rw_id'] == $rwId;
                });
                
                $existingNumbers = array_column($existingRts, 'nomor_rt');
                $nomorRt = $this->generateNomorRt($existingNumbers);
                
                // Pilih warga yang belum jadi ketua RT dan bukan ketua RW
                $availableWargas = array_diff($wargas, $usedWargaIds, [$rw->ketua_rw_warga_id]);
                
                // Jika sudah habis, cari warga yang bukan ketua RW saja
                if (empty($availableWargas)) {
                    $availableWargas = array_diff($wargas, [$rw->ketua_rw_warga_id]);
                }
                
                $ketuaRtWargaId = !empty($availableWargas) ? $availableWargas[array_rand($availableWargas)] : null;
                
                if ($ketuaRtWargaId) {
                    $usedWargaIds[] = $ketuaRtWargaId;
                }

                $rts[] = [
                    'rw_id' => $rwId,
                    'nomor_rt' => $nomorRt,
                    'ketua_rt_warga_id' => $ketuaRtWargaId,
                    'keterangan' => $this->generateKeteranganRT($i, $rw->nomor_rw),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert data RT
        Rt::insert($rts);

        $this->command->info('✅ Data RT berhasil ditambahkan: ' . count($rts) . ' data');
    }

    /**
     * Generate nomor RT yang belum digunakan
     */
    private function generateNomorRt(array $existingNumbers): string
    {
        $nomor = 1;
        while (in_array(str_pad($nomor, 2, '0', STR_PAD_LEFT), $existingNumbers)) {
            $nomor++;
        }
        
        return str_pad($nomor, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Generate keterangan untuk RT
     */
    private function generateKeteranganRT(int $nomor, string $nomorRw): string
    {
        $keterangan = [
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Lingkungan yang asri dan nyaman',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Aktif dalam kegiatan gotong royong',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Berada di kawasan perumahan teratur',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Memiliki program kebersihan rutin',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Dekat dengan fasilitas pendidikan',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Wilayah dengan keamanan yang baik',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Komunitas yang harmonis',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Banyak kegiatan sosial',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Lingkungan ramah anak',
            'RT ' . $nomor . ' RW ' . $nomorRw . ' - Fasilitas olahraga tersedia',
        ];
        
        return $keterangan[array_rand($keterangan)];
        //tes
    }
}