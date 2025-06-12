<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lobbies', static function (Blueprint $table): void {
            // Поскольку данных ещё в БД нет, можем дропнуть колонку из-за багов при смене типа через ->change()
            $table->dropColumn('category');
        });

        Schema::create('lobbies_categories', static function (Blueprint $table): void {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('lobby_id');

            $table->foreign('category_id', 'category_foreign')->references('id')->on('categories');
            $table->foreign('lobby_id', 'lobby_foreign')->references('id')->on('lobbies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lobbies_categories');

        Schema::table('lobbies', static function (Blueprint $table): void {
            if (Schema::hasColumn('lobbies', 'category')) {
                $table->dropColumn('category');
            }
            $table->string('category')->after('id');
        });
    }
};
