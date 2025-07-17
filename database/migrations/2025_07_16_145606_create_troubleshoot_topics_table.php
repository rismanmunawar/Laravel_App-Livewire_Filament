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
        Schema::create('troubleshoot_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('troubleshoot_categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('troubleshoot_subcategories')->onDelete('cascade');
            $table->foreignId('sub_subcategory_id')->nullable()->constrained('troubleshoot_sub_subcategories')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('troubleshoot_topics');
    }
};
