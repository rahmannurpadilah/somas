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
        Schema::create('content_ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')
                ->nullable()
                ->constrained('content_sources')
                ->nullOnDelete();

            $table->enum('platform', ['instagram', 'tiktok']);

            $table->string('original_url')->nullable();
            $table->text('original_caption')->nullable();
            $table->json('original_stats')->nullable();

            // AI
            $table->text('ai_generated_caption')->nullable();
            $table->text('ai_generated_script')->nullable();
            $table->enum('ai_status', ['pending', 'processing', 'completed', 'failed'])
                ->default('pending');
            $table->text('ai_error_message')->nullable();

            // Admin
            $table->text('final_caption')->nullable();
            $table->string('final_media_path')->nullable();
            $table->text('admin_notes')->nullable();
            $table->enum('status', ['draft', 'reviewed', 'scheduled', 'posted'])
                ->default('draft');

            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('posted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_ideas');
    }
};
