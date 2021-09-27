<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();

            $table->integer("user_id");
            // $table->integer("category_id");

            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->string("location")->nullable();
            $table->string("mime");
            $table->string("size");
            $table->string("file_name")->unique();
            $table->string("original_file_name");
            // $table->string("location");

            $table->double("runtime",10,2);

            $table->integer("thumbnail");
            
        	$table->string("session_id");
            $table->integer("progress");


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
        Schema::dropIfExists('videos');
    }
}
