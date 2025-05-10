<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFileToVideos extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->boolean('has_missing_original_file')->default(false);
        });
    }

    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
        });
    }
}
