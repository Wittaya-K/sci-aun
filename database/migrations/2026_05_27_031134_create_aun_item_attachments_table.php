<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aun_item_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aun_item_id')
                  ->constrained('aun_items')
                  ->cascadeOnDelete();
            $table->enum('type', ['image', 'pdf']);
            $table->string('path');              // storage path เช่น aun/items/1/file.pdf
            $table->string('filename');          // ชื่อไฟล์ต้นฉบับ
            $table->string('caption')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aun_item_attachments');
    }
};
