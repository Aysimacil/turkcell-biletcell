<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // API REGISTER (Mevcut GSM/OTP mantığın)
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

    // API OTP VERIFY (Mevcut mantığın)
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

    // --- YENİ EKLENEN WEB METODLARI (Blade için) ---

    // Web üzerinden giriş yapmayı sağlar (Session başlatır)
    public function webLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Laravel'in yerleşik Auth sistemi ile giriş denemesi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Güvenlik için session yenileme

            return redirect()->intended('/events')
                             ->with('success', 'Hoş geldin ' . Auth::user()->name);
        }

        return back()->withErrors([
            'email' => 'Girdiğiniz bilgiler kayıtlarımızla eşleşmiyor.',
        ]);
    }

    // Web üzerinden kayıt olmayı sağlar
    public function webRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gsm' => 'required|unique:users',
            'password' => 'required|min:6|confirmed', // password_confirmation alanı ile eşleşmeli
        ]);

        $user = User::create([
            'name' => $request->name,
            'gsm' => $request->gsm,
            'email' => $request->gsm . '@biletcell.com',
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        // Kayıt olduktan sonra otomatik giriş yap
        Auth::login($user);

        return redirect()->route('events.index')->with('success', 'Hesabınız oluşturuldu!');
    }

    // Çıkış yapma (Web)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
