@extends('layouts.app')

@section('title', $event->title)

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;600;700;800;900&display=swap');

    :root {
        --yellow:        #FFD100;
        --yellow-dark:   #E6BB00;
        --yellow-light:  #FFE14D;
        --navy:          #0A1628;
        --navy-mid:      #0F2040;
        --navy-light:    #152847;
        --navy-surface:  #1A3058;
        --green:         #00C875;
        --red:           #FF4D6A;
        --orange:        #FF7D26;
        --bg:            #06090F;
        --surface:       #0C1520;
        --surface2:      #101E30;
        --surface3:      #162640;
        --border:        rgba(255,209,0,0.15);
        --border2:       rgba(255,255,255,0.07);
        --text:          #E8EDF5;
        --text-muted:    #8DA4C0;
        --text-dim:      #4D6B8A;
        --radius:        16px;
        --radius-sm:     10px;
        --radius-full:   9999px;
    }

    .seat-page-wrap {
        font-family: 'Inter', sans-serif;
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
        padding: 48px 0 80px;
    }

    /* ── BREADCRUMB ── */
    .seat-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-dim);
        margin-bottom: 36px;
        margin-top:80px;
    }
    .seat-breadcrumb span { color: var(--text-muted); }
    .seat-breadcrumb .sep { color: var(--text-dim); }
    .seat-breadcrumb .current { color: var(--yellow); font-weight: 600; }

    /* ── PAGE HEADER ── */
    .seat-page-header {
        margin-bottom: 48px;
        text-align: center;
    }
    .seat-page-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 5px 14px;
        border-radius: var(--radius-full);
        background: rgba(255,209,0,0.10);
        border: 1px solid rgba(255,209,0,0.28);
        color: var(--yellow);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.10em;
        text-transform: uppercase;
        margin-bottom: 18px;
    }
    .seat-page-label::before {
        content: '';
        width: 6px; height: 6px;
        background: var(--yellow);
        border-radius: 50%;
        display: inline-block;
    }
    .seat-page-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(22px, 3vw, 36px);
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 8px;
    }
    .seat-page-title span { color: var(--yellow); }
    .seat-page-sub {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 10px;
    }

    /* ── COUNTER PILL ── */
    .seat-counter-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 9px 22px;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--radius-full);
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
        margin-bottom: 40px;
    }
    .seat-counter-pill strong {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 900;
        color: var(--yellow);
    }
    .seat-counter-pill .divider { color: var(--text-dim); }

    /* ── LEGEND ── */
    .seat-legend {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 24px;
        margin-bottom: 36px;
        flex-wrap: wrap;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 500;
    }
    .legend-dot {
        width: 28px;
        height: 24px;
        border-radius: 6px 6px 4px 4px;
        display: inline-block;
        flex-shrink: 0;
    }
    .legend-dot-available { background: linear-gradient(135deg, #1A4D2E, #166534); border: 1px solid rgba(0,200,117,0.4); }
    .legend-dot-selected  { background: linear-gradient(135deg, var(--yellow-dark), var(--yellow)); border: 1px solid var(--yellow); }
    .legend-dot-occupied  { background: var(--surface3); border: 1px solid rgba(255,77,106,0.3); opacity: 0.6; }

    /* ── SCREEN ── */
    .seat-screen-wrap {
        text-align: center;
        margin-bottom: 44px;
    }
    .seat-screen {
        display: inline-block;
        width: min(600px, 90%);
        height: 10px;
        background: linear-gradient(90deg, transparent, rgba(255,209,0,0.6), rgba(255,209,0,0.9), rgba(255,209,0,0.6), transparent);
        border-radius: 50%;
        box-shadow: 0 0 40px rgba(255,209,0,0.25), 0 0 80px rgba(255,209,0,0.1);
        margin-bottom: 8px;
    }
    .seat-screen-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: var(--text-dim);
        font-weight: 700;
    }

    /* ── SEAT GRID ── */
    .seat-grid-card {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: var(--radius);
        padding: 36px 28px;
        max-width: 760px;
        margin: 0 auto 32px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    }
    .seat-grid {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        gap: 8px;
        justify-items: center;
    }
    .seat-btn {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 6px 6px 3px 3px;
        border: none;
        font-size: 10px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.18s ease;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    /* Available */
    .seat-btn.available {
        background: linear-gradient(160deg, #1A4D2E, #14532D);
        border: 1px solid rgba(0,200,117,0.35);
        color: rgba(255,255,255,0.75);
        box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    }
    .seat-btn.available:hover {
        background: linear-gradient(160deg, #15803d, #166534);
        border-color: var(--green);
        transform: translateY(-3px) scale(1.08);
        box-shadow: 0 6px 18px rgba(0,200,117,0.3);
        color: #fff;
    }

    /* Selected */
    .seat-btn.selected {
        background: linear-gradient(160deg, var(--yellow-dark), var(--yellow));
        border: 1px solid var(--yellow-light);
        color: #06090F;
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 6px 22px rgba(255,209,0,0.45), 0 0 0 3px rgba(255,209,0,0.2);
    }

    /* Occupied */
    .seat-btn.occupied {
        background: var(--surface3);
        border: 1px solid rgba(255,77,106,0.25);
        color: var(--text-dim);
        cursor: not-allowed;
        opacity: 0.5;
    }
    .seat-btn.occupied::after {
        content: '✕';
        font-size: 9px;
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,77,106,0.7);
    }
    .seat-btn.occupied span { opacity: 0; }

    /* Row labels */
    .seat-row-label {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        color: var(--text-dim);
        letter-spacing: 0.06em;
    }

    /* ── SUMMARY PANEL ── */
    .seat-summary {
        max-width: 760px;
        margin: 0 auto;
        background: linear-gradient(135deg, var(--navy-mid) 0%, var(--navy) 100%);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 28px 32px;
        box-shadow: 0 16px 48px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,209,0,0.08);
        animation: slideUp 0.3s ease;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .seat-summary-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }
    .seat-summary-left { flex: 1; min-width: 180px; }
    .seat-summary-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.10em;
        color: var(--text-dim);
        font-weight: 700;
        margin-bottom: 10px;
    }
    .seat-summary-seats {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .seat-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        background: rgba(255,209,0,0.12);
        border: 1px solid rgba(255,209,0,0.3);
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 700;
        color: var(--yellow);
        font-family: 'Poppins', sans-serif;
    }
    .seat-summary-price {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 2px;
        margin-right: 20px;
    }
    .seat-summary-price .price-label { font-size: 11px; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.06em; }
    .seat-summary-price .price-total {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        font-weight: 900;
        color: var(--yellow);
    }
    .seat-summary-price .price-per { font-size: 12px; color: var(--text-muted); }

    .btn-checkout {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 28px;
        background: var(--yellow);
        color: #06090F;
        border-radius: var(--radius-full);
        font-size: 14px;
        font-weight: 800;
        font-family: 'Inter', sans-serif;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.25s ease;
        box-shadow: 0 4px 20px rgba(255,209,0,0.35);
        letter-spacing: 0.01em;
    }
    .btn-checkout:hover {
        background: var(--yellow-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(255,209,0,0.5);
    }
    .btn-checkout svg { width: 17px; height: 17px; flex-shrink: 0; }

    /* ── RESPONSIVE ── */
    @media (max-width: 640px) {
        .seat-grid { grid-template-columns: repeat(5, 1fr); gap: 6px; }
        .seat-grid-card { padding: 20px 14px; }
        .seat-summary { padding: 20px; }
        .seat-summary-inner { flex-direction: column; align-items: flex-start; }
        .seat-summary-price { align-items: flex-start; }
        .btn-checkout { width: 100%; justify-content: center; }
    }
</style>

<div class="seat-page-wrap"
     x-data="{
        selectedSeats: [],
        toggleSeat(seatId) {
            if (this.selectedSeats.includes(seatId)) {
                this.selectedSeats = this.selectedSeats.filter(id => id !== seatId);
            } else {
                if (this.selectedSeats.length < 4) {
                    this.selectedSeats.push(seatId);
                } else {
                    alert('Maksimum 4 bilet seçebilirsiniz!');
                }
            }
        },
        totalPrice(unitPrice) {
            return (this.selectedSeats.length * unitPrice).toLocaleString('tr-TR');
        }
     }">

    <div class="container" style="max-width:1320px;margin:0 auto;padding:0 24px;">

        {{-- BREADCRUMB --}}
        <div class="seat-breadcrumb">
            <span>Ana Sayfa</span>
            <span class="sep">›</span>
            <span>Etkinlikler</span>
            <span class="sep">›</span>
            <span>{{ $event->title }}</span>
            <span class="sep">›</span>
            <span class="current">Koltuk Seçimi</span>
        </div>

        {{-- PAGE HEADER --}}
        <div class="seat-page-header">
            <div class="seat-page-label">🎫 Koltuk Seçimi</div>
            <h1 class="seat-page-title">
                <span>{{ $event->title }}</span>
            </h1>
            <p class="seat-page-sub">Lütfen almak istediğiniz koltukları seçin &mdash; maksimum <strong style="color:var(--yellow)">4 koltuk</strong> seçebilirsiniz.</p>
        </div>

        {{-- COUNTER --}}
        <div style="text-align:center;">
            <div class="seat-counter-pill">
                Seçilen Koltuk
                <span class="divider">|</span>
                <strong x-text="selectedSeats.length">0</strong>
                <span style="color:var(--text-dim);font-size:13px;">/ 4</span>
            </div>
        </div>

        {{-- LEGEND --}}
        <div class="seat-legend">
            <div class="legend-item">
                <span class="legend-dot legend-dot-available"></span>
                Müsait
            </div>
            <div class="legend-item">
                <span class="legend-dot legend-dot-selected"></span>
                Seçili
            </div>
            <div class="legend-item">
                <span class="legend-dot legend-dot-occupied"></span>
                Dolu
            </div>
        </div>

        {{-- SCREEN --}}
        <div class="seat-screen-wrap">
            <div class="seat-screen"></div>
            <div class="seat-screen-label">Sahne / Perde</div>
        </div>

        {{-- SEAT GRID --}}
        <div class="seat-grid-card">
            <div class="seat-grid">
                @for ($i = 1; $i <= 50; $i++)
                    @php $isFull = in_array((string)$i, $occupiedSeats); @endphp

                    <button
                        type="button"
                        class="seat-btn {{ $isFull ? 'occupied' : 'available' }}"
                        :class="selectedSeats.includes({{ $i }}) ? 'selected' : ''"
                        @click="{{ $isFull ? '' : "toggleSeat($i)" }}"
                        {{ $isFull ? 'disabled' : '' }}
                        title="Koltuk {{ $i }}{{ $isFull ? ' — Dolu' : '' }}"
                    >
                        <span>{{ $i }}</span>
                    </button>
                @endfor
            </div>
        </div>

        {{-- SUMMARY PANEL --}}
        <div class="seat-summary" x-show="selectedSeats.length > 0" x-transition>
            <div class="seat-summary-inner">

                {{-- Selected seats chips --}}
                <div class="seat-summary-left">
                    <div class="seat-summary-label">Seçilen Koltuklar</div>
                    <div class="seat-summary-seats">
                        <template x-for="seat in selectedSeats" :key="seat">
                            <span class="seat-chip">
                                🪑 #<span x-text="seat"></span>
                            </span>
                        </template>
                    </div>
                </div>

                {{-- Price --}}
                <div class="seat-summary-price">
                    <span class="price-label">Toplam Tutar</span>
                    <span class="price-total">
                        ₺<span x-text="(selectedSeats.length * {{ $event->price }}).toLocaleString('tr-TR')"></span>
                    </span>
                    <span class="price-per">{{ number_format($event->price, 0, ',', '.') }} ₺ / koltuk</span>
                </div>

                {{-- Checkout button --}}
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id"    value="{{ $event->id }}">
                    <input type="hidden" name="seat_numbers" :value="selectedSeats.join(',')">
                    <input type="hidden" name="price"       value="{{ $event->price }}">

                    <button type="submit" class="btn-checkout">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.4 5.6A1 1 0 006.6 20H17m0 0a2 2 0 100 4 2 2 0 000-4zm-11 0a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        <span x-text="selectedSeats.length"></span> Bilet İçin Ödemeye Geç
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
