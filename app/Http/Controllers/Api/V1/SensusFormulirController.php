<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Household;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SensusFormulirController extends Controller
{
    public function startSensus()
    {
       Household::firstOrCreate([
        'user_id' => auth()->user()->id,
        'kode_desa' => auth()->user()->kode_desa
       ]);
       return response()->json([
        'success' => true,
        'message' => 'Sensus formulir berhasil dimulai !'
       ], 200);
    }
}
