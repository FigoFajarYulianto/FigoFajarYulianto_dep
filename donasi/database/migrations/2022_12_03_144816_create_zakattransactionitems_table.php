<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZakattransactionitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zakattransactionitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('jeniszakat')->nullable();
            $table->string('name')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('npwp')->nullable();
            $table->double('is_anonim')->default(0);
            $table->text('message')->nullable();
            $table->timestamp('transaction_time')->nullable();
            $table->string('transaction_type')->nullable();
            $table->time('order_id')->nullable();
            $table->double('gross_amount')->default(0);
            $table->string('transaction_status');
            $table->timestamp('transaction_status_time')->nullable();
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
        Schema::dropIfExists('zakattransactions');
    }
}
