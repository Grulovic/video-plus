<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_views', function (Blueprint $table) {
            $table->id();
        	$table->unsignedInteger("gallery_id");
        	// $table->string("session_id");
        	$table->unsignedInteger('user_id')->nullable();
        	$table->string("ip");
        	$table->string("agent");
        
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
        Schema::dropIfExists('gallery_views');
    }
}
