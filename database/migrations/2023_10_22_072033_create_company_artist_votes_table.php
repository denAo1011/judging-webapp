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
        Schema::create('company_artist_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_artist_id')->constrained('company_artists')->onDelete('cascade');
            $table->string('ip_address', 45);
            $table->string('user_agent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_artist_votes');
    }
};
