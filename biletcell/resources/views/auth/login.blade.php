@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-gray-800 p-10 rounded-2xl border border-gray-700 shadow-2xl">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Bilet<span class="text-orange-500">Cell</span> Giriş
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mb-4">
                    <label class="text-gray-400 text-sm">E-posta Adresi</label>
                    <input name="email" type="email" required class="appearance-none rounded-lg relative block w-full px-3 py-3 border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm" placeholder="ornek@mail.com">
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Şifre</label>
                    <input name="password" type="password" required class="appearance-none rounded-lg relative block w-full px-3 py-3 border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-orange-500 focus:border-orange-500 focus:z-10 sm:text-sm" placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all">
                    Giriş Yap
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
