<?php

// ============================================================
// app/Http/Controllers/Admin/AunSubCriteriaController.php
// ============================================================
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\AunCriteria;
use App\Models\AunSubCriteria;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AunSubCriteriaController extends Controller
{
    // public function index(AunCriteria $aunCriteria): Response
    // {
    //     $subCriteria = $aunCriteria->subCriteria()
    //         ->withCount('items')
    //         ->get();
 
    //     return Inertia::render('Admin/SubCriteria/Index', [
    //         'criteria'    => $aunCriteria,
    //         'subCriteria' => $subCriteria,
    //     ]);
    // }
 
    // public function edit(AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria): Response
    // {
    //     abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);
 
    //     return Inertia::render('Admin/SubCriteria/Edit', [
    //         'criteria'   => $aunCriteria,
    //         'subCriteria' => $aunSubCriteria,
    //     ]);
    // }

    public function index(AunCriteria $aunCriteria): Response
    {
        $subCriteria = $aunCriteria->subCriteria()
            ->withCount('items')
            ->get();

        return Inertia::render('Admin/SubCriteria/Index', [
            'criteria'    => $aunCriteria,
            'subCriteria' => $subCriteria,
            'allCriteria' => AunCriteria::orderBy('sort_order')->get(), // ← เพิ่ม
        ]);
    }

    public function edit(AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria): Response
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);

        return Inertia::render('Admin/SubCriteria/Edit', [
            'criteria'    => $aunCriteria,
            'subCriteria' => $aunSubCriteria,
            'allCriteria' => AunCriteria::orderBy('sort_order')->get(), // ← เพิ่ม
        ]);
    }

    public function update(Request $request, AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria)
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);
 
        $validated = $request->validate([
            'title' => 'required|string',
        ]);
 
        $aunSubCriteria->update($validated);
 
        return redirect()->route('admin.criteria.sub-criteria.index', $aunCriteria)
            ->with('success', 'บันทึกเรียบร้อยแล้ว');
    }

    public function create(AunCriteria $aunCriteria): Response
    {
        return Inertia::render('Admin/SubCriteria/Edit', [
            'criteria'    => $aunCriteria,
            'subCriteria' => null,
            'allCriteria' => AunCriteria::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request, AunCriteria $aunCriteria)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:10',
            'title'  => 'required|string',
        ]);

        $validated['sort_order'] = $aunCriteria->subCriteria()->count() + 1;
        $aunCriteria->subCriteria()->create($validated);

        return redirect()->route('admin.criteria.sub-criteria.index', $aunCriteria)
            ->with('success', 'เพิ่ม sub-criteria เรียบร้อยแล้ว');
    }

    public function destroy(AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria)
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);
        $aunSubCriteria->delete();

        return redirect()->route('admin.criteria.sub-criteria.index', $aunCriteria)
            ->with('success', 'ลบเรียบร้อยแล้ว');
    }
}
