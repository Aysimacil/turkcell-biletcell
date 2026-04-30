@extends('layouts.app')

@section('title', 'Etkinlik Keşfet')

@section('content')
<section class="hero">
  <div class="slide active">
    <img class="slide-bg" src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=1600&q=80" alt="Hero" />
    <div class="slide-overlay"></div><div class="slide-overlay2"></div>
    <div class="slide-content">
      <div class="badge badge-yellow">⚡ Turkcell Ayrıcalığı</div>
      <h1 class="slide-title">En Sevdiğin Etkinlikler<br/><span class="highlight">BiletCell'de</span></h1>
      <p class="slide-desc">Turkcell abonesiysen tüm biletlerde anında %10 indirim seni bekliyor. Şehrindeki en iyi konser ve tiyatroları keşfet.</p>
      <div class="slide-actions">
        <a href="#events" class="btn btn-primary btn-lg">🎫 Hemen Keşfet</a>
      </div>
    </div>
  </div>
</section>

<div class="filter-bar">
  <div class="filter-bar-inner">
    <a href="/events" class="cat-btn {{ !request('category') ? 'active' : '' }}"><span class="icon">✨</span>Tümü</a>
    <a href="/events?category=Konser" class="cat-btn {{ request('category') == 'Konser' ? 'active' : '' }}"><span class="icon">🎵</span>Konser</a>
    <a href="/events?category=Tiyatro" class="cat-btn {{ request('category') == 'Tiyatro' ? 'active' : '' }}"><span class="icon">🎭</span>Tiyatro</a>
    <div class="filter-divider"></div>
    <a href="/events?city=Adana" class="filter-select">📍 Adana</a>
  </div>
</div>

<section id="events">
  <div class="container">
    <div class="flex-header section-header">
      <div>
        <div class="section-label">GÜNCEL</div>
        <h2 class="section-title">Yaklaşan <span>Etkinlikler</span></h2>
      </div>
    </div>

    <div class="events-grid" id="eventsGrid">
      @foreach($events as $event)
      <div class="event-card fade-up">
        <div class="event-card-img">
          {{-- İlk kodundaki 'image_path' ismini kullanıyoruz --}}
          <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" />
          <div class="event-card-overlay"></div>
          <div class="event-card-badge"><span class="badge badge-yellow">{{ $event->category }}</span></div>
        </div>

        <div class="event-card-body">
          <div class="event-card-meta">
            {{-- Tarih ve Mekan bilgilerini ilk kodundaki değişkenlerle eşledik --}}
            <div class="event-card-meta-item"><span>📅</span> {{ $event->event_date }}</div>
            <div class="event-card-meta-item"><span>📍</span> {{ $event->venue->city ?? 'Şehir Belirtilmedi' }}</div>
          </div>

          <div class="event-card-title">{{ $event->title }}</div>

          <div class="event-card-footer">
            <div class="event-price">
              <span class="event-price-from">BAŞLANGIÇ</span>
              <span class="event-price-amount">₺{{ number_format($event->price, 0, ',', '.') }}</span>
            </div>
            {{-- Route ismini kontrol et: events.show --}}
            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">Bilet Al</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
