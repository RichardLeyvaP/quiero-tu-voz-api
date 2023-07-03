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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('city_id')->after('id')->constrained()->restrictOnDelete();
            $table->string('last_name')->after('name');
            $table->string('phone')->nullable()->after('password');
            $table->tinyInteger('role')->after('phone');
            $table->tinyInteger('avatar')->after('role')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('role');
            $table->dropColumn('avatar');
            $table->dropSoftDeletes();
        });
    }
};
