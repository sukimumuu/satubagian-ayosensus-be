<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\DummyJob;
use Illuminate\Http\Request;
use App\Models\DummyEducation;
use App\Http\Controllers\Controller;

class DummyDataController extends Controller
{
    public function dummyJobs(){
        $data = DummyJob::select('name')->get();
        return response()->json([
            'success' => true,
            'message' => 'Data pekerjaan berhasil diambil !',
            'data' => $data
        ], 200);
    }
    public function dummyEducations(){
        $data = DummyEducation::select('name')->get();
        return response()->json([
            'success' => true,
            'message' => 'Data pendidikan berhasil diambil !',
            'data' => $data
        ], 200);
    }
}
