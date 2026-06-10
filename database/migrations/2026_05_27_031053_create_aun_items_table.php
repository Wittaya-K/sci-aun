<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aun_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aun_sub_criteria_id')
                  ->constrained('aun_sub_criteria')
                  ->cascadeOnDelete();
            $table->string('title');     // ชื่อ item เช่น "รายละเอียดหลักสูตร (มคอ.2)"
            $table->longText('body')->nullable(); // rich text HTML จาก TipTap
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aun_items');
    }
};
