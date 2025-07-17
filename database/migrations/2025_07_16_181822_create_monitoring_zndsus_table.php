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
        Schema::create('monitoring_zndsus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('plant');
            $table->string('name_dist');
            $table->unsignedBigInteger('master_it_id')->nullable();
            $table->unsignedBigInteger('master_dist_id')->nullable();
            $table->date('uploaded_at');
            $table->boolean('has_error')->default(false);
            // Kolom day_01 sampai day_31
            for ($i = 1; $i <= 31; $i++) {
                $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                $table->string("day_$day")->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_zndsus');
    }
};
