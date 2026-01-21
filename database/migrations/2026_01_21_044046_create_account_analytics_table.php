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
        Schema::create('account_analytics', function (Blueprint $table) {
            $table->id();
            $table->enum('platform', ['instagram', 'tiktok']);
            $table->string('username');
            $table->integer('followers_count')->default(0);
            $table->integer('following_count')->default(0);
            $table->integer('total_likes')->default(0);
            $table->decimal('engagement_rate', 5, 2)->nullable();
            $table->date('recorded_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_analytics');
    }
};
