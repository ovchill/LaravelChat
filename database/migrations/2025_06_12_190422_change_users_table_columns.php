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
        $columns = ['email', 'email_verified_at', 'password', 'remember_token'];

        foreach ($columns as $column) {
            if (Schema::hasColumn('users', $column)) {
                Schema::dropColumns('users', $column);
            }
        }

        Schema::table('users', static function (Blueprint $table) {
            $table->string('session_token')->comment('Токен сессии пользователя')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
