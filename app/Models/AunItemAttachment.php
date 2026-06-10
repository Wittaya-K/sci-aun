<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AunItemAttachment extends Model
{
    protected $table = 'aun_item_attachments';  // ← เพิ่มบรรทัดนี้
    
    protected $fillable = [
        'aun_item_id',
        'type',
        'path',
        'filename',
        'caption',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    protected $appends = ['url'];

    // ── Relations ────────────────────────────────────────────

    public function item(): BelongsTo
    {
        return $this->belongsTo(AunItem::class, 'aun_item_id');
    }

    // ── Accessors ─────────────────────────────────────────────

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    // ── Helpers ───────────────────────────────────────────────

    public function isImage(): bool
    {
        return $this->type === 'image';
    }

    public function isPdf(): bool
    {
        return $this->type === 'pdf';
    }
}
