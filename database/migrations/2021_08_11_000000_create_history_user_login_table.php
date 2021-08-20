<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryUserLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_user_login', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text("hulIp");
            $table->foreignId('state_ip_id');
            $table->text("hulComment");
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('state_ip_id')->references('id')->on('state_ip')
                ->onDelete('cascade')
                ->onUpdate('cascade');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_user_login');
    }
}
