<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // BURADAN BAŞLIYOR:
    public function register(Request $request)
    {
        $request->validate([
            'gsm' => 'required|unique:users',
            'name' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'gsm' => $request->gsm,
            'email' => $request->gsm . '@biletcell.com',
            'password' => Hash::make('123456'),
            'role' => 'customer',
        ]);

        return response()->json(['message' => 'Kayıt başarılı, OTP bekleniyor (1234)'], 201);
    }
    // BURADA BİTİYOR

    public function verifyOtp(Request $request)
{
    $request->validate([
        'gsm' => 'required',
        'otp' => 'required'
    ]);

    if ($request->otp == '1234') {
        $user = User::where('gsm', $request->gsm)->first();

        if (!$user) {
            return response()->json(['message' => 'Kullanıcı bulunamadı'], 404);
        }

        // Kendi rastgele anahtarımızı üretiyoruz
        $token = Str::random(60);
        $user->update(['api_token' => $token]);

        return response()->json([
            'message' => 'Giriş başarılı!',
            'access_token' => $token,
            'user' => $user
        ]);
    }

    return response()->json(['message' => 'Hatalı OTP'], 401);
}
}
