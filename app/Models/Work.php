<?php

namespace App\Models;

use App\Models\Individual;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = ['id'];

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }
}
