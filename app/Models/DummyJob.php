<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DummyJob extends Model
{
    protected $table = 'dummy_jobs';
    protected $guarded = ['id'];
    public $timestamps = false;
}
