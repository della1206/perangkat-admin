<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CreateUserDummySeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $numberOfUsers = 100;

        echo "Menambahkan $numberOfUsers User...\n";

        // Insert data ke tabel users
        foreach (range(1, $numberOfUsers) as $index) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $email = strtolower($firstName . '.' . $lastName . '@' . $faker->freeEmailDomain);
            
            // Pastikan email unik
            $email = $this->makeUniqueEmail($email, $index);

            DB::table('users')->insert([
                'name' => $firstName . ' ' . $lastName,
                'email' => $email,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Progress indicator
            if ($index % 10 === 0) {
                echo "Progress: $index/$numberOfUsers\n";
            }
        }
        
        echo "Seeder User selesai. Semua user menggunakan password: password123\n";
    }

    /**
     * Membuat email unik dengan menambahkan angka jika diperlukan
     */
    private function makeUniqueEmail($email, $index)
    {
        $existingEmail = DB::table('users')->where('email', $email)->exists();
        
        if ($existingEmail) {
            $emailParts = explode('@', $email);
            $email = $emailParts[0] . $index . '@' . $emailParts[1];
        }
        
        return $email;
    }
}