<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DummyData extends Model
{
    protected $table = 'dummy_datas';
    protected $guarded = ['id'];
    protected $timestamps = false;
}
