<?php

namespace App\Models;

use App\Models\Subdistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Village extends Model
{
    protected $table = 'villages';

    protected $fillable = [
        'kode', 'name', 'subdistrict_kode',
    ];

    public function subdistrict(): BelongsTo
    {
        return $this->belongsTo(Subdistrict::class, 'subdistrict_kode', 'kode');
    }
}
