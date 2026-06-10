<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AunCriteria extends Model
{
    protected $table = 'aun_criteria';  // ← เพิ่มบรรทัดนี้
    
    protected $fillable = [
        'number',
        'title',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'number'     => 'integer',
        'sort_order' => 'integer',
    ];

    // ── Relations ────────────────────────────────────────────

    public function subCriteria(): HasMany
    {
        return $this->hasMany(AunSubCriteria::class, 'aun_criteria_id')
                    ->orderBy('sort_order');
    }
}
