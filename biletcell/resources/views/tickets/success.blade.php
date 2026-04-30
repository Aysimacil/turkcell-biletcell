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
        --navy-surface: #1A3058;
        --green:        #00C875;
        --bg:           #06090F;
        --surface:      #0C1520;
        --surface2:     #101E30;
        --surface3:     #162640;
        --border:       rgba(255,209,0,0.15);
        --border2:      rgba(255,255,255,0.07);
        --text:         #E8EDF5;
        --text-muted:   #8DA4C0;
        --text-dim:     #4D6B8A;
        --radius:       20px;
        --radius-sm:    12px;
        --radius-full:  9999px;
    }

    .success-page {
        font-family: 'Inter', sans-serif;
        background: var(--bg);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px 16px;
    }

    /* ── CONFETTI GLOW ── */
    .success-page::before {
        content: '';
        position: fixed;
        top: -200px;
        left: 50%;
        transform: translateX(-50%);
        width: 700px;
        height: 500px;
        background: radial-gradient(ellipse, rgba(255,209,0,0.08) 0%, transparent 70%);
        pointer-events: none;
    }

    /* ── TICKET CARD ── */
    .ticket-card {
        width: 100%;
        max-width: 440px;
        border-radius: var(--radius);
        overflow: visible;
        position: relative;
        animation: riseIn 0.55s cubic-bezier(0.22,1,0.36,1) both;
    }
    @keyframes riseIn {
        from { opacity: 0; transform: translateY(32px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ── SUCCESS HEADER ── */
    .ticket-header {
        background: linear-gradient(135deg, var(--navy-light) 0%, var(--navy-mid) 100%);
        border: 1px solid var(--border);
        border-bottom: none;
        border-radius: var(--radius) var(--radius) 0 0;
        padding: 40px 32px 32px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .ticket-header::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 240px; height: 240px;
        background: radial-gradient(circle, rgba(255,209,0,0.12), transparent 65%);
        pointer-events: none;
    }
    .success-icon-ring {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(0,200,117,0.12);
        border: 2px solid rgba(0,200,117,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        position: relative;
        animation: popIn 0.5s 0.25s cubic-bezier(0.22,1,0.36,1) both;
    }
    @keyframes popIn {
        from { transform: scale(0.5); opacity: 0; }
        to   { transform: scale(1);   opacity: 1; }
    }
    .success-icon-ring::after {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        border: 1px solid rgba(0,200,117,0.2);
        animation: ping 2s ease-out infinite;
    }
    @keyframes ping {
        0%   { transform: scale(1);    opacity: 0.6; }
        100% { transform: scale(1.35); opacity: 0; }
    }
    .success-icon-ring svg { width: 36px; height: 36px; color: var(--green); }

    .ticket-header-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        background: rgba(0,200,117,0.12);
        border: 1px solid rgba(0,200,117,0.3);
        border-radius: var(--radius-full);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.10em;
        text-transform: uppercase;
        color: #34EDA0;
        margin-bottom: 12px;
    }
    .ticket-header h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 22px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
    }
    .ticket-header p {
        font-size: 13px;
        color: var(--text-muted);
    }

    /* ── TEAR EDGE ── */
    .tear-edge {
        position: relative;
        height: 0;
        z-index: 1;
    }
    .tear-edge::before,
    .tear-edge::after {
        content: '';
        position: absolute;
        top: -20px;
        width: 40px;
        height: 40px;
        background: var(--bg);
        border-radius: 50%;
        border: 1px solid var(--border);
    }
    .tear-edge::before { left: -20px; }
    .tear-edge::after  { right: -20px; }

    /* ── TICKET BODY ── */
    .ticket-body {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-top: none;
        padding: 36px 32px 28px;
        position: relative;
    }
    /* Dashed separator inside body */
    .ticket-body::before {
        content: '';
        position: absolute;
        top: 0; left: 32px; right: 32px;
        border-top: 1.5px dashed rgba(255,255,255,0.08);
    }

    .ticket-event-title {
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
        line-height: 1.25;
    }
    .ticket-venue {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 28px;
    }
    .ticket-venue svg { width: 13px; height: 13px; color: var(--yellow); flex-shrink: 0; }

    .ticket-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 28px;
    }
    .ticket-meta-item {
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: var(--radius-sm);
        padding: 14px 16px;
    }
    .ticket-meta-item .meta-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.10em;
        color: var(--text-dim);
        font-weight: 700;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .ticket-meta-item .meta-label svg { width: 11px; height: 11px; }
    .ticket-meta-item .meta-value {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: var(--yellow);
        line-height: 1.2;
    }
    .ticket-meta-item .meta-value-sm {
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
        line-height: 1.4;
    }

    /* ── QR CODE ── */
    .qr-wrap {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 22px;
        text-align: center;
    }
    .qr-inner {
        display: inline-flex;
        padding: 10px;
        background: #fff;
        border-radius: 10px;
        margin-bottom: 12px;
    }
    .qr-inner img { width: 130px; height: 130px; display: block; border-radius: 6px; }
    .qr-id {
        font-size: 11px;
        color: var(--text-dim);
        text-transform: uppercase;
        letter-spacing: 0.10em;
        font-weight: 700;
    }
    .qr-id span { color: var(--text-muted); }

    /* ── TICKET FOOTER ── */
    .ticket-footer {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-top: none;
        border-radius: 0 0 var(--radius) var(--radius);
        padding: 20px 32px;
        display: flex;
        gap: 10px;
    }
    .btn-home {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 16px;
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 700;
        color: var(--text-muted);
        text-decoration: none;
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }
    .btn-home:hover {
        border-color: rgba(255,209,0,0.35);
        color: var(--text);
        background: var(--surface3);
    }
    .btn-home svg { width: 15px; height: 15px; }

    .btn-print {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 16px;
        background: var(--yellow);
        border: none;
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 800;
        color: #06090F;
        cursor: pointer;
        transition: all 0.25s;
        box-shadow: 0 4px 18px rgba(255,209,0,0.35);
        font-family: 'Inter', sans-serif;
    }
    .btn-print:hover {
        background: var(--yellow-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(255,209,0,0.5);
    }
    .btn-print svg { width: 15px; height: 15px; }

    /* ── PRINT ── */
    @media print {
        .success-page { background: #fff !important; }
        .ticket-footer { display: none; }
        .ticket-header { background: #f5f5f5 !important; }
        .ticket-body { background: #fff !important; border-color: #ddd !important; }
    }
</style>

<div class="success-page">
    <div class="ticket-card">

        {{-- HEADER --}}
        <div class="ticket-header">
            <div class="success-icon-ring">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="ticket-header-label">✓ Ödeme Başarılı</div>
            <h2>Biletiniz Hazır!</h2>
            <p>Aşağıdaki QR kodu etkinlik girişinde gösteriniz.</p>
        </div>

        {{-- TEAR EDGE --}}
        <div class="tear-edge"></div>

        {{-- BODY --}}
        <div class="ticket-body">
            <div class="ticket-event-title">{{ $ticket->event->title }}</div>
            <div class="ticket-venue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $ticket->event->venue->name }}
            </div>

            <div class="ticket-meta-grid">
                <div class="ticket-meta-item">
                    <div class="meta-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                        Koltuk No
                    </div>
                    <div class="meta-value">#{{ $ticket->seat_number }}</div>
                </div>
                <div class="ticket-meta-item">
                    <div class="meta-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Tarih & Saat
                    </div>
                    <div class="meta-value-sm">{{ $ticket->event->event_date }}</div>
                </div>
            </div>

            {{-- QR CODE --}}
            <div class="qr-wrap">
                <div class="qr-inner">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $ticket->id }}"
                         alt="QR Kod — Bilet {{ $ticket->id }}">
                </div>
                <div class="qr-id">Bilet ID: <span>{{ $ticket->id }}</span></div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="ticket-footer">
            <a href="{{ route('events.index') }}" class="btn-home">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Ana Sayfa
            </a>
            <button onclick="window.print()" class="btn-print">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Yazdır / PDF
            </button>
        </div>

    </div>
</div>

@endsection
