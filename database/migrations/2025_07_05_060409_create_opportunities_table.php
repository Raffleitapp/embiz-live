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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['investment', 'funding', 'partnership', 'mentorship', 'grant']);
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->string('location')->nullable();
            $table->string('industry')->nullable();
            $table->enum('stage', ['idea', 'startup', 'growth', 'established'])->nullable();
            $table->json('requirements')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('website')->nullable();
            $table->string('image')->nullable();
            $table->date('deadline')->nullable();
            $table->enum('status', ['active', 'paused', 'closed', 'draft'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0);
            $table->integer('applications')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
