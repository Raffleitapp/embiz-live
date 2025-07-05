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
        Schema::create('affiliate_programmes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('programme_name');
            $table->text('description');
            $table->decimal('commission_rate', 5, 2); // percentage
            $table->decimal('minimum_payout', 10, 2)->default(50.00);
            $table->string('payment_method')->nullable();
            $table->json('terms_conditions')->nullable();
            $table->string('referral_code')->unique();
            $table->integer('total_referrals')->default(0);
            $table->decimal('total_earnings', 15, 2)->default(0.00);
            $table->decimal('pending_commission', 15, 2)->default(0.00);
            $table->decimal('paid_commission', 15, 2)->default(0.00);
            $table->enum('status', ['active', 'paused', 'suspended', 'terminated'])->default('active');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_programmes');
    }
};
