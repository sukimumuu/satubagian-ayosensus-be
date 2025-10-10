<?php

namespace App\Models;

use App\Models\User;
use App\Models\Individual;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function individuals()
    {
        return $this->hasMany(Individual::class, 'household_id');
    }
}
