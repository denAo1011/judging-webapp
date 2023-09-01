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
            $table->string('email');
            $table->string('link');
            $table->string('title');
            $table->date('premiere_date')->nullable();
            $table->json('day_of_airing');
            $table->time('time_of_airing');
            $table->string('production_company');
            $table->string('producers')->nullable();
            $table->string('executive_producers')->nullable();
            $table->string('directors')->nullable();
            $table->string('writers')->nullable();
            $table->longText('synopsis');
            $table->string('contact_person');
            $table->string('contact_person_email');
            $table->string('contact_person_number');
            $table->string('status')
                ->default('PENDING');
            $table->string('notes')->nullable();
            $table->string('payment_reference')->default('');
            $table->string('payment_reference_number');
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
