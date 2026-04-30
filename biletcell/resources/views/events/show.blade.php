@extends('layouts.app')

@section('title', $event->title)

@section('content')
<section style="padding: 160px 0 80px;">
  <div class="container">
    <div class="flex-header section-header">
      <div>
        <div class="section-label">{{ $event->category }}</div>
        <h2 class="section-title">{{ $event->title }}</h2>
      </div>
      <div class="tc-badge"><div class="tc-dot"></div>Turkcell Özel</div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 400px; gap: 40px; margin-top: 30px;">

      <!-- SOL TARAF: GÖRSEL VE AÇIKLAMA -->
      <div>
        <div class="event-card" style="cursor: default; transform: none; border-color: var(--border);">
          <div class="event-card-img" style="aspect-ratio: 21/9;">
            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" style="height: 100%; width: 100%; object-fit: cover;" />
            <div class="event-card-overlay"></div>
          </div>
        </div>

        <div class="newsletter" style="text-align: left; margin: 40px 0 0 0; padding: 40px;">
          <h3 class="section-title" style="font-size: 24px; margin-bottom: 20px;">Etkinlik <span>Hakkında</span></h3>
          <p class="section-subtitle" style="color: var(--text-muted); line-height: 1.8;">
            {{ $event->description }}
          </p>
        </div>
      </div>

      <!-- SAĞ TARAF: BİLET ALMA VE DETAYLAR -->
      <div style="display: flex; flex-direction: column; gap: 20px;">
        <div class="newsletter" style="text-align: left; padding: 30px; border: 1px solid var(--yellow);">
          <div class="event-price" style="margin-bottom: 20px;">
            <span class="event-price-from">ETKİNLİK FİYATI</span>
            <span class="event-price-amount" style="font-size: 42px;">₺{{ number_format($event->price, 2, ',', '.') }}</span>
          </div>

          <div style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 30px;">
            <div class="slide-meta-item">
              <span>📍</span> <strong>{{ $event->venue->title }}</strong>
            </div>
            <div class="slide-meta-item" style="font-size: 13px; color: var(--text-dim); padding-left: 25px;">
              {{ $event->venue->address }} / {{ $event->venue->city }}
            </div>
            <div class="slide-meta-item">
              <span>📅</span> <strong>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</strong>
            </div>
          </div>

          <a href="{{ route('events.selectSeat', $event->id) }}" class="btn btn-primary btn-lg" style="width: 100%; justify-content: center; font-size: 18px;">
            🎫 Koltuk Seçimine Git
          </a>

          <p style="text-align: center; font-size: 12px; color: var(--text-dim); margin-top: 15px;">
            * Paycell ile ödemelerde 256-bit SSL güvencesi.
          </p>
        </div>

        <!-- TURKCELL PROMO KUTUSU -->
        <div class="promo" style="grid-template-columns: 1fr; padding: 30px; margin: 0; border-radius: var(--radius);">
          <div class="badge badge-yellow">ÖZEL TEKLİF</div>
          <h4 style="color: #fff; margin-top: 10px;">Turkcell %10 İndirim</h4>
          <p style="font-size: 13px; color: var(--text-muted); margin-top: 5px;">Turkcell numaranızla giriş yaptığınızda indirim otomatik uygulanır.</p>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection
