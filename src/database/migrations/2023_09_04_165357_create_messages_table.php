<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('information')) {
            Schema::create('information', function (Blueprint $table) {
                $table->id();
                $table->string('title', 191);
                $table->string('content', 255);
                $table->string('photo', 255)->nullable();
                $table->datetime('send_at');
                $table->timestamp('created_at')->useCurrent()->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
