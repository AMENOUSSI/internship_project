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
            $table->string('type');
            $table->dateTime('starting_date');
            $table->dateTime('ending_date');
            $table->text('comment');
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
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
