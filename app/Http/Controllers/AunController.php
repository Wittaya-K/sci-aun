<?php

namespace App\Http\Controllers;

use App\Models\AunCriteria;
use App\Models\AunItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AunController extends Controller
{
    /**
     * หน้า AUN หลัก — แสดง sub-criteria + items ของ criteria นั้น
     * GET /aun/{number}
     */
    public function show(int $number): Response
    {
        // ดึง criteria ตาม number พร้อม sub-criteria และ items
        $criteria = AunCriteria::where('number', $number)
            ->with([
                'subCriteria.items' => fn ($q) => $q->select('id', 'aun_sub_criteria_id', 'title', 'sort_order'),
            ])
            ->firstOrFail();

        // ดึง sidebar (ทุก criteria สำหรับ navigation)
        $allCriteria = AunCriteria::orderBy('sort_order')
            ->select('id', 'number', 'title')
            ->get();

        return Inertia::render('Public/AunShow', [
            'criteria'    => $criteria,
            'allCriteria' => $allCriteria,
            'currentNum'  => $number,
        ]);
    }

    /**
     * หน้า Item — แสดงเนื้อหา rich text + รูปภาพ + ปุ่ม More Information (PDF)
     * GET /aun/{number}/items/{item}
     */
    public function showItem(int $number, AunItem $item): Response
    {
        // ตรวจว่า item นี้อยู่ใน criteria ที่ถูกต้อง
        $criteria = AunCriteria::where('number', $number)->firstOrFail();
        $subCriteria = $item->subCriteria;

        abort_if($subCriteria->aun_criteria_id !== $criteria->id, 404);

        // โหลด attachments แยก type
        $item->load(['images', 'pdfs']);

        // sidebar
        $allCriteria = AunCriteria::orderBy('sort_order')
            ->select('id', 'number', 'title')
            ->get();

        return Inertia::render('Public/AunItem', [
            'criteria'    => $criteria,
            'subCriteria' => $subCriteria,
            'item'        => $item,
            'allCriteria' => $allCriteria,
            'currentNum'  => $number,
        ]);
    }

    /**
     * Stream PDF ใน browser
     * GET /aun/{number}/items/{item}/pdf/{attachment}
     */
    public function streamPdf(int $number, AunItem $item, int $attachmentId)
    {
        $criteria = AunCriteria::where('number', $number)->firstOrFail();
        abort_if($item->subCriteria->aun_criteria_id !== $criteria->id, 404);

        $attachment = $item->pdfs()->findOrFail($attachmentId);

        $path = storage_path('app/public/' . $attachment->path);
        abort_if(! file_exists($path), 404);

        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $attachment->filename . '"',
        ]);
    }
}
