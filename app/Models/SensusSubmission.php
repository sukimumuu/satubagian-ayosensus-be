<?php

namespace App\Models;

use App\Models\User;
use App\Models\Household;
use Illuminate\Database\Eloquent\Model;

class SensusSubmission extends Model
{
    protected $guarded = ['id'];

    public function household()
    {
        return $this->belongsTo(Household::class, 'household_id');
    }   
    public function verified()
    {
        return $this->belongsTo(User::class, 'verified_by_id');
    }
}
