<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToLives extends Migration
{
    public function up()
    {
        Schema::table('lives', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('lives', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
