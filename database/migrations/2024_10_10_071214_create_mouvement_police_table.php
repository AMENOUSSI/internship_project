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
        Schema::create('mouvement_police', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['resiliation', 'incorporation', 'retrait']);
            $table->dateTime('starting_date');
            $table->dateTime('ending_date')->nullable();
            $table->text('comment')->nullable();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('police_id')->constrained('police')->cascadeOnDelete();
            $table->string('reference',)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_police');
    }
};
