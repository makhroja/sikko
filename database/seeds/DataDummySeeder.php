<?php

use App\Models\Faktur;
use App\Models\Kamar;
use App\Models\Keluhan;
use App\Models\Pengeluaran;
use App\User;
use App\Models\Penghuni;
use App\Models\Tagihan;
use Carbon\Carbon;
use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

class DataDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('kamars')->insert([
                'nama_kost' => $faker->firstName(),
                'no_kamar' => $i,
                'lokasi' => $faker->boolean ? 1 : 2,
                'harga' => $faker->randomNumber(6),
                'fasilitas' => $faker->sentence(3),
                'status' => $faker->boolean ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Pemilik
        User::create([
            'nama' => 'Pemilik',
            'tgl_lahir' => '1995-11-12',
            'alamat' => 'Jl. Contoh Alamat',
            'jk' => 'Laki-laki',
            'no_hp' => '081234567890',
            'role' => 'Pemilik',
            'email' => 'pemilik@mail.com',
            'email_verified_at' => now(),
            'is_active' => 1,
            'password' => bcrypt('123'),
        ]);

        $user = User::create([
            'nama' => 'Penghuni 1',
            'tgl_lahir' => '1990-12-01',
            'alamat' => 'Jl. Contoh Alamat',
            'jk' => 'Laki-laki',
            'no_hp' => '081234567890',
            'role' => 'Penghuni',
            'email' => 'penghuni@mail.com',
            'email_verified_at' => now(),
            'is_active' => 1,
            'password' => bcrypt('123'),
        ]);

        $penghuni = Penghuni::create([
            'user_id' => $user->id,
            'kamar_id' => 1,
            'tgl_masuk' => Carbon::now()->subMonth(1),
            'status' => 1,
        ]);

        $user = User::create([
            'nama' => 'Penghuni 2',
            'tgl_lahir' => '1992-02-04',
            'alamat' => 'Jl. Contoh Alamat',
            'jk' => 'Laki-laki',
            'no_hp' => '081234567890',
            'role' => 'Penghuni',
            'email' => 'penghuni2@mail.com',
            'email_verified_at' => now(),
            'is_active' => 1,
            'password' => bcrypt('123'),
        ]);

        $penghuni = Penghuni::create([
            'user_id' => $user->id,
            'kamar_id' => 2,
            'tgl_masuk' => Carbon::now()->subMonth(1),
            'status' => 1,
        ]);

        $user = User::create([
            'nama' => 'Penghuni 3',
            'tgl_lahir' => '1992-03-01',
            'alamat' => 'Jl. Contoh Alamat',
            'jk' => 'Laki-laki',
            'no_hp' => '081234567890',
            'role' => 'Penghuni',
            'email' => 'penghuni3@mail.com',
            'email_verified_at' => now(),
            'is_active' => 1,
            'password' => bcrypt('123'),
        ]);

        $penghuni = Penghuni::create([
            'user_id' => $user->id,
            'kamar_id' => 3,
            'tgl_masuk' => Carbon::now()->subMonth(1),
            'status' => 1,
        ]);

        $keluhan = Keluhan::create([
            'user_id' => 2,
            'keluhan' => 'wc mampet',
            'tgl_keluhan' => Carbon::now()->subMonth(1),
            'status' => 0,
        ]);

        $tagihan = Tagihan::create([
            'user_id' => 2,
            'no_tagihan' => generateNoTagihan(),
            'tgl_tagihan' => '2023-05-03',
            'bulan' => 4,
            'tahun' => 2023,
            'total_tagihan' => 350000,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tagihan = Tagihan::create([
            'user_id' => 3,
            'no_tagihan' => generateNoTagihan(),
            'tgl_tagihan' => '2023-05-03',
            'bulan' => 5,
            'tahun' => 2023,
            'total_tagihan' => 350000,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $faktur = Faktur::create([
            'user_id' => 2,
            'tagihan_id' => 1,
            'no_faktur' => generateNoFaktur(),
            'total_bayar' => 350000,
            'metode_pembayaran' => 'transfer ke rekening pemilik',
            'bukti_pembayaran' => 'contoh.jpeg',
            'tgl_bayar' => Carbon::now()->subMonth(1),
            'status' => 1,
        ]);

        $pengeluaran = Pengeluaran::create([
            'tgl_pengeluaran' => Carbon::now()->subMonth(1),
            'total' => 350000,
            'keperluan' => 'Bayar listrik',
            'bukti_pengeluaran' => 'contoh.jpeg',
        ]);
    }
}
