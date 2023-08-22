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
        Schema::create('company_entry_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_token_id')->constrained('company_tokens', 'id')->onDelete('cascade');
            $table->foreignId('company_entry_id')->constrained('company_entries', 'id')->onDelete('cascade');
            $table->decimal('level_one_rating');
            $table->decimal('level_two_rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_entry_scores');
    }
};
