<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tb_admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_admin')->insert([
            'username' => 'figofajar',
            'password_admin' => 'figo',
            'nama_lengkap' => 'figo fajar yulianto',
            'foto_admin' => 'picture.png',
        ]);
    }
}