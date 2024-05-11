<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiskToVideos extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('disk')->default('local');
        });
    }

    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
        });
    }
}
