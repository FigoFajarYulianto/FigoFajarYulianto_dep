<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanafunditemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danafunditems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('dana_id')->nullable();
            $table->foreignId('bank_id')->nullable();
            $table->string('name')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('npwp')->nullable();
            $table->double('is_anonim')->default(0);
            $table->text('description')->nullable();
            $table->string('no_transaksi')->nullable();
            $table->timestamp('transaction_time')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('penerima_dana')->nullable();
            $table->time('order_id')->nullable();
            $table->double('gross_amount')->default(0);
            $table->string('transaction_status');
            $table->timestamp('transaction_status_time')->nullable();
            $table->text('snap_token')->nullable();
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
        Schema::dropIfExists('jenisdanafunditems');
    }
}
