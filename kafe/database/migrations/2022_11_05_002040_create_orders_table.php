<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('faktur')->unique();
            $table->integer('meja');
            $table->string('nama');
            $table->string('whatsapp')->nullable();
            $table->double('total')->default(0);
            $table->double('total_diskon')->default(0);
            $table->double('total_order')->default(0);
            $table->text('keterangan')->nullable();
            $table->foreignId('status_id')->nullable();
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
