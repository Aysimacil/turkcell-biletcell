@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4">
    <div class="max-w-md w-full space-y-8 bg-gray-800 p-10 rounded-2xl border border-gray-700">
        <h2 class="text-center text-3xl font-extrabold text-white">Bilet<span class="text-orange-500">Cell</span> Kayıt</h2>
        <form action="{{ route('register.post') }}" method="POST">
    @csrf

    <div class="mb-4">
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Ad Soyad" required
               class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600">
    </div>

    <div class="mb-4">
        <input type="text" name="gsm" value="{{ old('gsm') }}" placeholder="Telefon Numarası (Örn: 05xx)" required
               class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600">
    </div>

    <div class="mb-4">
        <input type="password" name="password" placeholder="Şifre (En az 6 karakter)" required
               class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600">
    </div>

    <div class="mb-4">
        <input type="password" name="password_confirmation" placeholder="Şifre Tekrar" required
               class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600">
    </div>

    <button type="submit" class="w-full py-3 bg-orange-600 text-white font-bold rounded-lg hover:bg-orange-700 transition-all">
        Kayıt Ol ve Devam Et
    </button>
</form>
        <p class="text-center text-gray-400 text-sm mt-4">Zaten hesabın var mı? <a href="{{ route('login') }}" class="text-orange-500">Giriş Yap</a></p>
    </div>
</div>
@endsection
