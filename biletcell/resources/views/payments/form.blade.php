@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    :root {
        --bg:      #080C14;
        --surface: #0E1520;
        --border:  rgba(255,255,255,0.07);
        --accent:  #F5C518;
        --accent2: #00E5A0;
        --danger:  #FF4D6A;
        --text:    #E8EAF0;
        --muted:   #5A6072;
    }

    .pay-page {
        min-height: 100vh;
        background: var(--bg);
        font-family: 'DM Sans', sans-serif;
        color: var(--text);
        padding: 48px 16px 80px;
        position: relative;
        overflow: hidden;
    }

    .pay-page::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image:
            linear-gradient(rgba(245,197,24,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(245,197,24,0.03) 1px, transparent 1px);
        background-size: 48px 48px;
        pointer-events: none;
        z-index: 0;
    }

    .blob { position: fixed; border-radius: 50%; filter: blur(120px); pointer-events: none; z-index: 0; }
    .blob-1 { width: 500px; height: 500px; background: rgba(245,197,24,0.06); top: -100px; left: -150px; }
    .blob-2 { width: 400px; height: 400px; background: rgba(0,229,160,0.04); bottom: -100px; right: -100px; }

    .pay-wrap { position: relative; z-index: 1; max-width: 1060px; margin: 0 auto; }

    /* HEADER */
    .pay-header { display: flex; flex-direction: column; align-items: center; margin-bottom: 52px; gap: 10px; }
    .pay-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 4px; }
    .pay-logo-mark {
        width: 48px; height: 48px;
        background: var(--accent);
        border-radius: 14px;
        display: grid; place-items: center;
        font-family: 'Syne', sans-serif; font-weight: 800; font-size: 22px; color: #000;
        box-shadow: 0 0 40px rgba(245,197,24,0.3);
    }
    .pay-logo-text { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800; letter-spacing: -0.5px; }
    .pay-logo-text span { color: var(--accent); }
    .pay-title { font-family: 'Syne', sans-serif; font-size: 28px; font-weight: 800; letter-spacing: -1px; }
    .pay-subtitle { font-size: 12px; color: var(--muted); display: flex; align-items: center; gap: 8px; }
    .pay-subtitle::before, .pay-subtitle::after { content: ''; width: 28px; height: 1px; background: var(--border); }

    /* GRID */
    .pay-grid { display: grid; grid-template-columns: 1fr 340px; gap: 24px; align-items: start; }
    @media (max-width: 800px) { .pay-grid { grid-template-columns: 1fr; } }

    /* KART ÖNİZLEME */
    .card-preview {
        position: relative; height: 210px; border-radius: 20px; padding: 28px;
        overflow: hidden;
        background: linear-gradient(135deg, #131B2E 0%, #0A1018 100%);
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 24px 60px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.06);
        transition: transform 0.3s ease;
        margin-bottom: 20px;
    }
    .card-preview:hover { transform: translateY(-3px); }
    .card-preview::before {
        content: ''; position: absolute; top: -60px; right: -60px;
        width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(245,197,24,0.08) 0%, transparent 70%);
        border-radius: 50%;
    }
    .card-chip {
        width: 44px; height: 34px;
        background: linear-gradient(135deg, #D4A929, #F5C518, #B8941F);
        border-radius: 7px; position: relative; overflow: hidden;
    }
    .card-chip::after {
        content: ''; position: absolute; inset: 0;
        background: repeating-linear-gradient(0deg, transparent, transparent 6px, rgba(0,0,0,0.15) 6px, rgba(0,0,0,0.15) 7px);
    }
    .card-brand { position: absolute; top: 24px; right: 28px; font-family: 'Syne', sans-serif; font-weight: 800; font-size: 18px; font-style: italic; color: #fff; }
    .card-brand span { color: var(--accent); }
    .card-number-preview { font-family: 'Space Mono', monospace; font-size: 19px; letter-spacing: 0.12em; color: #fff; margin-top: 28px; }
    .card-footer { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 20px; }
    .card-label { font-size: 9px; text-transform: uppercase; letter-spacing: 0.15em; color: var(--muted); margin-bottom: 4px; }
    .card-value { font-family: 'Space Mono', monospace; font-size: 13px; color: #fff; font-weight: 700; }

    /* FORM */
    .form-panel { background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 32px; }
    .field-label { display: block; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.12em; color: var(--muted); margin-bottom: 8px; }
    .field-input {
        width: 100%; box-sizing: border-box;
        background: var(--bg); border: 1px solid var(--border); border-radius: 12px;
        padding: 14px 16px;
        font-family: 'Space Mono', monospace; font-size: 15px; color: var(--text);
        outline: none; transition: border-color 0.2s, box-shadow 0.2s;
    }
    .field-input::placeholder { color: var(--muted); font-size: 13px; }
    .field-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(245,197,24,0.1); }
    .field-group { margin-bottom: 20px; }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
    .error-msg { font-size: 11px; color: var(--danger); margin-top: 5px; }

    .btn-pay {
        width: 100%; background: var(--accent); color: #000; border: none; border-radius: 12px;
        padding: 16px; font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 800;
        letter-spacing: 0.02em; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 10px;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 8px 32px rgba(245,197,24,0.2);
        margin-top: 8px;
    }
    .btn-pay:hover { background: #FFD740; transform: translateY(-1px); box-shadow: 0 12px 40px rgba(245,197,24,0.35); }
    .btn-pay:active { transform: translateY(0); }

    .security-strip { display: flex; justify-content: center; gap: 20px; margin-top: 20px; flex-wrap: wrap; }
    .security-item { display: flex; align-items: center; gap: 6px; font-size: 11px; color: var(--muted); }
    .security-dot { width: 6px; height: 6px; background: var(--accent2); border-radius: 50%; }

    /* SİPARİŞ */
    .order-panel { background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 28px; position: sticky; top: 24px; }
    .order-title { font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 800; display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
    .order-title-bar { width: 4px; height: 20px; background: var(--accent); border-radius: 2px; }
    .order-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 8px; padding: 13px 0; border-bottom: 1px solid var(--border); font-size: 13px; }
    .order-row:last-of-type { border-bottom: none; }
    .order-row-label { color: var(--muted); }
    .order-row-value { font-weight: 500; text-align: right; }
    .seat-badge { font-family: 'Space Mono', monospace; font-size: 12px; color: var(--accent); background: rgba(245,197,24,0.08); border: 1px solid rgba(245,197,24,0.2); padding: 3px 10px; border-radius: 6px; }
    .discount-row { display: flex; justify-content: space-between; background: rgba(0,229,160,0.06); border: 1px solid rgba(0,229,160,0.15); border-radius: 10px; padding: 11px 14px; font-size: 13px; margin: 4px 0; }
    .discount-label { color: var(--accent2); font-weight: 500; }
    .discount-value { color: var(--accent2); font-weight: 700; }
    .total-row { display: flex; justify-content: space-between; align-items: center; padding-top: 16px; margin-top: 4px; }
    .total-label { font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 800; }
    .total-value { font-family: 'Syne', sans-serif; font-size: 26px; font-weight: 800; color: var(--accent); }

    .test-cards { margin-top: 22px; background: rgba(255,255,255,0.02); border: 1px dashed rgba(255,255,255,0.1); border-radius: 12px; padding: 16px; }
    .test-cards-title { font-size: 9px; text-transform: uppercase; letter-spacing: 0.2em; color: var(--muted); margin-bottom: 10px; }
    .test-card-item { font-family: 'Space Mono', monospace; font-size: 11px; padding: 5px 0; display: flex; align-items: center; gap: 8px; }
    .test-card-ok  { color: var(--accent2); }
    .test-card-err { color: var(--danger); }

    .error-banner { background: rgba(255,77,106,0.1); border: 1px solid rgba(255,77,106,0.3); border-radius: 12px; padding: 14px 18px; font-size: 13px; color: #FF7A8A; margin-bottom: 28px; display: flex; align-items: center; gap: 10px; }
</style>

<div class="pay-page">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="pay-wrap">

        <div class="pay-header">
            <div class="pay-logo">
                <div class="pay-logo-mark">P</div>
                <div class="pay-logo-text">Pay<span>cell</span></div>
            </div>
            <div class="pay-title">Güvenli Ödeme</div>
            <div class="pay-subtitle">SSL ile şifrelenmiş bağlantı</div>
        </div>

        @if (session('error'))
        <div class="error-banner">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        <div class="pay-grid">

            {{-- SOL --}}
            <div>
                <div class="card-preview">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                        <div class="card-chip"></div>
                        <div class="card-brand">Pay<span>cell</span></div>
                    </div>
                    <div class="card-number-preview" id="preview-number">••••&nbsp;&nbsp;••••&nbsp;&nbsp;••••&nbsp;&nbsp;••••</div>
                    <div class="card-footer">
                        <div>
                            <div class="card-label">Kart Sahibi</div>
                            <div class="card-value" style="text-transform:uppercase">{{ auth()->user()->name }}</div>
                        </div>
                        <div style="text-align:right">
                            <div class="card-label">Son Kul.</div>
                            <div class="card-value" id="preview-expiry">MM/YY</div>
                        </div>
                    </div>
                </div>

                <div class="form-panel">
                    <form action="{{ route('payment.process', $ticket->id) }}" method="POST">
                        @csrf

                        <div class="field-group">
                            <label class="field-label">Kart Numarası</label>
                            <input type="text" name="card_number" id="card_number"
                                   placeholder="4242  4242  4242  4242"
                                   maxlength="19" class="field-input" required>
                            @error('card_number')<div class="error-msg">{{ $message }}</div>@enderror
                        </div>

                        <div class="field-row">
                            <div>
                                <label class="field-label">Son Kullanma</label>
                                <input type="text" id="card_expiry" name="card_expiry"
                                       placeholder="MM/YY" maxlength="5" class="field-input" required>
                                @error('card_expiry')<div class="error-msg">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label class="field-label">CVV</label>
                                <input type="password" name="cvv"
                                       placeholder="•••" maxlength="4" class="field-input" required>
                                @error('cvv')<div class="error-msg">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <button type="submit" class="btn-pay">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Ödemeyi Onayla & Bilet Al
                        </button>
                    </form>

                    <div class="security-strip">
                        <div class="security-item"><div class="security-dot"></div>256-bit SSL</div>
                        <div class="security-item"><div class="security-dot"></div>3D Secure</div>
                        <div class="security-item"><div class="security-dot"></div>PCI DSS</div>
                    </div>
                </div>
            </div>

            {{-- SAĞ --}}
            <div>
                <div class="order-panel">
                    <div class="order-title">
                        <div class="order-title-bar"></div>
                        Sipariş Detayı
                    </div>

                    <div class="order-row">
                        <span class="order-row-label">Etkinlik</span>
                        <span class="order-row-value">{{ $ticket->event->title }}</span>
                    </div>
                    <div class="order-row">
                        <span class="order-row-label">Koltuk</span>
                        <span class="seat-badge">#{{ $ticket->seat_number }}</span>
                    </div>
                    <div class="order-row" style="border-bottom:none; padding-bottom:6px;">
                        <span class="order-row-label">Bilet Tutarı</span>
                        <span class="order-row-value">₺{{ number_format($ticket->price / 0.9, 2, ',', '.') }}</span>
                    </div>

                    <div class="discount-row">
                        <span class="discount-label">Turkcell İndirimi</span>
                        <span class="discount-value">−%10</span>
                    </div>

                    <div class="total-row">
                        <span class="total-label">Toplam</span>
                        <span class="total-value">₺{{ number_format($ticket->price, 2, ',', '.') }}</span>
                    </div>

                    <div class="test-cards">
                        <div class="test-cards-title">Test Kartları</div>
                        <div class="test-card-item test-card-ok">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            4242 4242 4242 4242
                        </div>
                        <div class="test-card-item test-card-err">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            4000 0000 0000 0002
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const cardInput   = document.getElementById('card_number');
    const expiryInput = document.getElementById('card_expiry');

    if (cardInput) {
        cardInput.addEventListener('input', function (e) {
            let val = e.target.value.replace(/\D/g, '');
            let formatted = val.match(/.{1,4}/g)?.join(' ') || '';
            e.target.value = formatted;
            const preview = document.getElementById('preview-number');
            if (preview) {
                let raw = formatted.replace(/ /g, '');
                let groups = [];
                for (let i = 0; i < 4; i++) {
                    let chunk = raw.slice(i * 4, i * 4 + 4);
                    groups.push(chunk.padEnd(4, '•'));
                }
                preview.innerHTML = groups.join('&nbsp;&nbsp;');
            }
        });
    }

    if (expiryInput) {
        expiryInput.addEventListener('input', function (e) {
            let val = e.target.value.replace(/\D/g, '');
            if (val.length >= 2) val = val.slice(0, 2) + '/' + val.slice(2, 4);
            e.target.value = val;
            const preview = document.getElementById('preview-expiry');
            if (preview) preview.innerText = val || 'MM/YY';
        });
    }
</script>

@endsection
