<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('parent_id')->unsigned()->default(0);
            $table->string('name');
            $table->string('uploads')->nullable();
            $table->timestamp('created_date')->useCurrent();
            $table->timestamps();
            $table->foreign('post_id')
                    ->references('id')
                    ->on('posts')
                    ->onCascade('delete');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
