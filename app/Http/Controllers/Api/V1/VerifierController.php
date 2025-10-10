<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\SensusSubmission;
use App\Http\Controllers\Controller;

class VerifierController extends Controller
{

    public function index(){
        $data = SensusSubmission::with('household')
                ->where('sensus_year', now()->year)
                ->where('status', '!=' ,'draft')
                ->whereHas('household', function ($q) {
                    $q->where('kode_desa', auth()->user()->kode_desa);
                })
                ->get()
                ->makeHidden(['household']);

        return response()->json([
            'success' => true,
            'message' => 'Data Sensus Berhasil Diambil!',
            'data' => $data
        ]);
    }

    public function sentStatusSensus(Request $request){
        $submission = SensusSubmission::where('id', $request->id)->first();
        $submission->status = $request->status;
        $submission->verified_by_id = auth()->user()->id;
        $submission->verified_at = now();
        $submission->notes = $request->notes ?? null;
        $submission->save();

        return response()->json([
            'success' => true,
            'message' => 'Sensus formulir berhasil disetujui !',
        ], 200);
    }

    
}
