<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentorships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('pendente'); // Status da mentoria (pendente, aceita, recusada)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorships');
    }
};


