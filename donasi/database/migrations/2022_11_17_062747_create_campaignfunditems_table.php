<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignfunditemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaignfunditems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('name')->nullable();
            $table->timestamp('transaction_time')->nullable();
            $table->string('transaction_type')->nullable();
            $table->foreignId('bank_id')->nullable();
            $table->foreignId('campaign_id')->nullable();
            $table->foreignId('campaignfund_id')->nullable();
            $table->time('order_id')->nullable();
            $table->double('gross_amount')->default(0);
            $table->string('transaction_status');
            $table->timestamp('transaction_status_time')->nullable();
            $table->text('description')->nullable();
            $table->double('hidden_name')->default(0);
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
        Schema::dropIfExists('campaignfunditems');
    }
};
