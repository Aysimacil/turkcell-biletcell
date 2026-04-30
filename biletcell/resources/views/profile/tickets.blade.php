@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;600;700;800;900&display=swap');

    :root {
        --yellow:       #FFD100;
        --yellow-dark:  #E6BB00;
        --yellow-light: #FFE14D;
        --navy:         #0A1628;
        --navy-mid:     #0F2040;
        --navy-light:   #152847;
        --green:        #00C875;
        --red:          #FF4D6A;
        --bg:           #06090F;
        --surface:      #0C1520;
        --surface2:     #101E30;
        --surface3:     #162640;
        --border:       rgba(255,209,0,0.15);
        --border2:      rgba(255,255,255,0.07);
        --text:         #E8EDF5;
        --text-muted:   #8DA4C0;
        --text-dim:     #4D6B8A;
        --radius:       16px;
        --radius-sm:    10px;
        --radius-full:  9999px;
    }

    .tickets-page {
        font-family: 'Inter', sans-serif;
        background: var(--bg);
        min-height: 100vh;
        padding: 56px 16px 80px;
        position: relative;
    }
    .tickets-page::before {
        content: '';
        position: fixed;
        top: -200px; left: 50%;
        transform: translateX(-50%);
        width: 800px; height: 500px;
        background: radial-gradient(ellipse, rgba(255,209,0,0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    .tickets-wrap { max-width: 860px; margin: 0 auto; }

    /* ── HEADER ── */
    .tickets-header { margin-bottom: 40px; }
    .tickets-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: var(--radius-full);
        background: rgba(255,209,0,0.10);
        border: 1px solid rgba(255,209,0,0.28);
        color: var(--yellow);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.10em;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .tickets-label::before {
        content: '';
        width: 6px; height: 6px;
        background: var(--yellow);
        border-radius: 50%;
    }
    .tickets-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(22px, 3vw, 32px);
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
    }
    .tickets-title span { color: var(--yellow); }
    .tickets-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 8px;
    }

    /* ── EMPTY STATE ── */
    .tickets-empty {
        text-align: center;
        padding: 72px 32px;
        background: var(--surface);
        border: 1.5px dashed rgba(255,209,0,0.18);
        border-radius: var(--radius);
    }
    .empty-icon {
        width: 72px; height: 72px;
        background: rgba(255,209,0,0.08);
        border: 1px solid rgba(255,209,0,0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .empty-icon svg { width: 34px; height: 34px; color: var(--yellow); }
    .empty-title {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 8px;
    }
    .empty-desc { font-size: 14px; color: var(--text-muted); margin-bottom: 28px; }
    .btn-explore {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 28px;
        background: var(--yellow);
        color: #06090F;
        border-radius: var(--radius-full);
        font-size: 14px;
        font-weight: 800;
        font-family: 'Inter', sans-serif;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 20px rgba(255,209,0,0.3);
    }
    .btn-explore:hover {
        background: var(--yellow-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(255,209,0,0.45);
    }
    .btn-explore svg { width: 16px; height: 16px; }

    /* ── TICKET CARD ── */
    .ticket-list { display: flex; flex-direction: column; gap: 16px; }

    .ticket-item {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: var(--radius);
        overflow: hidden;
        display: flex;
        flex-direction: row;
        transition: all 0.25s ease;
        position: relative;
    }
    .ticket-item:hover {
        border-color: rgba(255,209,0,0.25);
        box-shadow: 0 12px 40px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,209,0,0.08);
        transform: translateY(-2px);
    }

    /* Seat badge column */
    .ticket-seat-col {
        width: 90px;
        flex-shrink: 0;
        background: linear-gradient(160deg, var(--navy-light), var(--navy-mid));
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px 10px;
        position: relative;
        overflow: hidden;
        gap: 2px;
    }
    .ticket-seat-col::before {
        content: '';
        position: absolute;
        top: -30px; left: -30px;
        width: 100px; height: 100px;
        background: radial-gradient(circle, rgba(255,209,0,0.12), transparent 70%);
        pointer-events: none;
    }
    .seat-number {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        font-weight: 900;
        color: var(--yellow);
        line-height: 1;
        position: relative;
    }
    .seat-label {
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: var(--text-dim);
        position: relative;
    }

    /* Tear holes */
    .tear-hole-top,
    .tear-hole-bottom {
        position: absolute;
        left: -12px;
        width: 24px; height: 24px;
        background: var(--bg);
        border-radius: 50%;
        border: 1px solid var(--border2);
        z-index: 1;
    }
    .tear-hole-top    { top: -12px; }
    .tear-hole-bottom { bottom: -12px; }

    /* Body */
    .ticket-body {
        flex: 1;
        padding: 20px 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 0;
    }
    .ticket-top-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    .ticket-event-title {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: #fff;
        line-height: 1.25;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 360px;
    }

    /* Status badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: var(--radius-full);
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .status-badge::before {
        content: '';
        width: 5px; height: 5px;
        border-radius: 50%;
    }
    .status-confirmed {
        background: rgba(0,200,117,0.10);
        color: #34EDA0;
        border: 1px solid rgba(0,200,117,0.28);
    }
    .status-confirmed::before { background: var(--green); }
    .status-pending {
        background: rgba(255,209,0,0.10);
        color: var(--yellow);
        border: 1px solid rgba(255,209,0,0.28);
    }
    .status-pending::before { background: var(--yellow); }

    .ticket-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 12px;
    }
    .ticket-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--text-muted);
    }
    .ticket-meta-item svg { width: 13px; height: 13px; color: var(--yellow); flex-shrink: 0; }

    .ticket-price {
        font-family: 'Poppins', sans-serif;
        font-size: 20px;
        font-weight: 900;
        color: var(--yellow);
        line-height: 1;
    }
    .ticket-price span {
        font-size: 12px;
        color: var(--text-dim);
        font-weight: 500;
        margin-left: 2px;
    }

    /* Action column */
    .ticket-action-col {
        flex-shrink: 0;
        border-left: 1px dashed rgba(255,255,255,0.07);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 20px;
    }
    .btn-view {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 14px 18px;
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: var(--radius-sm);
        font-size: 12px;
        font-weight: 700;
        color: var(--text-muted);
        text-decoration: none;
        transition: all 0.2s;
        text-align: center;
    }
    .btn-view svg { width: 20px; height: 20px; color: var(--yellow); }
    .btn-view:hover {
        background: rgba(255,209,0,0.08);
        border-color: rgba(255,209,0,0.35);
        color: var(--text);
        transform: scale(1.05);
    }

    @media (max-width: 560px) {
        .ticket-item { flex-direction: column; }
        .ticket-seat-col {
            width: 100%;
            flex-direction: row;
            padding: 14px 20px;
            gap: 10px;
            border-right: none;
            border-bottom: 1px solid var(--border);
        }
        .tear-hole-top, .tear-hole-bottom { display: none; }
        .ticket-action-col {
            border-left: none;
            border-top: 1px dashed rgba(255,255,255,0.07);
            padding: 16px 20px;
        }
        .btn-view { flex-direction: row; width: 100%; justify-content: center; }
        .ticket-event-title { max-width: 100%; }
    }
</style>

<div class="tickets-page">
    <div class="tickets-wrap">

        {{-- HEADER --}}
        <div class="tickets-header">
            <div class="tickets-label">🎫 Cüzdanım</div>
            <h1 class="tickets-title">Biletlerim <span>({{ $tickets->count() }})</span></h1>
            <p class="tickets-subtitle">Satın aldığınız tüm etkinlik biletleri burada listeleniyor.</p>
        </div>

        @if($tickets->isEmpty())
            {{-- EMPTY STATE --}}
            <div class="tickets-empty">
                <div class="empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
                <div class="empty-title">Henüz biletiniz yok</div>
                <p class="empty-desc">İlk biletinizi almak için etkinlikleri keşfedin.</p>
                <a href="{{ route('events.index') }}" class="btn-explore">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    Etkinlikleri Keşfet
                </a>
            </div>

        @else
            <div class="ticket-list">
                @foreach($tickets as $ticket)
                    <div class="ticket-item">

                        {{-- SEAT COL --}}
                        <div class="ticket-seat-col">
                            <div class="tear-hole-top"></div>
                            <div class="seat-number">#{{ $ticket->seat_number }}</div>
                            <div class="seat-label">Koltuk</div>
                            <div class="tear-hole-bottom"></div>
                        </div>

                        {{-- BODY --}}
                        <div class="ticket-body">
                            <div class="ticket-top-row">
                                <div class="ticket-event-title">{{ $ticket->event->title }}</div>
                                @if($ticket->status == 'confirmed')
                                    <span class="status-badge status-confirmed">Onaylandı</span>
                                @else
                                    <span class="status-badge status-pending">Beklemede</span>
                                @endif
                            </div>

                            <div class="ticket-meta">
                                <div class="ticket-meta-item">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $ticket->event->venue->title ?? 'Konum Belirtilmedi' }}
                                </div>
                                <div class="ticket-meta-item">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $ticket->event->event_date->format('d.m.Y H:i') }}
                                </div>
                            </div>

                            <div class="ticket-price">
                                {{ number_format($ticket->price, 2, ',', '.') }}
                                <span>TL</span>
                            </div>
                        </div>

                        {{-- ACTION --}}
                        <div class="ticket-action-col">
                            <a href="{{ route('tickets.success', $ticket->id) }}" class="btn-view">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                                Bileti Gör
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>

@endsection
