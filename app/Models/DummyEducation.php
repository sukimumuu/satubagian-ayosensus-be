<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DummyEducation extends Model
{
    protected $table = 'dummy_educations';
    protected $guarded = ['id']; 
    protected $timestamps = false;
}
