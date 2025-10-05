<?php

namespace App\Models;

use App\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subdistrict extends Model
{
    protected $table = 'subdistricts';

    protected $fillable = [
        'kode','name',
    ];

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'subdistrict_kode', 'kode');
    }
}
