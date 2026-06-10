<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aun_sub_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aun_criteria_id')
                  ->constrained('aun_criteria')
                  ->cascadeOnDelete();
            $table->string('number');    // "1.1", "1.2", ...
            $table->text('title');       // "The programme to show that..."
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aun_sub_criteria');
    }
};
