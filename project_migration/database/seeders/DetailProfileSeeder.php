<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;




class DetailProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_profile')->insert([
            'nama' => 'lala',
            'address' => 'Sumbang',
            'nomor_tlp' => '082342235',
            'ttl'  => '1023-08-22',
        ]);
    }
}