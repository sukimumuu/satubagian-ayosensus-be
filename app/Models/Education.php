<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $guarded = ['id'];

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }
}
