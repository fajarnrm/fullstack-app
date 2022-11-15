<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Fajar Noor Ilham',
            'email' => 'fajar.noorilham@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('perencanaans')->insert([
            'rencana' => 'Ingin Bekerja di Infomedia',
            'deskripsi' => 'bekerja di infomedia adalah pekerjaan yang saya idamkan selama ini karena infomedia ini merupakan perusahaan BUMN yang bergerak dibidang teknologi. tentu untuk masuknya pun tidak mudah, banyak seleksi yang harus dilalui untuk menjadi seorang developer di infomedia
            ',
            'status' => 'dalam proses',
            'syarat' => 'harus menguasai pemrograman, RESTfull API dan tentunya softskill',
            'target' => '2022-12-01 00:00:00'
        ]);

        DB::table('perencanaans')->insert([
            'rencana' => 'Ingin Membeli Rumah',
            'deskripsi' => 'Rumah untuk masa depan
            ',
            'status' => 'dalam proses',
            'biaya' => 800000000,
            'syarat' => 'harus bekerja dan mempunyai penghasilan yang besar',
            'target' => '2025-12-01 00:00:00'
        ]);

        
    }
}
