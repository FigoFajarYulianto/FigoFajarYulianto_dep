<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('province_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('subdistrict_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->double('nominal')->default(0);
            $table->date('waktu_tenggat')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->double('views')->default(0);
            $table->foreignId('gallery_id')->nullable();
            $table->foreignId('status_id')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
};
