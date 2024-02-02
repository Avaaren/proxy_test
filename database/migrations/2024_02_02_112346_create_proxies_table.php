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
        Schema::create('proxies', function (Blueprint $table) {
            $table->id();
            $table->string('ip_port');
            $table->string('type');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->enum('status', ['working', 'not_working'])->nullable();
            $table->integer('download_speed')->nullable();
            $table->integer('timeout')->nullable();
            $table->string('real_ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxies');
    }
};
