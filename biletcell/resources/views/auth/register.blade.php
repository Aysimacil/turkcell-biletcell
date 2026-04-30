@extends('layouts.app')

@section('title', 'BiletCell — Kayıt Ol')

@section('content')
<section style="padding: 180px 0 100px;">
  <div class="container" style="max-width: 500px;">
    <div class="newsletter" style="text-align: left; background: var(--surface); border: 1px solid var(--border);">

      <div class="badge badge-yellow" style="margin-bottom: 15px;">⚡ Turkcell %10 İndirim Fırsatı</div>
      <h2 class="newsletter-title">BiletCell'e Katıl</h2>
      <p class="newsletter-desc">En popüler etkinliklere öncelikli erişim sağla.</p>

      <!-- HATA MESAJLARI (Backend'den gelen hataları görmek için) -->
      @if ($errors->any())
        <div style="background: rgba(255,77,106,0.1); border: 1px solid var(--red); color: var(--red); padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
            <ul style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <!-- Aksiyon rotan: register.post -->
      <form method="POST" action="{{ route('register.post') }}" class="newsletter-form" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf

        <!-- Ad Soyad -->
        <input type="text" name="name" placeholder="Ad Soyad" required value="{{ old('name') }}" />

        <!-- KRİTİK: Senin backendin 'gsm' bekliyor -->
        <input type="text" name="gsm" placeholder="Telefon Numarası (05xx)" required value="{{ old('gsm') }}" />

        <!-- Şifre -->
        <input type="password" name="password" placeholder="Şifre (En az 6 karakter)" required />

        <!-- Şifre Tekrar -->
        <input type="password" name="password_confirmation" placeholder="Şifre Tekrar" required />

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 16px; font-size: 16px;">Kayıt Ol ve Devam Et</button>
      </form>

      <p style="margin-top: 24px; font-size: 14px; color: var(--text-dim); text-align: center;">
        Zaten hesabın var mı? <a href="{{ route('login') }}" style="color: var(--yellow); font-weight: 700;">Giriş Yap</a>
      </p>
    </div>
  </div>
</section>
@endsection
