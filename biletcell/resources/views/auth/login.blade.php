@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')
<section style="padding: 180px 0 100px;">
  <div class="container" style="max-width: 500px;">
    <div class="newsletter" style="text-align: left;">
      <h2 class="newsletter-title">Tekrar Hoş Geldin!</h2>
      <p class="newsletter-desc">Biletcell hesabınla giriş yap.</p>

      <!-- HATA MESAJLARI İÇİN -->
      @if ($errors->any())
        <div style="background: rgba(255,77,106,0.1); border: 1px solid var(--red); color: var(--red); padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px;">
            Giriş başarısız. Bilgilerinizi kontrol edin.
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" class="newsletter-form" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf <!-- KRİTİK: Bu olmazsa 419 Page Expired hatası alırsın -->

        <!-- Name değeri mutlaka "email" olmalı -->
        <input type="email" name="email" placeholder="E-posta Adresi" required value="{{ old('email') }}" />

        <!-- Name değeri mutlaka "password" olmalı -->
        <input type="password" name="password" placeholder="Şifre" required />

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 16px;">Giriş Yap</button>
      </form>

      <p style="margin-top: 24px; font-size: 14px; color: var(--text-dim); text-align: center;">
        Hesabın yok mu? <a href="{{ route('register') }}" style="color: var(--yellow);">Hemen Üye Ol</a>
      </p>
    </div>
  </div>
</section>
@endsection
