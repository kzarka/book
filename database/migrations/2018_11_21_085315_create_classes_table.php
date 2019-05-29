<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->tinyInteger('active')->default(1);
            $table->text('desc_normal')->nullable();
            $table->text('desc_awaken')->nullable();
            $table->tinyInteger('has_awk')->default(0);
            $table->string('normal_video', 300)->nullable();
            $table->string('awaken_video', 300)->nullable();
            $table->string('normal_img', 200)->nullable();
            $table->string('awaken_img', 200)->nullable();
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
        Schema::dropIfExists('classes');
    }
}
