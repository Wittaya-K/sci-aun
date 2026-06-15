<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. ขยาย enum ให้รองรับทั้งค่าเก่าและใหม่ชั่วคราว
        DB::statement("ALTER TABLE aun_item_attachments MODIFY type ENUM('image','pdf','document') NOT NULL");

        // 2. ย้ายข้อมูลเดิม: pdf -> document
        DB::table('aun_item_attachments')->where('type', 'pdf')->update(['type' => 'document']);

        // 3. บีบ enum ให้เหลือค่าสุดท้าย
        DB::statement("ALTER TABLE aun_item_attachments MODIFY type ENUM('image','document') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE aun_item_attachments MODIFY type ENUM('image','pdf','document') NOT NULL");
        DB::table('aun_item_attachments')->where('type', 'document')->update(['type' => 'pdf']);
        DB::statement("ALTER TABLE aun_item_attachments MODIFY type ENUM('image','pdf') NOT NULL");
    }
};