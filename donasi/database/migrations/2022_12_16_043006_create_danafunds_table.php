<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanafundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danafunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dana_id')->nullable();
            $table->double('total_fund')->default(0);
            $table->double('penarikan_fund')->default(0);
            $table->double('sisa_fund')->default(0);
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
        Schema::dropIfExists('jenisdanafunds');
    }
}
