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
        Schema::table('company_entry_scores', function (Blueprint $table) {
            // Drop constraints
            $table->dropForeign(['company_token_id']);
            $table->dropColumn('company_token_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_entry_scores', function (Blueprint $table) {
            $table->foreignId('company_token_id')->constrained('company_tokens', 'id')->onDelete('cascade');
        });
    }
};
