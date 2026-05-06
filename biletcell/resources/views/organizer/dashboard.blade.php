@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
:root {
    --bg:      #080C14;
    --surface: #0E1520;
    --surface2:#131D2E;
    --border:  rgba(255,255,255,0.07);
    --accent:  #F5C518;
    --accent2: #00E5A0;
    --danger:  #FF4D6A;
    --info:    #4D9EFF;
    --text:    #E8EAF0;
    --muted:   #5A6072;
}
*, *::before, *::after { box-sizing: border-box; }

.org-page {
    min-height: 100vh;
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text);
    padding: 40px 24px 80px;
    position: relative;
}
.org-page::before {
    content: '';
    position: fixed; inset: 0;
    background-image:
        linear-gradient(rgba(77,158,255,0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(77,158,255,0.025) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none; z-index: 0;
}
.org-wrap { position: relative; z-index: 1; max-width: 1100px; margin: 0 auto; }

/* PAGE HEADER */
.page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:36px; flex-wrap:wrap; gap:12px; }
.page-header h1 { font-family:'Syne',sans-serif; font-size:26px; font-weight:800; letter-spacing:-0.5px; margin:0; }
.page-header p  { color:var(--muted); font-size:13px; margin:4px 0 0; }
.badge-org {
    background:rgba(77,158,255,0.12); color:#7AB8FF;
    border:1px solid rgba(77,158,255,0.25);
    padding:5px 14px; border-radius:20px;
    font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em;
}

/* FLASH */
.flash { padding:12px 18px; border-radius:12px; font-size:13px; margin-bottom:24px; display:flex; align-items:center; gap:8px; }
.flash-success { background:rgba(0,229,160,0.08); border:1px solid rgba(0,229,160,0.2); color:var(--accent2); }
.flash-error   { background:rgba(255,77,106,0.08); border:1px solid rgba(255,77,106,0.2); color:var(--danger); }

/* STAT CARDS */
.stat-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(190px,1fr)); gap:16px; margin-bottom:32px; }
.stat-card {
    background:var(--surface); border:1px solid var(--border);
    border-radius:16px; padding:24px;
    position:relative; overflow:hidden; transition:transform 0.2s;
}
.stat-card:hover { transform:translateY(-2px); }
.stat-card::after {
    content:''; position:absolute; bottom:-20px; right:-20px;
    width:80px; height:80px; border-radius:50%;
    background:currentColor; opacity:0.05;
}
.stat-card.c-yellow { color:var(--accent); }
.stat-card.c-green  { color:var(--accent2); }
.stat-card.c-blue   { color:var(--info); }
.stat-card.c-purple { color:#B97BFF; }
.stat-icon-wrap {
    width:38px; height:38px; border-radius:10px;
    display:grid; place-items:center; margin-bottom:16px;
    position:relative; background:currentColor; opacity:1;
}
.stat-icon-wrap::before { content:''; position:absolute; inset:0; border-radius:10px; background:currentColor; opacity:0.12; }
.stat-icon-wrap svg { position:relative; z-index:1; color:currentColor; }
.stat-num   { font-family:'Syne',sans-serif; font-size:28px; font-weight:800; color:currentColor; line-height:1; }
.stat-label { font-size:12px; color:var(--muted); margin-top:6px; }

/* ETKİNLİK KARTLARI */
.section { background:var(--surface); border:1px solid var(--border); border-radius:20px; overflow:hidden; }
.section-head {
    padding:18px 24px; border-bottom:1px solid var(--border);
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;
}
.section-title { font-family:'Syne',sans-serif; font-size:15px; font-weight:800; display:flex; align-items:center; gap:8px; }
.section-bar   { width:4px; height:18px; background:var(--info); border-radius:2px; flex-shrink:0; }

/* EVENT CARDS GRID */
.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 16px;
    padding: 20px;
}

.event-card {
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    transition: transform 0.2s, border-color 0.2s;
    position: relative;
}
.event-card:hover { transform: translateY(-2px); border-color: rgba(255,255,255,0.12); }

/* Renkli üst şerit — duruma göre */
.event-card::before {
    content: '';
    display: block;
    height: 3px;
    background: var(--accent);
}
.event-card.status-cancelled::before { background: var(--danger); }
.event-card.status-done::before      { background: var(--muted); }

