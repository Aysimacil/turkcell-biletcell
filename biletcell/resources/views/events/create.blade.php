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

    .create-page {
        font-family: 'Inter', sans-serif;
        background: var(--bg);
        min-height: 100vh;
        padding: 56px 16px 80px;
        position: relative;
    }
    .create-page::before {
        content: '';
        position: fixed;
        top: -200px; left: 50%;
        transform: translateX(-50%);
        width: 800px; height: 500px;
        background: radial-gradient(ellipse, rgba(255,209,0,0.06) 0%, transparent 70%);
        pointer-events: none;
    }

    .create-wrap {
        max-width: 680px;
        margin: 0 auto;
    }

    /* ── HEADER ── */
    .create-header {
        margin-bottom: 36px;
    }
    .create-label {
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
    .create-label::before {
        content: '';
        width: 6px; height: 6px;
        background: var(--yellow);
        border-radius: 50%;
    }
    .create-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(22px, 3vw, 32px);
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 8px;
    }
    .create-title span { color: var(--yellow); }
    .create-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* ── CARD ── */
    .create-card {
        background: var(--surface);
        border: 1px solid var(--border2);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(0,0,0,0.45);
    }

    /* ── SECTION ── */
    .form-section {
        padding: 28px 32px;
        border-bottom: 1px solid var(--border2);
    }
    .form-section:last-of-type { border-bottom: none; }
    .form-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--yellow);
        margin-bottom: 20px;
    }
    .form-section-title::before {
        content: '';
        display: block;
        width: 16px; height: 2px;
        background: var(--yellow);
        border-radius: 2px;
        flex-shrink: 0;
    }

    /* ── FIELD ── */
    .field { margin-bottom: 18px; }
    .field:last-child { margin-bottom: 0; }
    .field-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 18px;
    }
    .field-grid-2 .field { margin-bottom: 0; }

    .field label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-dim);
        margin-bottom: 8px;
    }
    .field label svg { width: 13px; height: 13px; color: var(--yellow); }
    .field label .req { color: var(--red); font-size: 10px; }

    .field input,
    .field select,
    .field textarea {
        width: 100%;
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        color: var(--text);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        -webkit-appearance: none;
        appearance: none;
    }
    .field input:focus,
    .field select:focus,
    .field textarea:focus {
        border-color: rgba(255,209,0,0.5);
        box-shadow: 0 0 0 3px rgba(255,209,0,0.08);
    }
    .field input::placeholder,
    .field textarea::placeholder { color: var(--text-dim); }
    .field select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%234D6B8A' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; background-size: 16px; padding-right: 40px; }
    .field select option { background: var(--surface2); color: var(--text); }
    .field textarea { resize: vertical; min-height: 110px; line-height: 1.6; }

    /* Price field with ₺ prefix */
    .input-prefix-wrap {
        position: relative;
    }
    .input-prefix {
        position: absolute;
        left: 14px; top: 50%; transform: translateY(-50%);
        font-size: 15px;
        font-weight: 800;
        color: var(--yellow);
        pointer-events: none;
        font-family: 'Poppins', sans-serif;
    }
    .input-prefix-wrap input { padding-left: 30px; }

    /* File upload */
    .file-upload-area {
        border: 1.5px dashed rgba(255,209,0,0.25);
        border-radius: var(--radius-sm);
        background: var(--surface2);
        padding: 32px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        position: relative;
    }
    .file-upload-area:hover {
        border-color: rgba(255,209,0,0.5);
        background: rgba(255,209,0,0.04);
    }
    .file-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    .file-upload-icon {
        width: 44px; height: 44px;
        background: rgba(255,209,0,0.10);
        border: 1px solid rgba(255,209,0,0.25);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }
    .file-upload-icon svg { width: 22px; height: 22px; color: var(--yellow); }
    .file-upload-text { font-size: 14px; color: var(--text-muted); font-weight: 500; }
    .file-upload-text span { color: var(--yellow); font-weight: 700; }
    .file-upload-hint { font-size: 12px; color: var(--text-dim); margin-top: 6px; }

    /* ── SUBMIT AREA ── */
    .create-submit {
        padding: 24px 32px;
        background: var(--surface);
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .btn-publish {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 15px 28px;
        background: var(--yellow);
        color: #06090F;
        border: none;
        border-radius: var(--radius-full);
        font-size: 15px;
        font-weight: 800;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 20px rgba(255,209,0,0.35);
        letter-spacing: 0.01em;
    }
    .btn-publish:hover {
        background: var(--yellow-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(255,209,0,0.5);
    }
    .btn-publish svg { width: 18px; height: 18px; flex-shrink: 0; }
    .btn-cancel {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 15px 22px;
        background: var(--surface2);
        border: 1px solid var(--border2);
        border-radius: var(--radius-full);
        font-size: 14px;
        font-weight: 700;
        color: var(--text-muted);
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-cancel:hover { border-color: rgba(255,77,106,0.35); color: var(--text); }

    /* Validation errors */
    .field-error {
        font-size: 12px;
        color: #FF8FA4;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .field-error::before { content: '!'; display: inline-flex; align-items: center; justify-content: center; width: 14px; height: 14px; background: rgba(255,77,106,0.2); border-radius: 50%; font-weight: 800; font-size: 9px; }

    @media (max-width: 560px) {
        .form-section { padding: 22px 18px; }
        .field-grid-2 { grid-template-columns: 1fr; }
        .create-submit { flex-direction: column; }
        .btn-cancel, .btn-publish { width: 100%; }
    }
</style>

<div class="create-page">
    <div class="create-wrap">

        {{-- HEADER --}}
        <div class="create-header">
            <div class="create-label">✦ Organizatör Paneli</div>
            <h1 class="create-title">Yeni Etkinlik <span>Oluştur</span></h1>
            <p class="create-subtitle">Etkinlik bilgilerini doldurun, yayınlandıktan sonra bilet satışı otomatik başlar.</p>
        </div>

        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())
            <div style="background:rgba(255,77,106,0.08);border:1px solid rgba(255,77,106,0.3);border-radius:var(--radius-sm);padding:16px 20px;margin-bottom:24px;">
                <p style="font-size:13px;font-weight:700;color:#FF8FA4;margin-bottom:8px;">Lütfen aşağıdaki hataları düzeltin:</p>
                @foreach ($errors->all() as $error)
                    <div class="field-error">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="create-card">
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- SECTION 1: Temel Bilgiler --}}
                <div class="form-section">
                    <div class="form-section-title">Temel Bilgiler</div>

                    <div class="field">
                        <label>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            Etkinlik Başlığı <span class="req">*</span>
                        </label>
                        <input type="text" name="title" placeholder="ör. Sertab Erener Akustik Konser"
                               value="{{ old('title') }}" required>
                        @error('title')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            Açıklama
                        </label>
                        <textarea name="description" placeholder="Etkinlik hakkında kısa bir açıklama yazın...">{{ old('description') }}</textarea>
                        @error('description')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- SECTION 2: Kategori & Mekan --}}
                <div class="form-section">
                    <div class="form-section-title">Kategori & Mekan</div>

                    <div class="field-grid-2">
                        <div class="field">
                            <label>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                Kategori <span class="req">*</span>
                            </label>
                            <select name="category">
                                <option value="Konser"   {{ old('category') == 'Konser'   ? 'selected' : '' }}>🎵 Konser</option>
                                <option value="Tiyatro"  {{ old('category') == 'Tiyatro'  ? 'selected' : '' }}>🎭 Tiyatro</option>
                                <option value="Spor"     {{ old('category') == 'Spor'     ? 'selected' : '' }}>⚽ Spor</option>
                                <option value="Sinema"   {{ old('category') == 'Sinema'   ? 'selected' : '' }}>🎬 Sinema</option>
                                <option value="Festival" {{ old('category') == 'Festival' ? 'selected' : '' }}>🎪 Festival</option>
                                <option value="StandUp"  {{ old('category') == 'StandUp'  ? 'selected' : '' }}>🎤 Stand-Up</option>
                            </select>
                            @error('category')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Mekan <span class="req">*</span>
                            </label>
                            <select name="venue_id">
                                @foreach($venues as $venue)
                                    <option value="{{ $venue->id }}" {{ old('venue_id') == $venue->id ? 'selected' : '' }}>
                                        {{ $venue->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('venue_id')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: Tarih & Fiyat --}}
                <div class="form-section">
                    <div class="form-section-title">Tarih & Fiyatlandırma</div>

                    <div class="field-grid-2">
                        <div class="field">
                            <label>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Tarih & Saat <span class="req">*</span>
                            </label>
                            <input type="datetime-local" name="event_date"
                                   value="{{ old('event_date') }}" required>
                            @error('event_date')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="field">
                            <label>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Bilet Fiyatı (₺) <span class="req">*</span>
                            </label>
                            <div class="input-prefix-wrap">
                                <span class="input-prefix">₺</span>
                                <input type="number" name="price" placeholder="0"
                                       value="{{ old('price') }}" min="0" step="0.01" required>
                            </div>
                            @error('price')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 4: Görsel --}}
                <div class="form-section">
                    <div class="form-section-title">Etkinlik Görseli</div>

                    <div class="field">
                        <label>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Görsel Yükle
                        </label>
                        <div class="file-upload-area">
                            <input type="file" name="image" accept="image/*">
                            <div class="file-upload-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            </div>
                            <div class="file-upload-text"><span>Dosya seçin</span> veya sürükleyip bırakın</div>
                            <div class="file-upload-hint">PNG, JPG, WEBP — Maks. 5 MB</div>
                        </div>
                        @error('image')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="create-submit">
                    <a href="{{ route('events.index') }}" class="btn-cancel">
                        İptal
                    </a>
                    <button type="submit" class="btn-publish">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Etkinliği Yayınla
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
