<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->softDeletes();
            $table->increments('id');
            $table->string('title', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->text('excert')->nullable();
            $table->string('thumbnail', 200)->default('/images/thumbnail.jpg');
            $table->tinyInteger('public')->default(0);
            $table->smallInteger('author_id')->nullable();
            $table->integer('view_count')->default(0);
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
        Schema::dropIfExists('books');
    }
}
