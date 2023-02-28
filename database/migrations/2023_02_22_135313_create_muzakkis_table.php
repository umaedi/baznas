<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muzakkis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dinas_id')->nullable();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('no_tlp')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->default('avatar-1.png');
            $table->rememberToken();
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
        Schema::dropIfExists('muzakkis');
    }
};
