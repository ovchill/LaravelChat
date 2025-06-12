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
        if (!Schema::hasColumn('lobbies', 'users_limit')) {
            Schema::table('lobbies', static function (Blueprint $table) {
                $table->integer('users_limit')
                    ->after('is_closed')
                    ->default(0)
                    ->comment('Максимальное количество пользователей в чате');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('lobbies', 'users_limit')) {
            Schema::table('lobbies', static function (Blueprint $table) {
                $table->dropColumn('users_limit');
            });
        }
    }
};
