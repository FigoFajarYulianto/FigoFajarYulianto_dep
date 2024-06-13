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
        Schema::create('funditems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->timestamp('transaction_time')->nullable();
            $table->string('transaction_type')->nullable();
            $table->foreignId('bank_id')->nullable();
            $table->foreignId('campaign_id')->nullable();
            $table->foreignId('fund_id')->nullable();
            $table->foreignId('transaction_id')->nullable();
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
        Schema::dropIfExists('funditems');
    }
};
