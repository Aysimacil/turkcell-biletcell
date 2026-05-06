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

.edit-page {
    min-height: 100vh;
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text);
    padding: 40px 24px 80px;
    position: relative;
}
.edit-page::before {
    content: '';
    position: fixed; inset: 0;
    background-image:
        linear-gradient(rgba(77,158,255,0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(77,158,255,0.025) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none; z-index: 0;
}
.edit-wrap { position: relative; z-index: 1; max-width: 780px; margin: 0 auto; }

/* PAGE HEADER */
.page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:12px; }
.page-header-left { display:flex; align-items:center; gap:14px; }
.back-btn {
    display:inline-flex; align-items:center; justify-content:center;
    width:36px; height:36px; border-radius:10px;
    background:var(--surface); border:1px solid var(--border);
    color:var(--muted); text-decoration:none; transition:all 0.15s;
}
.back-btn:hover { color:var(--text); border-color:rgba(255,255,255,0.2); }
.page-header h1 { font-family:'Syne',sans-serif; font-size:22px; font-weight:800; letter-spacing:-0.5px; margin:0; }
.page-header p  { color:var(--muted); font-size:13px; margin:3px 0 0; }
.badge-edit {
    background:rgba(245,197,24,0.1); color:var(--accent);
    border:1px solid rgba(245,197,24,0.25);
    padding:5px 14px; border-radius:20px;
    font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em;
}

/* FLASH */
.flash { padding:12px 18px; border-radius:12px; font-size:13px; margin-bottom:24px; display:flex; align-items:center; gap:8px; }
.flash-error { background:rgba(255,77,106,0.08); border:1px solid rgba(255,77,106,0.2); color:var(--danger); }

/* FORM CARD */
.form-card {
    background:var(--surface); border:1px solid var(--border);
    border-radius:20px; overflow:hidden;
}
.form-card-head {
    padding:18px 24px; border-bottom:1px solid var(--border);
    display:flex; align-items:center; gap:10px;
}
.form-card-bar { width:4px; height:18px; background:var(--accent); border-radius:2px; flex-shrink:0; }
.form-card-title { font-family:'Syne',sans-serif; font-size:14px; font-weight:800; }

.form-body { padding:28px 24px; display:flex; flex-direction:column; gap:22px; }

/* FORM GROUPS */
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
@media(max-width:560px) { .form-row { grid-template-columns:1fr; } }

.form-group { display:flex; flex-direction:column; gap:7px; }
.form-label {
    font-size:12px; font-weight:600; color:var(--muted);
    text-transform:uppercase; letter-spacing:0.07em;
}
.form-control {
    background:var(--surface2); border:1px solid var(--border);
    border-radius:10px; padding:11px 14px;
    font-size:13px; color:var(--text); font-family:'DM Sans',sans-serif;
    outline:none; transition:border-color 0.15s, box-shadow 0.15s;
    width:100%;
}
.form-control:focus {
    border-color:rgba(245,197,24,0.5);
    box-shadow:0 0 0 3px rgba(245,197,24,0.08);
}
.form-control::placeholder { color:var(--muted); }
select.form-control { cursor:pointer; }
textarea.form-control { resize:vertical; min-height:110px; line-height:1.6; }

/* CURRENT IMAGE PREVIEW */
.img-preview-wrap {
    background:var(--surface2); border:1px solid var(--border);
    border-radius:12px; padding:14px; display:flex; align-items:center; gap:14px;
}
.img-preview-thumb {
    width:64px; height:64px; border-radius:8px; object-fit:cover;
    border:1px solid var(--border); flex-shrink:0;
}
.img-preview-info { flex:1; }
.img-preview-label { font-size:11px; color:var(--muted); margin-bottom:4px; text-transform:uppercase; letter-spacing:0.07em; }
.img-preview-name  { font-size:12px; color:var(--text); font-weight:500; word-break:break-all; }
.img-new-hint { font-size:11px; color:var(--muted); margin-top:6px; }

/* FILE INPUT */
.file-input-wrap { position:relative; }
.file-input-wrap input[type="file"] {
    position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%;
}
.file-input-display {
    background:var(--surface2); border:1px solid var(--border);
    border-radius:10px; padding:11px 14px;
    font-size:13px; color:var(--muted);
    display:flex; align-items:center; gap:8px;
    transition:border-color 0.15s;
}
.file-input-wrap:hover .file-input-display {
    border-color:rgba(245,197,24,0.4); color:var(--text);
}

/* ERROR */
.field-error { font-size:11px; color:var(--danger); margin-top:2px; display:flex; align-items:center; gap:4px; }

/* DIVIDER */
.form-divider { height:1px; background:var(--border); margin:4px 0; }

/* FORM FOOTER */
.form-footer {
    padding:18px 24px; border-top:1px solid var(--border);
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;
    background:rgba(0,0,0,0.15);
}
.btn {
    display:inline-flex; align-items:center; gap:6px;
    padding:9px 18px; border-radius:10px; font-size:13px; font-weight:600;
    cursor:pointer; border:none; transition:all 0.15s; text-decoration:none;
    font-family:'DM Sans',sans-serif;
}
.btn-ghost  { background:transparent; color:var(--muted); border:1px solid var(--border); }
.btn-ghost:hover  { color:var(--text); border-color:rgba(255,255,255,0.2); }
.btn-yellow { background:rgba(245,197,24,0.12); color:var(--accent); border:1px solid rgba(245,197,24,0.3); }
.btn-yellow:hover { background:rgba(245,197,24,0.2); }
.btn-save {
    background: linear-gradient(135deg, rgba(245,197,24,0.9), rgba(245,197,24,0.7));
    color:#080C14; border:none; font-weight:700;
}
.btn-save:hover { background:var(--accent); }
</style>

<div class="edit-page">
<div class="edit-wrap">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <a href="{{ route('organizer.dashboard') }}" class="back-btn" title="Geri dön">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </a>
            <div>
                <h1>Etkinliği Düzenle</h1>
                <p>{{ $event->title }}</p>
            </div>
        </div>
        <span class="badge-edit">✎ Düzenleme Modu</span>
    </div>

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="flash flash-error" style="flex-direction:column; align-items:flex-start;">
            <div style="display:flex;align-items:center;gap:8px;font-weight:600;">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                Lütfen aşağıdaki hataları düzeltin:
            </div>
            <ul style="margin:8px 0 0 18px; padding:0; font-size:12px; color:var(--danger);">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="form-card">
        <div class="form-card-head">
            <div class="form-card-bar"></div>
            <div class="form-card-title">Etkinlik Bilgileri</div>
        </div>

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-body">

                {{-- Başlık --}}
                <div class="form-group">
                    <label class="form-label">Etkinlik Başlığı</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $event->title) }}"
                           placeholder="Etkinlik adını girin…">
                    @error('title')
                        <span class="field-error">
                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Açıklama --}}
                <div class="form-group">
                    <label class="form-label">Açıklama</label>
                    <textarea name="description" class="form-control"
                              placeholder="Etkinlik hakkında bilgi verin…">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <span class="field-error">
                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-divider"></div>

                {{-- Kategori + Mekan --}}
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select name="category" class="form-control">
                            <option value="">Seçiniz…</option>
                            @foreach(['Müzik','Spor','Tiyatro','Sinema','Konferans','Festival','Sergi','Eğitim','Diğer'] as $cat)
                                <option value="{{ $cat }}"
                                    {{ old('category', $event->category) == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="field-error">
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mekan</label>
                        <select name="venue_id" class="form-control">
                            <option value="">Mekan seçin…</option>
                            @foreach($venues as $venue)
                                <option value="{{ $venue->id }}"
                                    {{ old('venue_id', $event->venue_id) == $venue->id ? 'selected' : '' }}>
                                    {{ $venue->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('venue_id')
                            <span class="field-error">
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Tarih + Fiyat --}}
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Etkinlik Tarihi</label>
                        <input type="datetime-local" name="event_date" class="form-control"
                               value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i')) }}">
                        @error('event_date')
                            <span class="field-error">
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bilet Fiyatı (₺)</label>
                        <input type="number" name="price" class="form-control"
                               step="0.01" min="0"
                               value="{{ old('price', $event->price) }}"
                               placeholder="0.00">
                        @error('price')
                            <span class="field-error">
                                <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-divider"></div>

                {{-- Mevcut Görsel --}}
                <div class="form-group">
                    <label class="form-label">Etkinlik Görseli</label>

                    @if($event->image_path)
                        <div class="img-preview-wrap">
                            <img src="{{ Storage::url($event->image_path) }}"
                                 alt="Mevcut görsel"
                                 class="img-preview-thumb">
                            <div class="img-preview-info">
                                <div class="img-preview-label">Mevcut Görsel</div>
                                <div class="img-preview-name">{{ basename($event->image_path) }}</div>
                                <div class="img-new-hint">Değiştirmek için aşağıdan yeni bir dosya seçin.</div>
                            </div>
                        </div>
                    @endif

                    <div class="file-input-wrap" style="margin-top:{{ $event->image_path ? '10px' : '0' }};">
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg"
                               onchange="updateFileName(this)">
                        <div class="file-input-display" id="file-display">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                            <span id="file-name">{{ $event->image_path ? 'Yeni görsel seç (isteğe bağlı)' : 'Görsel seçin…' }}</span>
                        </div>
                    </div>

                    @error('image')
                        <span class="field-error">
                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>{{-- /form-body --}}

            {{-- FOOTER --}}
            <div class="form-footer">
                <a href="{{ route('organizer.dashboard') }}" class="btn btn-ghost">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                    İptal
                </a>
                <button type="submit" class="btn btn-save">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Değişiklikleri Kaydet
                </button>
            </div>

        </form>
    </div>

</div>
</div>

<script>
function updateFileName(input) {
    const display = document.getElementById('file-name');
    if (input.files && input.files[0]) {
        display.textContent = input.files[0].name;
        display.style.color = 'var(--accent2)';
    }
}
</script>

@endsection
