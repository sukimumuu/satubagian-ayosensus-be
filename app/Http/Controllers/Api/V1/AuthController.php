<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\OtpServices;
use App\Http\Resources\MeResource;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['name', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        User::find(auth()->user()->id)->update(['is_active' => 1]);

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(new MeResource(auth()->user()));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        User::find(auth()->user()->id)->update(['is_active' => 0]);
        auth()->logout();

        return response()->json(['message' => 'Berhasil logout !']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'role' => auth()->user()->getRoleNames()
        ]);
    }

    public function checkNik(Request $request, OtpServices $otpServices) {
       try {
            $data = $request->validate([
                'nik' => 'required|max:16',
                'mother_name' => 'required',
                'phone' => 'required',
            ]);

            if (User::where('name', $data['nik'])->where('is_valid', 1)->exists()) {
                return response()->json([
                    'success'  => false,
                    'message' => 'NIK sudah diaktivasi !'
                ], 422);
            }
            
            $result = $otpServices->checkNik($data);
            
            if (! $result['success']) {
                return response()->json([
                    'success'  => false,
                    'message' => $result['message']
                ], 422);
            }
    
            return response()->json([
                'success'  => true,
                'message' => $result['message'],
                'data'    => $result['data']
            ], 200);

        } catch (\Throwable $th) {
            Log::error("Message validate nik : ".$th->getMessage());
            return response()->json([
                'success'  => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }

    public function validateOtp(Request $request){
        try {
            $data = $request->validate([
                'nik' => 'required|max:16',
                'otp' => 'required',
            ]);

            $user = User::where('name', $data['nik'])->where('otp', $data['otp'])->first();

            if (!$user) {
                return response()->json([
                    'success'  => false,
                    'message' => 'OTP anda salah !'
                ], 422);
            }

            $token = auth()->attempt([
                'name' => $data['nik'],
                'password' => $data['otp']
            ]);

            $user->update([
                'is_active' => 1,
                'otp' => null
            ]);

            return $this->respondWithToken($token);

        } catch (\Throwable $th) {
            Log::error("Message validate otp : ".$th->getMessage());
            return response()->json([
                'success'  => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }

}
