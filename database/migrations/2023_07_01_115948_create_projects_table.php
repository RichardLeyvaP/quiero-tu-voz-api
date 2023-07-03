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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('holder_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreignId('executor_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreignId('project_type_id')->constrained()->restrictOnDelete();
            $table->longText('details');
            $table->decimal('amount', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
