<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lobby_users', static function (Blueprint $table) {
            $table->id();
            $table->integer('lobby_id');
            $table->integer('user_id');
            $table->timestamps();

            $table->foreign('lobby_id', 'lobby_foreign')->references('id')->on('lobbies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lobby_users');
    }
};
