<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AunSubCriteria extends Model
{
    protected $table = 'aun_sub_criteria';  // ← เพิ่มบรรทัดนี้

    protected $fillable = [
        'aun_criteria_id',
        'number',
        'title',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    // ── Relations ────────────────────────────────────────────

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(AunCriteria::class, 'aun_criteria_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(AunItem::class, 'aun_sub_criteria_id')
                    ->orderBy('sort_order');
    }
}
