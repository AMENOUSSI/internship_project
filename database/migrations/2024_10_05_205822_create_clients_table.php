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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique()->nullable();
            $table->string('complete_name');
            $table->string('type_client');
            $table->string('email')->nullable();
            $table->dateTime('created_date');
            $table->string('phone_number');
            $table->string('birth_date');
            $table->enum('gender',['Femme','Homme']);
            $table->text('comment')->nullable();
            $table->foreignId('pays_id')->constrained('pays')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
