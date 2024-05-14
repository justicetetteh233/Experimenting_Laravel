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
        Schema::create('vote_casts', function (Blueprint $table) {
            $table->foreignId('voters_id')->constrained()->onDelete('cascade');
            $table->foreignId('positions_id')->constrained()->onDelete('cascade');
            $table->foreignId('candidates_id')->constrained()->onDelete('cascade');
            $table->primary(['voters_id', 'positions_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_casts');
    }
};
