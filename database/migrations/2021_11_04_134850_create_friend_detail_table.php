<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_details', function (Blueprint $table) {
            $table->unsignedBigInteger('friend_list_id');
            $table->unsignedBigInteger('friend_id');
            $table->foreign('friend_list_id')->references('friend_list_id')->on('friend_lists');
            $table->foreign('friend_id')->references('user_id')->on('users');
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
        Schema::dropIfExists('friend_details');
    }
}
