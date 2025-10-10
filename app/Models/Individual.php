<?php

namespace App\Models;

use App\Models\Work;
use App\Models\Education;
use App\Models\Household;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    protected $guarded = ['id'];

    public function household()
    {
        return $this->belongsTo(Household::class, 'household_id');
    }

    public function works()
    {
        return $this->hasOne(Work::class, 'individual_id');
    }
    public function educations()
    {
        return $this->hasOne(Education::class, 'individual_id');
    }
}
