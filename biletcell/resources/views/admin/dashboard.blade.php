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

.adm-page {
    min-height: 100vh;
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text);
    padding: 40px 24px 80px;
    position: relative;
}
.adm-page::before {
    content: '';
    position: fixed; inset: 0;
    background-image:
        linear-gradient(rgba(245,197,24,0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(245,197,24,0.025) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none; z-index: 0;
}
.adm-wrap { position: relative; z-index: 1; max-width: 1200px; margin: 0 auto; }

/* PAGE HEADER */
.page-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 36px; flex-wrap: wrap; gap: 12px;
}
.page-header h1 { font-family:'Syne',sans-serif; font-size:26px; font-weight:800; letter-spacing:-0.5px; margin:0; }
.page-header p  { color:var(--muted); font-size:13px; margin:4px 0 0; }
.badge-admin {
    background: rgba(255,77,106,0.12); color:#FF7A8A;
    border: 1px solid rgba(255,77,106,0.25);
    padding: 5px 14px; border-radius: 20px;
    font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;
}

/* FLASH */
.flash { padding:12px 18px; border-radius:12px; font-size:13px; margin-bottom:24px; display:flex; align-items:center; gap:8px; }
.flash-success { background:rgba(0,229,160,0.08); border:1px solid rgba(0,229,160,0.2); color:var(--accent2); }
.flash-error   { background:rgba(255,77,106,0.08); border:1px solid rgba(255,77,106,0.2); color:var(--danger); }

/* STAT CARDS */
.stat-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:16px; margin-bottom:32px; }
.stat-card {
    background:var(--surface); border:1px solid var(--border); border-radius:16px;
    padding:24px; position:relative; overflow:hidden; transition:transform 0.2s;
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
.stat-card.c-red    { color:var(--danger); }
.stat-icon-wrap {
    width:38px; height:38px; border-radius:10px;
    background:currentColor; opacity: 1;
    display:grid; place-items:center; margin-bottom:16px;
    position:relative;
}
.stat-icon-wrap svg { opacity: 0.15; position:absolute; }
.stat-icon-wrap::before { content:''; position:absolute; inset:0; background:currentColor; border-radius:10px; opacity:0.12; }
.stat-icon-wrap svg { opacity:1; color: currentColor; }
.stat-num  { font-family:'Syne',sans-serif; font-size:30px; font-weight:800; color:currentColor; line-height:1; }
.stat-label{ font-size:12px; color:var(--muted); margin-top:6px; }

/* SECTION */
.section { background:var(--surface); border:1px solid var(--border); border-radius:20px; margin-bottom:28px; overflow:hidden; }
.section-head {
    padding:18px 24px; border-bottom:1px solid var(--border);
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;
}
.section-title { font-family:'Syne',sans-serif; font-size:15px; font-weight:800; display:flex; align-items:center; gap:8px; }
.section-bar   { width:4px; height:18px; background:var(--accent); border-radius:2px; flex-shrink:0; }

/* SEARCH */
.search-input {
    background:var(--bg); border:1px solid var(--border); border-radius:10px;
    padding:7px 14px; font-size:13px; color:var(--text); font-family:'DM Sans',sans-serif;
    outline:none; width:200px; transition:border-color 0.2s;
}
.search-input:focus { border-color:var(--accent); }
.search-input::placeholder { color:var(--muted); }

/* TABLE */
.tbl-wrap { overflow-x:auto; }
table { width:100%; border-collapse:collapse; font-size:13px; }
thead th {
    padding:11px 20px; text-align:left;
    font-size:10px; text-transform:uppercase; letter-spacing:0.1em;
    color:var(--muted); border-bottom:1px solid var(--border); white-space:nowrap;
}
tbody tr { border-bottom:1px solid var(--border); transition:background 0.15s; }
tbody tr:last-child { border-bottom:none; }
tbody tr:hover { background:rgba(255,255,255,0.02); }
td { padding:13px 20px; vertical-align:middle; }

/* AVATAR */
.avatar {
    width:32px; height:32px; border-radius:8px;
    background:var(--surface2); display:inline-flex; align-items:center; justify-content:center;
    font-family:'Syne',sans-serif; font-weight:800; font-size:12px;
    color:var(--accent); border:1px solid var(--border); flex-shrink:0;
}

/* ROLE / STATUS BADGES */
.badge { display:inline-flex; align-items:center; gap:4px; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
.badge-r-admin     { background:rgba(255,77,106,0.12);  color:#FF7A8A;  border:1px solid rgba(255,77,106,0.25); }
.badge-r-organizer { background:rgba(77,158,255,0.12);  color:#7AB8FF;  border:1px solid rgba(77,158,255,0.25); }
.badge-r-customer  { background:rgba(255,255,255,0.06); color:var(--muted); border:1px solid var(--border); }
.badge-active    { background:rgba(0,229,160,0.1);  color:var(--accent2); border:1px solid rgba(0,229,160,0.2); }
.badge-cancelled { background:rgba(255,77,106,0.1);  color:var(--danger);  border:1px solid rgba(255,77,106,0.2); }
.badge-done      { background:rgba(255,255,255,0.06); color:var(--muted);  border:1px solid var(--border); }

/* BUTTONS */
.btn {
    display:inline-flex; align-items:center; gap:6px;
    padding:6px 14px; border-radius:8px; font-size:12px; font-weight:600;
    cursor:pointer; border:none; transition:all 0.15s; text-decoration:none;
    font-family:'DM Sans',sans-serif;
}
.btn-ghost  { background:transparent; color:var(--muted); border:1px solid var(--border); }
.btn-ghost:hover  { color:var(--text); border-color:rgba(255,255,255,0.2); }
.btn-yellow { background:rgba(245,197,24,0.1); color:var(--accent); border:1px solid rgba(245,197,24,0.25); }
.btn-yellow:hover { background:rgba(245,197,24,0.18); }
.btn-danger { background:rgba(255,77,106,0.1); color:var(--danger); border:1px solid rgba(255,77,106,0.25); }
.btn-danger:hover { background:rgba(255,77,106,0.18); }
.btn-actions { display:flex; align-items:center; gap:6px; }

.empty-row td { text-align:center; color:var(--muted); padding:32px; font-size:13px; }
</style>

<div class="adm-page">
<div class="adm-wrap">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1>Admin Paneli</h1>
            <p>Tüm sistemi buradan yönet, denetle ve kontrol et.</p>
        </div>
        <span class="badge-admin">● Tam Yetkili</span>
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
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- STAT CARDS --}}
    <div class="stat-grid">
        <div class="stat-card c-yellow">
            <div class="stat-icon-wrap">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            </div>
            <div class="stat-num">{{ $totalUsers }}</div>
            <div class="stat-label">Toplam Kullanıcı</div>
        </div>
        <div class="stat-card c-green">
            <div class="stat-icon-wrap">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
            </div>
            <div class="stat-num">₺{{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-label">Toplam Satış</div>
        </div>
        <div class="stat-card c-blue">
            <div class="stat-icon-wrap">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div class="stat-num">{{ $totalEvents }}</div>
            <div class="stat-label">Toplam Etkinlik</div>
        </div>
        <div class="stat-card c-red">
            <div class="stat-icon-wrap">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 12V22H4V12"/><path d="M22 7H2v5h20V7z"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/></svg>
            </div>
            <div class="stat-num">{{ $totalTickets }}</div>
            <div class="stat-label">Satılan Bilet</div>
        </div>
    </div>

    {{-- KULLANICI YÖNETİMİ --}}
    <div class="section">
        <div class="section-head">
            <div class="section-title">
                <div class="section-bar"></div>
                Kullanıcı Yönetimi
            </div>
            <input class="search-input" type="text" id="userSearch" placeholder="İsim veya e-posta ara...">
        </div>
        <div class="tbl-wrap">
            <table id="userTable">
                <thead>
                    <tr>
                        <th>Kullanıcı</th>
                        <th>E-posta</th>
                        <th>Rol</th>
                        <th>Kayıt Tarihi</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="avatar">{{ strtoupper(substr($user->name,0,1)) }}</div>
                            <span style="font-weight:500;">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td style="color:var(--muted);">{{ $user->email }}</td>
                    <td>
                        <span class="badge badge-r-{{ $user->role }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td style="color:var(--muted);font-size:12px;">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td>
                        @if($user->id !== auth()->id() && $user->role !== 'admin')
                            <form action="{{ route('admin.changeRole', $user->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-yellow">
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 014-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                                    {{ $user->role === 'customer' ? 'Organizatör Yap' : 'Müşteri Yap' }}
                                </button>
                            </form>
                        @else
                            <span style="color:var(--muted);font-size:12px;">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="5">Henüz kullanıcı yok.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ETKİNLİK KONTROLÜ --}}
    <div class="section">
        <div class="section-head">
            <div class="section-title">
                <div class="section-bar" style="background:var(--info);"></div>
                Etkinlik Kontrolü
            </div>
            <input class="search-input" type="text" id="eventSearch" placeholder="Etkinlik ara...">
        </div>
        <div class="tbl-wrap">
            <table id="eventTable">
                <thead>
                    <tr>
                        <th>Etkinlik</th>
                        <th>Organizatör</th>
                        <th>Tarih</th>
                        <th>Fiyat</th>
                        <th>Durum</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($events as $event)
                <tr>
                    <td style="font-weight:500;max-width:200px;">{{ $event->title }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div class="avatar" style="width:26px;height:26px;font-size:10px;">
                                {{ strtoupper(substr($event->user->name ?? '?', 0, 1)) }}
                            </div>
                            <span style="color:var(--muted);font-size:12px;">{{ $event->user->name ?? '—' }}</span>
                        </div>
                    </td>
                    <td style="color:var(--muted);font-size:12px;white-space:nowrap;">
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                    </td>
                    <td style="font-family:'Space Mono',monospace;font-size:12px;">
                        ₺{{ number_format($event->price, 2, ',', '.') }}
                    </td>
                    <td>
                        @php $s = $event->status ?? 'active'; @endphp
                        <span class="badge badge-{{ $s }}">{{ ucfirst($s) }}</span>
                    </td>
                    <td>
                        <div class="btn-actions">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-ghost">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Gör
                            </a>
                            <form action="{{ route('admin.deleteEvent', $event->id) }}" method="POST"
                                  onsubmit="return confirm('Bu etkinliği silmek istediğinize emin misiniz?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                    Sil
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="6">Henüz etkinlik yok.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

<script>
// Kullanıcı arama
document.getElementById('userSearch').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#userTable tbody tr:not(.empty-row)').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});

// Etkinlik arama
document.getElementById('eventSearch').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#eventTable tbody tr:not(.empty-row)').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>

@endsection
