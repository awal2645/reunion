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
        Schema::create('payment_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->text('message');
            $table->boolean('shared_on_facebook')->default(false);
            $table->boolean('shared_on_whatsapp')->default(false);
            $table->integer('views_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_shares');
    }
};
