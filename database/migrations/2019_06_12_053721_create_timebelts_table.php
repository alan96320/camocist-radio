<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimebeltsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timebelts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('days')->nullable();
            $table->string('player_name')->nullable();
            $table->string('banner_image')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_default')->default(0);
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
        Schema::dropIfExists('timebelts');
    }
}