.event-card-body { padding: 16px; }
.event-card-top  { display:flex; justify-content:space-between; align-items:flex-start; gap:8px; margin-bottom:10px; }
.event-card-title { font-family:'Syne',sans-serif; font-size:14px; font-weight:800; line-height:1.3; }
.event-card-meta  { display:flex; flex-direction:column; gap:5px; margin-bottom:14px; }
.event-meta-item  { display:flex; align-items:center; gap:6px; font-size:12px; color:var(--muted); }
.event-meta-item svg { flex-shrink:0; }

.event-card-footer {
    display:flex; align-items:center; justify-content:space-between;
    padding: 12px 16px;
    border-top: 1px solid var(--border);
    background: rgba(0,0,0,0.2);
}
.event-price {
    font-family:'Space Mono',monospace;
    font-size:14px; font-weight:700; color:var(--accent);
}

/* STATUS BADGE */
.badge { display:inline-flex; align-items:center; gap:4px; padding:3px 9px; border-radius:20px; font-size:11px; font-weight:600; }
.badge-active    { background:rgba(0,229,160,0.1);  color:var(--accent2); border:1px solid rgba(0,229,160,0.2); }
.badge-cancelled { background:rgba(255,77,106,0.1); color:var(--danger);  border:1px solid rgba(255,77,106,0.2); }
.badge-done      { background:rgba(255,255,255,0.06);color:var(--muted);  border:1px solid var(--border); }

/* BUTTONS */
.btn {
    display:inline-flex; align-items:center; gap:5px;
    padding:6px 12px; border-radius:8px; font-size:12px; font-weight:600;
    cursor:pointer; border:none; transition:all 0.15s; text-decoration:none;
    font-family:'DM Sans',sans-serif;
}
.btn-ghost  { background:transparent; color:var(--muted); border:1px solid var(--border); }
.btn-ghost:hover  { color:var(--text); border-color:rgba(255,255,255,0.2); }
.btn-yellow { background:rgba(245,197,24,0.1); color:var(--accent); border:1px solid rgba(245,197,24,0.25); }
.btn-yellow:hover { background:rgba(245,197,24,0.18); }
.btn-danger { background:rgba(255,77,106,0.1); color:var(--danger); border:1px solid rgba(255,77,106,0.25); }
.btn-danger:hover { background:rgba(255,77,106,0.18); }
.btn-blue   { background:rgba(77,158,255,0.1); color:var(--info); border:1px solid rgba(77,158,255,0.25); }
.btn-blue:hover { background:rgba(77,158,255,0.18); }
.btn-actions { display:flex; align-items:center; gap:6px; flex-wrap:wrap; }

/* ARŞİV DROPDOWN */
.archive-wrap { position:relative; display:inline-block; }
.archive-menu {
    position:absolute; bottom:calc(100% + 6px); right:0;
    background:var(--surface); border:1px solid var(--border); border-radius:10px;
    padding:4px; min-width:160px;
    box-shadow:0 10px 40px rgba(0,0,0,0.5);
    opacity:0; transform:translateY(4px); pointer-events:none;
    transition:opacity 0.15s, transform 0.15s; z-index:10;
}
.archive-wrap.open .archive-menu { opacity:1; transform:translateY(0); pointer-events:all; }
.archive-option {
    display:flex; align-items:center; gap:8px;
    padding:8px 12px; border-radius:7px; font-size:12px; font-weight:600;
    cursor:pointer; color:var(--muted); transition:background 0.15s, color 0.15s;
    border:none; background:transparent; width:100%; text-align:left; font-family:'DM Sans',sans-serif;
}
.archive-option:hover { background:rgba(255,255,255,0.05); color:var(--text); }

/* EMPTY */
.empty-state { padding:60px 24px; text-align:center; color:var(--muted); }
.empty-state svg { opacity:0.2; margin-bottom:16px; }
.empty-state p { font-size:14px; margin-bottom:20px; }
</style>

