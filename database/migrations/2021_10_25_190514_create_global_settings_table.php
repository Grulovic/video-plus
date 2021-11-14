<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();

            $table->boolean('hide_videos')->default(0);
            $table->boolean('hide_articles')->default(0);
            $table->boolean('hide_photos')->default(0);
            $table->boolean('hide_live')->default(0);
            $table->string('logo');
            $table->string('logo_footer');

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
        Schema::dropIfExists('global_settings');
    }
}
