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
        Schema::create('message_interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('response_type', ['interested', 'not_interested'])->default('interested');
            $table->enum('interest_level', ['high', 'medium', 'low'])->nullable();
            $table->text('comments')->nullable();
            $table->decimal('investment_amount', 15, 2)->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
            
            // Ensure one response per user per message
            $table->unique(['message_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_interests');
    }
};
