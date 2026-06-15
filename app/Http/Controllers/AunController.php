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
        $criteria = AunCriteria::where('number', $number)
            ->with([
                'subCriteria.items' => fn ($q) => $q->select('id', 'aun_sub_criteria_id', 'title', 'sort_order'),
            ])
            ->firstOrFail();

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
     * หน้า Item — แสดงเนื้อหา rich text + รูปภาพ + เอกสารแนบ (ดาวน์โหลด)
     * GET /aun/{number}/items/{item}
     */
    public function showItem(int $number, AunItem $item): Response
    {
        $criteria = AunCriteria::where('number', $number)->firstOrFail();
        $subCriteria = $item->subCriteria;

        abort_if($subCriteria->aun_criteria_id !== $criteria->id, 404);

        // โหลด attachments แยก type: images + documents (pdf/word/excel/ppt)
        $item->load(['images', 'documents']);

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
}