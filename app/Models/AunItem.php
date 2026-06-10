<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
 
class AunItem extends Model
{
    protected $fillable = [
        'aun_sub_criteria_id',
        'title',
        'body',
        'sort_order',
    ];
 
    protected $casts = [
        'sort_order' => 'integer',
    ];
 
    // ── Relations ────────────────────────────────────────────
 
    public function subCriteria(): BelongsTo
    {
        return $this->belongsTo(AunSubCriteria::class, 'aun_sub_criteria_id');
    }
 
    public function attachments(): HasMany
    {
        return $this->hasMany(AunItemAttachment::class, 'aun_item_id')
                    ->orderBy('sort_order');
    }
 
    public function images(): HasMany
    {
        return $this->hasMany(AunItemAttachment::class, 'aun_item_id')
                    ->where('type', 'image')
                    ->orderBy('sort_order');
    }
 
    public function pdfs(): HasMany
    {
        return $this->hasMany(AunItemAttachment::class, 'aun_item_id')
                    ->where('type', 'pdf')
                    ->orderBy('sort_order');
    }
}
