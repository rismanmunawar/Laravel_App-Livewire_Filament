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
        Schema::create('data_dists', function (Blueprint $table) {
            $table->id();
            $table->string('branch');
            $table->string('plant');
            $table->string('code_dist')->nullable();
            $table->string('name_dist');
            $table->string('status_dist');
            $table->string('channel');
            $table->string('rom')->nullable();
            $table->string('nom')->nullable();
            $table->string('region')->nullable();
            $table->integer('status_plant')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_dists');
    }
};
