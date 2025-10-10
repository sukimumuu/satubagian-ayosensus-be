<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Household;
use App\Models\Individual;
use Illuminate\Http\Request;
use App\Models\SensusSubmission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\InputFamilyRequest;

class SensusFormulirController extends Controller
{
    public function startSensus()
    {
       DB::transaction(function () {
            $household = Household::create([
                'user_id' => auth()->id(),
                'kode_desa' => auth()->user()->kode_desa,
            ]);

            SensusSubmission::create([
                'household_id' => $household->id,
                'sensus_year' => now()->year,
            ]);

            Individual::create([
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

    public function storeFamily(InputFamilyRequest $request){
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['kode_desa'] = auth()->user()->kode_desa;

        DB::transaction(function () use ($data) {
            $household = HouseHold::where('user_id', $data['user_id'])->first();
            $household->update($data);
        });
        return response()->json([
            'success' => true,
            'message' => 'Data Keluarga Berhasil Disimpan!',
        ], 200);
    }
}
