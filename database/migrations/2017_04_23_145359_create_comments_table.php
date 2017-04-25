<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->string('comment_subject');
            $table->text('comment_text');
            $table->integer('comment_status');
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

      $table->integer('comment_id');
      $table->string('comment_subject');
      $table->text('comment_text');
      $table->integer('comment_status');
      $table->timestamps();


        Schema::dropIfExists('comments');
    }
}
