<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanbencanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporanbencanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('subdistrict_id')->nullable();
            $table->string('name')->nullable();
            $table->string('kejadian')->nullable();
            $table->string('telepon')->nullable();
            $table->string('hari')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('pukul')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('kronologi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('status')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('la_latitude')->nullable();
            $table->string('la_longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporanbencanas');
    }
}
