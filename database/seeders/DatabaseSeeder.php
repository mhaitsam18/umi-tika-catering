<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Member;
use App\Models\Menu;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        User::create([
            'name' => 'administrator',
            'email' => 'administrator@admin.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
            'image' => 'foto-profil/user-1.png',
        ]);

        User::create([
            'name' => 'member',
            'email' => 'member@member.com',
            'password' => Hash::make('1234'),
            'role' => 'member',
            'image' => 'foto-profil/user-2.png',
        ]);

        User::create([
            'name' => 'viona',
            'email' => 'viona@member.com',
            'password' => Hash::make('1234'),
            'role' => 'member',
            'image' => 'foto-profil/user-3.png',
        ]);

        Member::create([
            'user_id' => 2,
            'alamat_kirim' => 'Umayah 1 Kost Griya Mustika',
            'nomor_wa' => '085846826125',
        ]);
        Member::create([
            'user_id' => 3,
            'alamat_kirim' => 'Umayah 1 Kost Griya Mustika',
            'nomor_wa' => '081223219664',
        ]);

        Paket::create([
            'nama_paket' => 'nasi putih',
            'harga' => 21000,
        ]);

        Paket::create([
            'nama_paket' => 'nasi merah',
            'harga' => 23000,
        ]);

        Paket::create([
            'nama_paket' => 'Diet',
            'harga' => 28000,
        ]);

        Menu::create([
            'menu' => 'Nasi Putih, Gulai udang/ayam, rendang tempe, tumis kol kacang panjang, sambal hijau',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-04',
            'paket_id' => 1,
        ]);
        Menu::create([
            'menu' => 'Nasi Putih, Ayam Kari Crispy, Tahu Balado, Lalapan, sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-05',
            'paket_id' => 1,
        ]);
        Menu::create([
            'menu' => 'Nasi Putih, scitch beef eff, kentang saus tiram, Cah pakcoy wortel, saus sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-06',
            'paket_id' => 1,
        ]);
        Menu::create([
            'menu' => 'Nasi Putih, Telor gochujang, Gimmari, cah sawi putih, saus sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-07',
            'paket_id' => 1,
        ]);
        Menu::create([
            'menu' => 'Nasi Putih, Sate ayam maranggi, sup sayur sosis, sambal kecap, snack',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-08',
            'paket_id' => 1,
        ]);

        Menu::create([
            'menu' => 'Nasi Putih, Semur telur, perkedel tahu, cah labusiam',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-04',
            'paket_id' => 1,
        ]);
        Menu::create([
            'menu' => 'Nasi Putih, soto bandung daging sapi, bola-bola sayur, sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-05',
            'paket_id' => 1,
        ]);
        Menu::create([
            'menu' => 'Nasi Putih, Kuwotie ayam, kentang saus tiram, cah tauge, saus sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-06',
            'paket_id' => 1,
        ]);
        Menu::create([
            'menu' => 'Nasi Putih, ayam suwir kemangi, tempe bacem, sayur lodeh, sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-07',
            'paket_id' => 1,
        ]);
        Menu::create([
            'menu' => 'Nasi Putih, ikan kakap fillet/ayam fillet, makaroni keju, tumis buncis wortel jagung telur, saus sambal, snack',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-08',
            'paket_id' => 1,
        ]);

        Menu::create([
            'menu' => 'Nasi Merah, Gulai udang/ayam, rendang tempe, tumis kol kacang panjang, sambal hijau',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-04',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Ayam Kari Crispy, Tahu Balado, Lalapan, sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-05',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, scitch beef eff, kentang saus tiram, Cah pakcoy wortel, saus sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-06',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Telor gochujang, Gimmari, cah sawi Putih, saus sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-07',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Sate ayam maranggi, sup sayur sosis, sambal kecap, snack',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-08',
            'paket_id' => 2,
        ]);

        Menu::create([
            'menu' => 'Nasi Merah, Semur telur, perkedel tahu, cah labusiam',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-04',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, soto bandung daging sapi, bola-bola sayur, sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-05',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Kuwotie ayam, kentang saus tiram, cah tauge, saus sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-06',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, ayam suwir kemangi, tempe bacem, sayur lodeh, sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-07',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, ikan kakap fillet/ayam fillet, makaroni keju, tumis buncis wortel jagung telur, saus sambal, snack',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-08',
            'paket_id' => 2,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Gulai udang/ayam, rendang tempe, tumis kol kacang panjang, sambal hijau',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-04',
            'paket_id' => 3,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Ayam Kari Crispy, Tahu Balado, Lalapan, sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-05',
            'paket_id' => 3,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, scitch beef eff, kentang saus tiram, Cah pakcoy wortel, saus sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-06',
            'paket_id' => 3,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Telor gochujang, Gimmari, cah sawi Putih, saus sambal',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-07',
            'paket_id' => 3,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Sate ayam maranggi, sup sayur sosis, sambal kecap, snack',
            'waktu_makan' => 'lunch',
            'tanggal' => '2023-09-08',
            'paket_id' => 3,
        ]);

        Menu::create([
            'menu' => 'Nasi Merah, Semur telur, perkedel tahu, cah labusiam',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-04',
            'paket_id' => 3,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, soto bandung daging sapi, bola-bola sayur, sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-05',
            'paket_id' => 3,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, Kuwotie ayam, kentang saus tiram, cah tauge, saus sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-06',
            'paket_id' => 3,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, ayam suwir kemangi, tempe bacem, sayur lodeh, sambal',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-07',
            'paket_id' => 3,
        ]);
        Menu::create([
            'menu' => 'Nasi Merah, ikan kakap fillet/ayam fillet, makaroni keju, tumis buncis wortel jagung telur, saus sambal, snack',
            'waktu_makan' => 'dinner',
            'tanggal' => '2023-09-08',
            'paket_id' => 3,
        ]);



    }
}
