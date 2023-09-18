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
            $table->foreignId('company_juror_id')->constrained('company_jurors', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_entry_scores', function (Blueprint $table) {
            $table->dropColumn('company_juror_id');
        });
    }
};
