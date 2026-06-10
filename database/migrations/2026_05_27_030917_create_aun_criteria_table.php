<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aun_criteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number')->unique(); // 1–8
            $table->string('title');                         // Expected Learning Outcomes
            $table->text('description')->nullable();         // intro text (optional)
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aun_criteria');
    }
};
