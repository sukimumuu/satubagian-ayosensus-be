<?php

namespace App\Models;

use App\Models\Household;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    protected $guarded = ['id'];

    public function household()
    {
        return $this->belongsTo(Household::class, 'household_id');
    }
}
