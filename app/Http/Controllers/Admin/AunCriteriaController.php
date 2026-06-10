<?php

// ============================================================
// app/Http/Controllers/Admin/AunCriteriaController.php
// ============================================================

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AunCriteria;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AunCriteriaController extends Controller
{
    // public function index(): Response
    // {
    //     $criteria = AunCriteria::withCount('subCriteria')
    //         ->orderBy('sort_order')
    //         ->get();

    //     return Inertia::render('Admin/Criteria/Index', [
    //         'criteria' => $criteria,
    //     ]);
    // }

    // public function index(): Response
    // {
    //     $criteria = AunCriteria::withCount('subCriteria')
    //         ->orderBy('sort_order')
    //         ->get();

    //     return Inertia::render('Admin/Criteria/Index', [
    //         'criteria' => $criteria,
    //     ]);
    // }
    // public function edit(AunCriteria $aunCriteria): Response
    // {
    //     return Inertia::render('Admin/Criteria/Edit', [
    //         'criteria' => $aunCriteria,
    //     ]);
    // }
    public function index(): Response
    {
        $criteria = AunCriteria::withCount('subCriteria')
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Admin/Criteria/Index', [
            'criteria'    => $criteria,
            'allCriteria' => AunCriteria::orderBy('sort_order')->get(),  // ← เพิ่ม
        ]);
    }

    public function edit(AunCriteria $aunCriteria): Response
    {
        return Inertia::render('Admin/Criteria/Edit', [
            'criteria'    => $aunCriteria,
            'allCriteria' => AunCriteria::orderBy('sort_order')->get(),  // ← เพิ่ม
        ]);
    }

    public function update(Request $request, AunCriteria $aunCriteria)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $aunCriteria->update($validated);

        return redirect()->route('admin.criteria.index')
            ->with('success', 'บันทึกเรียบร้อยแล้ว');
    }
}