<div class="org-page">
<div class="org-wrap">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1>Organizatör Paneli</h1>
            <p>Etkinliklerini yönet, satışlarını takip et.</p>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <span class="badge-org">◆ Organizatör</span>
            <a href="{{ route('events.create') }}" class="btn btn-yellow">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Yeni Etkinlik
            </a>
        </div>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
        <div class="flash flash-success">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flash flash-error">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- STAT CARDS --}}
    <div class="stat-grid">
        <div class="stat-card c-green">
            <div class="stat-icon-wrap">
                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
            </div>
            <div class="stat-num">₺{{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-label">Toplam Kazancım</div>
        </div>
        <div class="stat-card c-yellow">
            <div class="stat-icon-wrap">
                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 12V22H4V12"/><path d="M22 7H2v5h20V7z"/></svg>
            </div>
            <div class="stat-num">{{ $totalTickets }}</div>
            <div class="stat-label">Satılan Bilet</div>
        </div>
        <div class="stat-card c-blue">
            <div class="stat-icon-wrap">
                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div class="stat-num">{{ $totalEvents }}</div>
            <div class="stat-label">Toplam Etkinlik</div>
        </div>
        <div class="stat-card c-purple">
            <div class="stat-icon-wrap">
                <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div class="stat-num">{{ $activeEvents }}</div>
            <div class="stat-label">Aktif Etkinlik</div>
        </div>
    </div>

    {{-- ETKİNLİKLERİM --}}
    <div class="section">
        <div class="section-head">
            <div class="section-title">
                <div class="section-bar"></div>
                Etkinliklerim
            </div>
            <span style="font-size:12px;color:var(--muted);">{{ $totalEvents }} etkinlik</span>
        </div>

        @if($events->isEmpty())
            <div class="empty-state">
                <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <p>Henüz etkinliğin yok.</p>
                <a href="{{ route('events.create') }}" class="btn btn-yellow">İlk Etkinliğini Oluştur</a>
            </div>
        @else
            <div class="events-grid">
                @foreach($events as $event)
                @php $status = $event->status ?? 'active'; @endphp
                <div class="event-card status-{{ $status }}">
                    <div class="event-card-body">
                        <div class="event-card-top">
                            <div class="event-card-title">{{ $event->title }}</div>
                            <span class="badge badge-{{ $status }}">{{ ucfirst($status) }}</span>
                        </div>

                        <div class="event-card-meta">
                            <div class="event-meta-item">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                            </div>
                            <div class="event-meta-item">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $event->location ?? 'Konum belirtilmemiş' }}
                            </div>
                            <div class="event-meta-item">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 12V22H4V12"/><path d="M22 7H2v5h20V7z"/></svg>
                                {{ $ticketCounts[$event->id] ?? 0 }} bilet satıldı
                            </div>
                        </div>
                    </div>

                    <div class="event-card-footer">
                        <span class="event-price">₺{{ number_format($event->price, 2, ',', '.') }}</span>

                        <div class="btn-actions">
                            {{-- Düzenle --}}
                            <a
                            href="{{ route('events.edit', $event->id) }}"
                            class="btn btn-ghost">
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Düzenle
                            </a>

                            {{-- Arşivle --}}
                            <div class="archive-wrap" id="archive-{{ $event->id }}">
                                <button class="btn btn-blue"
                                        onclick="toggleArchive({{ $event->id }})">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/></svg>
                                    Arşiv
                                </button>
                                <div class="archive-menu">
                                    <form action="{{ route('organizer.archive', $event->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="done">
                                        <button type="submit" class="archive-option">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                            Tamamlandı işaretle
                                        </button>
                                    </form>
                                    <form action="{{ route('organizer.archive', $event->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="archive-option" style="color:#FF7A8A;">
                                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                            İptal et
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Sil --}}
                            <form action="{{ route('organizer.destroy', $event->id) }}" method="POST"
                                  onsubmit="return confirm('Bu etkinliği silmek istediğinize emin misiniz?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                                    Sil
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
</div>

<script>
function toggleArchive(id) {
    const wrap = document.getElementById('archive-' + id);
    const isOpen = wrap.classList.contains('open');
    // Tüm açık menüleri kapat
    document.querySelectorAll('.archive-wrap.open').forEach(w => w.classList.remove('open'));
    if (!isOpen) wrap.classList.add('open');
}
document.addEventListener('click', function(e) {
    if (!e.target.closest('.archive-wrap')) {
        document.querySelectorAll('.archive-wrap.open').forEach(w => w.classList.remove('open'));
    }
});
</script>

@endsection
