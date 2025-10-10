<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Household;
use App\Models\Individual;
use Illuminate\Http\Request;
use App\Models\SensusSubmission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SensusFormulirController extends Controller
{
    public function startSensus()
    {
       DB::transaction(function () {
            $household = Household::firstOrCreate([
                'user_id' => auth()->id(),
                'kode_desa' => auth()->user()->kode_desa,
            ]);

            SensusSubmission::firstOrCreate([
                'household_id' => $household->id,
                'sensus_year' => now()->year,
            ]);

            Individual::firstOrCreate([
                'household_id' => $household->id,
                'nik' => auth()->user()->name,
                'family_status' => 'Kepala Keluarga'
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Sensus formulir berhasil dimulai!',
        ], 200);
    }
}
