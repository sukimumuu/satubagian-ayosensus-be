<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\SensusSubmission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function summaryPerKecamatan()
    {
        $data = SensusSubmission::query()
            ->select([
                'subdistricts.name as kecamatan',
                DB::raw('COUNT(sensus_submissions.id) as total'),
            ])
            ->join('households', 'households.id', '=', 'sensus_submissions.household_id')
            ->join('villages', 'villages.kode', '=', 'households.kode_desa')
            ->join('subdistricts', 'subdistricts.kode', '=', 'villages.subdistrict_kode')
            ->where('sensus_submissions.status', '!=', 'draft')
            ->groupBy('subdistricts.name')
            ->orderBy('subdistricts.name')
            ->get();

        $formatted = $data->map(fn($item) => [
            'label' => $item->kecamatan,
            'value' => (int) $item->total,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rekap sensus per kecamatan berhasil diambil.',
            'data' => $formatted,
        ]);
    }
}
