<?php

namespace App\Services;

use App\Models\User;
use App\Models\DummyData;
use App\Models\Household;
use App\Models\Individual;
use App\Models\SensusSubmission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class OtpServices
{
    public function checkNik($data = []): array {
        try {
            $dummyData = DummyData::where('nik', $data['nik'])->where('mother_name', $data['mother_name'])->where('phone', $data['phone'])->first();
    
            if(!$dummyData){
                return [
                    'success' => false,
                    'message' => 'NIK tidak terdaftar di desa anda !',
                    'data' => [
                        'nik' => $data['nik'],
                        'mother_name' => $data['mother_name'],
                        'phone' => $data['phone']
                    ]
                ];
            }
            $otp = mt_rand(100000, 999999);
            $user = User::create([
                'name' => $dummyData->nik,
                'phone' => $dummyData->phone,
                'kode_desa' => $dummyData->kode_desa,
                'is_valid' => 1,
                'password' => Hash::make($otp),
                'otp' => $otp
            ]);
            $user->assignRole('user');
            $this->sendOtp($user);

            DB::transaction(function () use ($user) {
                $household = Household::updateOrCreate([
                    'user_id' => $user->id],
                [
                    'kode_desa' => $user->kode_desa,
                ]);

                SensusSubmission::updateOrCreate([
                    'household_id' => $household->id],
                [
                    'sensus_year' => now()->year,
                ]);

                Individual::updateOrCreate([
                    'household_id' => $household->id],
                [
                    'nik' => $user->name,
                    'family_status' => 'Kepala Keluarga'
                ]);
            });

            return [
                'success' => true,
                'message' => 'NIK terdaftar di desa anda !',
                'data' => [
                    'nik' => $data['nik'],
                    'mother_name' => $data['mother_name'],
                    'phone' => $data['phone']
                ]
            ];
        } catch (\Throwable $th) {
            Log::error("Message check nik : ".$th->getMessage());
            return [
                'success' => false,
                'message' => $th->getMessage()
            ];
        }
    }


    public function sendOtp($user): void{
        $response = Http::post('https://api.kirimi.id/v1/send-message', [
            "user_code" => env('USER_CODE'),
            "device_id" => env('DEVICE_ID'),
            "receiver" => $user->phone,
            "message" => "Kode OTP anda untuk masuk ke Ayo Sensus adalah " . "*" . $user->otp . "*" ." Jangan berikan kode ini kepada siapapun\n\nTerimakasih telah menggunakan Ayo Sensus untuk bantu meningkatkan percepatan pendataan warga di Indonesia",
            "secret" => env('SECRET_KEY'),
        ]);
        Log::channel('sendotp')->info($response->json());
    }
}
