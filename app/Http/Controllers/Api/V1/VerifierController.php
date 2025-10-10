<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\SensusSubmission;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
        $submission = SensusSubmission::with('household')->where('id', $request->id)->first();
        $user = SensusSubmission::with('household.user')->where('id', $request->id)->first();
        if($request->status == 'verified'){
            $this->sendOtp($user->household->user->phone, $submission->household->no_kk, 'disetujui');
        } else {
            $this->sendOtp($user->household->user->phone, $submission->household->no_kk, 'ditolak');
        }
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
    protected function sendOtp($user, $submission, $status): void{
        $response = Http::post('https://api.kirimi.id/v1/send-message', [
            "user_code" => env('USER_CODE'),
            "device_id" => env('DEVICE_ID'),
            "receiver" => $user,
            "message" => "Formulir anda untuk " . $submission . " telah " . $status . " !\n\nTerimakasih telah menggunakan Ayo Sensus untuk bantu meningkatkan percepatan pendataan warga di Indonesia",
            "secret" => env('SECRET_KEY'),
        ]);
        Log::channel('sendotp')->info($response->json());
    }
    
}
