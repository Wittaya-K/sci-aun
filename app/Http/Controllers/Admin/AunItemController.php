<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AunCriteria;
use App\Models\AunItem;
use App\Models\AunItemAttachment;
use App\Models\AunSubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class AunItemController extends Controller
{
    private function allCriteria()
    {
        return AunCriteria::orderBy('sort_order')->get();
    }

    public function index(AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria): Response
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);

        $items = $aunSubCriteria->items()
            ->withCount('attachments')
            ->get();

        return Inertia::render('Admin/Items/Index', [
            'criteria'    => $aunCriteria,
            'subCriteria' => $aunSubCriteria,
            'items'       => $items,
            'allCriteria' => $this->allCriteria(),
        ]);
    }

    public function create(AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria): Response
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);

        return Inertia::render('Admin/Items/Edit', [
            'criteria'    => $aunCriteria,
            'subCriteria' => $aunSubCriteria,
            'item'        => null,
            'allCriteria' => $this->allCriteria(),
        ]);
    }

    public function store(Request $request, AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria)
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);

        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'body'       => 'nullable|string',
            'sort_order' => 'integer|min:0',
        ]);

        $item = $aunSubCriteria->items()->create($validated);

        return redirect()->route('admin.criteria.sub-criteria.items.edit', [
            $aunCriteria, $aunSubCriteria, $item,
        ])->with('success', 'สร้าง item เรียบร้อยแล้ว');
    }

    public function edit(AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria, AunItem $aunItem): Response
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);
        abort_if($aunItem->aun_sub_criteria_id !== $aunSubCriteria->id, 404);

        $aunItem->load('attachments');

        return Inertia::render('Admin/Items/Edit', [
            'criteria'    => $aunCriteria,
            'subCriteria' => $aunSubCriteria,
            'item'        => $aunItem,
            'allCriteria' => $this->allCriteria(),
        ]);
    }

    public function update(Request $request, AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria, AunItem $aunItem)
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);
        abort_if($aunItem->aun_sub_criteria_id !== $aunSubCriteria->id, 404);

        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'body'       => 'nullable|string',
            'sort_order' => 'integer|min:0',
        ]);

        $aunItem->update($validated);

        return back()->with('success', 'บันทึกเรียบร้อยแล้ว');
    }

    public function destroy(AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria, AunItem $aunItem)
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);
        abort_if($aunItem->aun_sub_criteria_id !== $aunSubCriteria->id, 404);

        foreach ($aunItem->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->path);
        }

        $aunItem->delete();

        return redirect()->route('admin.criteria.sub-criteria.items.index', [
            $aunCriteria, $aunSubCriteria,
        ])->with('success', 'ลบ item เรียบร้อยแล้ว');
    }

    /**
     * Upload attachment — รองรับ:
     *   type=image    → jpg, jpeg, png, webp, gif
     *   type=document → pdf, doc, docx, xls, xlsx, ppt, pptx
     */
    public function uploadAttachment(Request $request, AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria, AunItem $aunItem)
    {
        abort_if($aunSubCriteria->aun_criteria_id !== $aunCriteria->id, 404);
        abort_if($aunItem->aun_sub_criteria_id !== $aunSubCriteria->id, 404);

        $request->validate([
            'file'    => 'required|file|max:20480', // 20MB
            'type'    => 'required|in:image,document',
            'caption' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        $type = $request->input('type');

        if ($type === 'image') {
            $request->validate(['file' => 'mimes:jpg,jpeg,png,webp,gif']);
        } else {
            $request->validate(['file' => 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx']);
        }

        $folder = $type === 'image' ? 'images' : 'documents';
        $path   = $file->store("aun/items/{$aunItem->id}/{$folder}", 'public');

        $attachment = $aunItem->attachments()->create([
            'type'       => $type,
            'path'       => $path,
            'filename'   => $file->getClientOriginalName(),
            'caption'    => $request->input('caption'),
            'sort_order' => $aunItem->attachments()->count(),
        ]);

        return response()->json([
            'attachment' => array_merge($attachment->toArray(), [
                'url' => Storage::url($path),
            ]),
        ]);
    }

    public function destroyAttachment(AunCriteria $aunCriteria, AunSubCriteria $aunSubCriteria, AunItem $aunItem, AunItemAttachment $attachment)
    {
        abort_if($attachment->aun_item_id !== $aunItem->id, 404);

        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();

        return response()->json(['deleted' => true]);
    }
}