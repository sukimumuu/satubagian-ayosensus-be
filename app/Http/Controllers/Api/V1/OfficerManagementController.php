<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\OfficersResource;
use App\Http\Requests\CreateOfficerRequest;

class OfficerManagementController extends Controller
{
    public function index(){
        $officers = User::with('roles')->whereHas('roles', function($q){
            $q->where('name', 'verifier');
        })->get();
        return response()->json([
            'success' => true,
            'message' => 'Data petugas berhasil diambil !',
            'data' => OfficersResource::collection($officers)
        ]);
    }
    public function store(CreateOfficerRequest $request){
        $data = $request->validated();
        $res = [];
        foreach ($data['data'] as $d) {
            try {
                $officer = User::create([
                    'name' => $d['name'],
                    'password' => Hash::make($d['password']),
                    'kode_desa' => $d['kode_desa'] 
                ]);
                $officer->assignRole('verifier');
                $res[] = $officer;
            } catch (\Throwable $th) {
                Log::channel('superadmin')->error("Ada kesalahan sistem : ".$th->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Akun petugas berhasil dibuat !',
        ]);
    }
}
