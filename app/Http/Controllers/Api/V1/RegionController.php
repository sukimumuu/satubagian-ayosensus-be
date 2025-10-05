<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Village;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function getSubdistrict(){
        $subdistrict = Subdistrict::select('kode', 'name')->get();
        return response()->json($subdistrict);
    }

    public function searchVillage(Request $request){
        $params = $request->input('name');
        $query = Village::with('subdistrict')->where('name', 'like', '%'.$params.'%')
                ->take(16)
                ->select('kode', 'name', 'subdistrict_kode')
                ->get();
        $res = [];
        foreach ($query as $q) {
            $res[] = [
                'kode' => $q->kode,
                'name' => $q->name,
                'subdistrict' => $q->subdistrict->name,
                'subdistrict_kode' => $q->subdistrict_kode
            ];
        }
        return response()->json($res); 
    }
}
