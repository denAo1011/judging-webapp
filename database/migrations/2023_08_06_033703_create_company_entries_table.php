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
        Schema::create('company_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies', 'id')->onDelete('cascade');
            $table->string('link');
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('position');
            $table->string('status')
                ->default('PENDING');
            $table->string('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_entries');
    }
};
