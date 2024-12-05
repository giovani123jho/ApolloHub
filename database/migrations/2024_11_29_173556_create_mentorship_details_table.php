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
        Schema::create('mentorship_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentorship_id'); // Relaciona com a tabela de mentorias
            $table->text('content')->nullable(); // O que foi trabalhado na mentoria
            $table->date('mentoring_date')->nullable(); // Data da mentoria
            $table->string('meeting_link')->nullable(); // Link do Microsoft Teams ou Google Meet
            $table->timestamps();

            // Chave estrangeira para vincular com a tabela de mentorias
            $table->foreign('mentorship_id')->references('id')->on('mentorships')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentorship_details');
    }
};
