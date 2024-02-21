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
            $table->decimal('level_one_rating')->default(0)->change();
            $table->decimal('level_two_rating')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_entry_scores', function (Blueprint $table) {
            $table->decimal('level_one_rating')->change();
            $table->decimal('level_two_rating')->change();
        });
    }
};
