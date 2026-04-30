<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BiletCell — @yield('title', 'Etkinlik Platformu')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet" />

  <style>
    /* biletcell.html içindeki tüm CSS kodlarını ( <style> etiketleri arası ) buraya yapıştır */
         *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; background: #06090F; color: #E8EDF5; overflow-x: hidden; }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }
    button { cursor: pointer; border: none; background: none; font-family: inherit; }
    ul { list-style: none; }

    :root {
      --yellow: #FFD100;
      --yellow-dark: #E6BB00;
      --yellow-light: #FFE14D;
      --navy: #0A1628;
      --navy-mid: #0F2040;
      --navy-light: #152847;
      --navy-surface: #1A3058;
      --blue: #1A5CCC;
      --blue-light: #2E74E8;
      --teal: #00B4C8;
      --teal-light: #22D4EA;
      --green: #00C875;
      --red: #FF4D6A;
      --orange: #FF7D26;
      --bg: #06090F;
      --surface: #0C1520;
      --surface2: #101E30;
      --surface3: #162640;
      --border: rgba(255,209,0,0.15);
      --border2: rgba(255,255,255,0.07);
      --text: #E8EDF5;
      --text-muted: #8DA4C0;
      --text-dim: #4D6B8A;
      --radius: 16px;
      --radius-sm: 10px;
      --radius-full: 9999px;
    }

    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--bg); }
    ::-webkit-scrollbar-thumb { background: var(--yellow-dark); border-radius: 3px; }

    .container { max-width: 1320px; margin: 0 auto; padding: 0 24px; }

    .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: var(--radius-full); font-size: 11px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; }
    .badge-yellow  { background: rgba(255,209,0,0.12); color: var(--yellow); border: 1px solid rgba(255,209,0,0.3); }
    .badge-blue    { background: rgba(26,92,204,0.15); color: #6AAEFF; border: 1px solid rgba(26,92,204,0.35); }
    .badge-teal    { background: rgba(0,180,200,0.12); color: var(--teal-light); border: 1px solid rgba(0,180,200,0.3); }
    .badge-green   { background: rgba(0,200,117,0.12); color: #34EDA0; border: 1px solid rgba(0,200,117,0.28); }
    .badge-red     { background: rgba(255,77,106,0.12); color: #FF8FA4; border: 1px solid rgba(255,77,106,0.28); }
    .badge-orange  { background: rgba(255,125,38,0.12); color: #FFAA6E; border: 1px solid rgba(255,125,38,0.28); }

    .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: var(--radius-full); font-size: 14px; font-weight: 700; transition: all 0.25s ease; white-space: nowrap; letter-spacing: 0.01em; }
    .btn-primary { background: var(--yellow); color: #06090F; box-shadow: 0 4px 20px rgba(255,209,0,0.3); }
    .btn-primary:hover { background: var(--yellow-light); transform: translateY(-2px); box-shadow: 0 8px 32px rgba(255,209,0,0.45); }
    .btn-outline { background: transparent; color: var(--text); border: 1px solid rgba(255,255,255,0.14); }
    .btn-outline:hover { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.25); }
    .btn-navy { background: var(--navy-light); color: var(--yellow); border: 1px solid rgba(255,209,0,0.25); }
    .btn-navy:hover { background: var(--navy-surface); border-color: rgba(255,209,0,0.45); transform: translateY(-1px); }
    .btn-sm { padding: 8px 18px; font-size: 13px; }
    .btn-lg { padding: 15px 36px; font-size: 15px; }

    /* ── HEADER ── */
    #header { position: fixed; top: 40px; left: 0; right: 0; z-index: 1000; transition: all 0.3s ease; padding: 0 24px; }
    #header.scrolled { background: rgba(6,9,15,0.95); backdrop-filter: blur(24px); border-bottom: 1px solid var(--border); box-shadow: 0 4px 40px rgba(0,0,0,0.5); }
    .header-inner { max-width: 1320px; margin: 0 auto; height: 72px; display: flex; align-items: center; gap: 24px; }

    .logo { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
    .logo-icon { width: 38px; height: 38px; background: var(--yellow); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
    .logo-icon svg { width: 20px; height: 20px; fill: #06090F; }
    .logo-text { font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 800; color: #fff; }
    .logo-text span { color: var(--yellow); }

    .nav { display: flex; align-items: center; gap: 2px; margin-left: 12px; }
    .nav a { padding: 8px 14px; border-radius: var(--radius-full); font-size: 14px; font-weight: 500; color: var(--text-muted); transition: all 0.2s; }
    .nav a:hover, .nav a.active { color: #fff; background: rgba(255,255,255,0.07); }

    .search-bar { flex: 1; max-width: 360px; display: flex; align-items: center; gap: 10px; background: var(--surface2); border: 1px solid var(--border2); border-radius: var(--radius-full); padding: 0 16px; transition: all 0.2s; }
    .search-bar:focus-within { border-color: rgba(255,209,0,0.5); box-shadow: 0 0 0 3px rgba(255,209,0,0.1); }
    .search-bar svg { width: 16px; height: 16px; color: var(--text-dim); flex-shrink: 0; }
    .search-bar input { flex: 1; background: none; border: none; outline: none; font-size: 14px; color: var(--text); padding: 10px 0; font-family: inherit; }
    .search-bar input::placeholder { color: var(--text-dim); }

    .header-actions { display: flex; align-items: center; gap: 10px; margin-left: auto; }
    .tc-badge { display: flex; align-items: center; gap: 6px; padding: 6px 14px; background: rgba(255,209,0,0.08); border: 1px solid rgba(255,209,0,0.25); border-radius: var(--radius-full); font-size: 12px; font-weight: 700; color: var(--yellow); }
    .tc-dot { width: 6px; height: 6px; background: var(--green); border-radius: 50%; animation: pulse 2s infinite; }
    @keyframes pulse { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.4); opacity: 0.7; } }

    /* ── HERO ── */
    .hero { position: relative; height: 92vh; min-height: 640px; max-height: 900px; overflow: hidden; margin-top: 112px; }
    .slide { position: absolute; inset: 0; opacity: 0; transition: opacity 0.9s ease; }
    .slide.active { opacity: 1; }
    .slide-bg { width: 100%; height: 100%; object-fit: cover; transform: scale(1.05); transition: transform 8s ease; filter: brightness(0.45) saturate(0.8); }
    .slide.active .slide-bg { transform: scale(1); }
    .slide-overlay { position: absolute; inset: 0; background: linear-gradient(105deg, rgba(6,9,15,0.97) 0%, rgba(6,9,15,0.75) 40%, rgba(6,9,15,0.2) 100%); }
    .slide-overlay2 { position: absolute; bottom: 0; left: 0; right: 0; height: 340px; background: linear-gradient(to top, var(--bg), transparent); }

    .slide-content { position: absolute; top: 50%; transform: translateY(-50%); left: 80px; max-width: 620px; display: flex; flex-direction: column; }
    .slide-content .badge { margin-bottom: 22px; width: fit-content; }
    .slide-title { font-family: 'Poppins', sans-serif; font-size: clamp(34px, 5vw, 64px); font-weight: 900; line-height: 1.08; color: #fff; margin-bottom: 18px; }
    .slide-title .highlight { color: var(--yellow); }
    .slide-desc { font-size: 16px; color: var(--text-muted); line-height: 1.75; margin-bottom: 32px; max-width: 500px; }
    .slide-meta { display: flex; gap: 24px; margin-bottom: 36px; flex-wrap: wrap; }
    .slide-meta-item { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-muted); }
    .slide-meta-item svg { width: 15px; height: 15px; color: var(--yellow); flex-shrink: 0; }
    .slide-meta-item span { color: #fff; font-weight: 600; }
    .slide-actions { display: flex; gap: 12px; flex-wrap: wrap; }

    .slider-dots { position: absolute; bottom: 120px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; }
    .dot { width: 8px; height: 8px; border-radius: 4px; background: rgba(255,255,255,0.25); cursor: pointer; transition: all 0.35s; }
    .dot.active { width: 30px; background: var(--yellow); }

    .slider-nav { position: absolute; top: 50%; transform: translateY(-50%); display: flex; gap: 8px; right: 40px; flex-direction: column; }
    .slider-btn { width: 44px; height: 44px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; transition: all 0.2s; cursor: pointer; }
    .slider-btn:hover { background: var(--yellow); border-color: var(--yellow); }
    .slider-btn:hover svg { color: #06090F; }
    .slider-btn svg { width: 18px; height: 18px; color: #fff; }

    .hero-price-card { position: absolute; right: 80px; bottom: 160px; background: rgba(12,21,32,0.92); border: 1px solid rgba(255,209,0,0.2); border-radius: var(--radius); padding: 22px 28px; backdrop-filter: blur(24px); animation: float 4s ease-in-out infinite; }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .hero-price-card .label { font-size: 11px; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px; }
    .hero-price-card .price { font-family: 'Poppins', sans-serif; font-size: 36px; font-weight: 900; color: var(--yellow); }
    .hero-price-card .discount { font-size: 12px; color: var(--green); margin-top: 6px; font-weight: 700; display: flex; align-items: center; gap: 4px; }

    .scroll-indicator { position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; gap: 8px; color: var(--text-dim); font-size: 10px; text-transform: uppercase; letter-spacing: 0.12em; animation: bounce 2.2s ease-in-out infinite; }
    .scroll-indicator svg { width: 20px; height: 20px; }
    @keyframes bounce { 0%, 100% { transform: translateX(-50%) translateY(0); } 50% { transform: translateX(-50%) translateY(7px); } }

    /* ── FILTER BAR ── */
    .filter-bar { background: var(--surface); border-bottom: 1px solid var(--border2); position: sticky; top: 112px; z-index: 100; }
    .filter-bar-inner { display: flex; align-items: center; gap: 8px; padding: 14px 24px; overflow-x: auto; scrollbar-width: none; max-width: 1320px; margin: 0 auto; }
    .filter-bar-inner::-webkit-scrollbar { display: none; }
    .cat-btn { display: flex; align-items: center; gap: 8px; padding: 9px 20px; background: var(--surface2); border: 1px solid var(--border2); border-radius: var(--radius-full); font-size: 13px; font-weight: 600; color: var(--text-muted); cursor: pointer; white-space: nowrap; transition: all 0.2s; }
    .cat-btn .icon { font-size: 15px; }
    .cat-btn:hover, .cat-btn.active { background: rgba(255,209,0,0.1); border-color: rgba(255,209,0,0.4); color: var(--yellow); }
    .filter-divider { width: 1px; height: 26px; background: var(--border2); flex-shrink: 0; margin: 0 4px; }
    .filter-select { display: flex; align-items: center; gap: 7px; padding: 9px 16px; background: var(--surface2); border: 1px solid var(--border2); border-radius: var(--radius-full); font-size: 13px; font-weight: 500; color: var(--text-muted); cursor: pointer; white-space: nowrap; transition: all 0.2s; }
    .filter-select:hover { border-color: rgba(255,209,0,0.3); color: var(--text); }
    .filter-select svg { width: 14px; height: 14px; }

    /* ── SECTIONS ── */
    section { padding: 80px 0; }
    .section-header { margin-bottom: 48px; }
    .section-label { display: flex; align-items: center; gap: 10px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.14em; color: var(--yellow); margin-bottom: 12px; }
    .section-label::before { content: ''; display: block; width: 20px; height: 2px; background: var(--yellow); border-radius: 2px; }
    .section-title { font-family: 'Poppins', sans-serif; font-size: clamp(24px, 3vw, 38px); font-weight: 800; line-height: 1.2; color: #fff; }
    .section-title span { color: var(--yellow); }
    .section-subtitle { font-size: 16px; color: var(--text-muted); margin-top: 12px; line-height: 1.7; }
    .flex-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 24px; }

    /* ── EVENTS GRID ── */
    .events-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 22px; }
    .event-card { background: var(--surface); border: 1px solid var(--border2); border-radius: var(--radius); overflow: hidden; cursor: pointer; transition: all 0.3s ease; position: relative; }
    .event-card:hover { transform: translateY(-6px); border-color: rgba(255,209,0,0.25); box-shadow: 0 20px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,209,0,0.1); }
    .event-card-img { position: relative; overflow: hidden; aspect-ratio: 16/9; }
    .event-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .event-card:hover .event-card-img img { transform: scale(1.08); }
    .event-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(6,9,15,0.85) 0%, transparent 55%); }
    .event-card-badge { position: absolute; top: 14px; left: 14px; }
    .event-card-fav { position: absolute; top: 14px; right: 14px; width: 34px; height: 34px; background: rgba(6,9,15,0.65); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(8px); transition: all 0.2s; border: 1px solid rgba(255,255,255,0.1); }
    .event-card-fav:hover { background: rgba(255,77,106,0.2); border-color: rgba(255,77,106,0.45); }
    .event-card-fav svg { width: 15px; height: 15px; color: #fff; }
    .event-card-body { padding: 20px; }
    .event-card-meta { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; flex-wrap: wrap; }
    .event-card-meta-item { display: flex; align-items: center; gap: 5px; font-size: 12px; color: var(--text-dim); }
    .event-card-meta-item svg { width: 12px; height: 12px; }
    .event-card-title { font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; color: #fff; line-height: 1.35; margin-bottom: 14px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .event-card-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 14px; border-top: 1px solid var(--border2); }
    .event-price { display: flex; flex-direction: column; }
    .event-price-from { font-size: 10px; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.05em; }
    .event-price-amount { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 900; color: var(--yellow); }
    .event-price-orig { font-size: 12px; color: var(--text-dim); text-decoration: line-through; }
    .sold-bar { margin: 14px 0 0; }
    .sold-bar-label { display: flex; justify-content: space-between; font-size: 11px; color: var(--text-dim); margin-bottom: 6px; }
    .sold-bar-track { height: 3px; background: var(--surface3); border-radius: 2px; overflow: hidden; }
    .sold-bar-fill { height: 100%; border-radius: 2px; background: linear-gradient(90deg, var(--yellow-dark), var(--yellow)); }
    .event-card-featured { grid-column: span 2; display: grid; grid-template-columns: 1fr 1fr; }
    .event-card-featured .event-card-img { aspect-ratio: auto; min-height: 280px; }
    .event-card-featured .event-card-body { padding: 36px; display: flex; flex-direction: column; justify-content: center; }
    .event-card-featured .event-card-title { font-size: 22px; }

    /* ── STATS ── */
    .stats { background: linear-gradient(135deg, rgba(255,209,0,0.06) 0%, rgba(26,92,204,0.05) 100%); border-top: 1px solid rgba(255,209,0,0.1); border-bottom: 1px solid rgba(255,209,0,0.1); }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); }
    .stat-item { padding: 52px 40px; border-right: 1px solid var(--border2); text-align: center; }
    .stat-item:last-child { border-right: none; }
    .stat-number { font-family: 'Poppins', sans-serif; font-size: 52px; font-weight: 900; color: var(--yellow); display: block; line-height: 1; margin-bottom: 10px; }
    .stat-label { font-size: 14px; color: var(--text-muted); font-weight: 500; }

    /* ── CATEGORIES ── */
    .cat-grid { display: grid; grid-template-columns: repeat(3, 1fr); grid-template-rows: repeat(2, 200px); gap: 14px; }
    .cat-card { border-radius: var(--radius); overflow: hidden; position: relative; cursor: pointer; transition: transform 0.3s ease; }
    .cat-card:hover { transform: scale(1.015); }
    .cat-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.55s ease; filter: brightness(0.55) saturate(0.9); }
    .cat-card:hover img { transform: scale(1.08); filter: brightness(0.6) saturate(1); }
    .cat-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(6,9,15,0.9) 0%, rgba(6,9,15,0.35) 60%, transparent 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 24px; transition: all 0.3s; }
    .cat-card-icon { font-size: 26px; margin-bottom: 8px; }
    .cat-card-name { font-family: 'Poppins', sans-serif; font-size: 19px; font-weight: 700; color: #fff; }
    .cat-card-count { font-size: 13px; color: var(--text-muted); margin-top: 4px; }
    .cat-card-large { grid-column: span 1; grid-row: span 2; }
    .cat-card-large .cat-card-name { font-size: 24px; }
    .cat-card:hover .cat-card-count { color: var(--yellow); }

    /* ── PROMO ── */
    .promo { background: linear-gradient(135deg, #0D1F3C 0%, #0A1628 50%, #12253A 100%); border-radius: 24px; padding: 64px; display: grid; grid-template-columns: 1fr auto; gap: 48px; align-items: center; border: 1px solid rgba(255,209,0,0.15); position: relative; overflow: hidden; margin: 0 24px; }
    .promo::before { content: ''; position: absolute; top: -80px; right: -80px; width: 360px; height: 360px; background: radial-gradient(circle, rgba(255,209,0,0.12), transparent 70%); pointer-events: none; }
    .promo::after { content: ''; position: absolute; bottom: -60px; left: 40%; width: 240px; height: 240px; background: radial-gradient(circle, rgba(26,92,204,0.12), transparent 70%); pointer-events: none; }
    .promo-title { font-family: 'Poppins', sans-serif; font-size: clamp(24px, 2.5vw, 38px); font-weight: 900; color: #fff; line-height: 1.15; margin-bottom: 16px; margin-top: 16px; }
    .promo-title span { color: var(--yellow); }
    .promo-desc { font-size: 15px; color: var(--text-muted); line-height: 1.75; margin-bottom: 28px; }
    .promo-perks { display: flex; flex-direction: column; gap: 12px; margin-bottom: 36px; }
    .promo-perk { display: flex; align-items: center; gap: 12px; font-size: 14px; color: var(--text); }
    .promo-perk-icon { width: 30px; height: 30px; background: rgba(255,209,0,0.12); border: 1px solid rgba(255,209,0,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 14px; }
    .promo-visual { display: flex; flex-direction: column; align-items: center; gap: 16px; }
    .promo-discount { width: 168px; height: 168px; background: var(--yellow); border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 24px 60px rgba(255,209,0,0.35), 0 0 0 12px rgba(255,209,0,0.08); }
    .promo-discount .pct { font-family: 'Poppins', sans-serif; font-size: 56px; font-weight: 900; color: #06090F; line-height: 1; }
    .promo-discount .pct-label { font-size: 14px; color: rgba(0,0,0,0.65); font-weight: 700; letter-spacing: 0.02em; }
    .promo-note { font-size: 12px; color: var(--text-dim); text-align: center; }

    /* ── HOW IT WORKS ── */
    .steps-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 32px; position: relative; }
    .steps-grid::before { content: ''; position: absolute; top: 32px; left: 10%; right: 10%; height: 1px; background: linear-gradient(90deg, transparent, rgba(255,209,0,0.2), var(--yellow), rgba(255,209,0,0.2), transparent); }
    .step-card { display: flex; flex-direction: column; align-items: center; text-align: center; gap: 16px; }
    .step-num { width: 64px; height: 64px; background: var(--surface2); border: 2px solid rgba(255,209,0,0.25); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 900; color: var(--yellow); position: relative; z-index: 1; transition: all 0.3s; }
    .step-card:hover .step-num { background: var(--yellow); color: #06090F; border-color: var(--yellow); box-shadow: 0 8px 32px rgba(255,209,0,0.35); }
    .step-icon { font-size: 30px; }
    .step-title { font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; color: #fff; }
    .step-desc { font-size: 13px; color: var(--text-muted); line-height: 1.65; }

    /* ── TIMELINE ── */
    .timeline { display: flex; flex-direction: column; gap: 2px; }
    .timeline-item { display: grid; grid-template-columns: 80px 1fr auto; align-items: center; gap: 20px; padding: 16px 20px; border-radius: var(--radius-sm); cursor: pointer; transition: all 0.2s; border: 1px solid transparent; }
    .timeline-item:hover { background: var(--surface2); border-color: var(--border2); }
    .timeline-date { text-align: center; background: var(--surface2); border: 1px solid var(--border2); border-radius: var(--radius-sm); padding: 8px 0; transition: all 0.2s; }
    .timeline-item:hover .timeline-date { border-color: rgba(255,209,0,0.3); }
    .timeline-day { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 900; color: var(--yellow); display: block; line-height: 1; }
    .timeline-month { font-size: 11px; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.05em; }
    .timeline-info { display: flex; flex-direction: column; gap: 4px; }
    .timeline-name { font-size: 15px; font-weight: 600; color: #fff; }
    .timeline-venue { font-size: 12px; color: var(--text-dim); display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .timeline-price { font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 900; color: var(--yellow); text-align: right; white-space: nowrap; }

    /* ── NEWSLETTER ── */
    .newsletter { background: var(--surface); border-radius: 24px; padding: 72px 64px; text-align: center; border: 1px solid rgba(255,209,0,0.1); position: relative; overflow: hidden; }
    .newsletter::before { content: ''; position: absolute; top: -80px; left: 50%; transform: translateX(-50%); width: 480px; height: 240px; background: radial-gradient(ellipse, rgba(255,209,0,0.1), transparent 70%); }
    .newsletter-title { font-family: 'Poppins', sans-serif; font-size: clamp(24px, 3vw, 38px); font-weight: 900; color: #fff; margin-bottom: 12px; position: relative; }
    .newsletter-desc { font-size: 16px; color: var(--text-muted); margin-bottom: 36px; position: relative; }
    .newsletter-form { display: flex; gap: 12px; max-width: 480px; margin: 0 auto; position: relative; }
    .newsletter-form input { flex: 1; background: var(--surface2); border: 1px solid var(--border2); border-radius: var(--radius-full); padding: 14px 22px; font-size: 14px; color: var(--text); font-family: inherit; outline: none; transition: all 0.2s; }
    .newsletter-form input:focus { border-color: rgba(255,209,0,0.5); box-shadow: 0 0 0 3px rgba(255,209,0,0.1); }

    /* ── FOOTER ── */
    footer { background: var(--surface); border-top: 1px solid var(--border2); padding: 64px 0 32px; }
    .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 48px; }
    .footer-brand p { font-size: 14px; color: var(--text-muted); line-height: 1.75; margin: 16px 0 24px; }
    .footer-socials { display: flex; gap: 10px; }
    .social-btn { width: 40px; height: 40px; background: var(--surface2); border: 1px solid var(--border2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; transition: all 0.2s; cursor: pointer; color: var(--text-muted); }
    .social-btn:hover { background: rgba(255,209,0,0.1); border-color: rgba(255,209,0,0.35); color: var(--yellow); }
    .footer-col h4 { font-size: 13px; font-weight: 800; color: #fff; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.06em; }
    .footer-links { display: flex; flex-direction: column; gap: 10px; }
    .footer-links a { font-size: 13px; color: var(--text-dim); transition: color 0.2s; }
    .footer-links a:hover { color: var(--yellow); }
    .footer-bottom { display: flex; align-items: center; justify-content: space-between; padding-top: 24px; border-top: 1px solid var(--border2); font-size: 13px; color: var(--text-dim); }
    .turkcell-logo-text { font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 800; color: var(--yellow); }

    /* ── TOAST ── */
    #toast-container { position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
    .toast { padding: 14px 20px; border-radius: var(--radius-sm); font-size: 14px; font-weight: 600; color: #06090F; opacity: 0; transform: translateY(10px); transition: all 0.3s ease; min-width: 280px; box-shadow: 0 8px 32px rgba(0,0,0,0.5); }
    .toast.show { opacity: 1; transform: translateY(0); }
    .toast.success { background: var(--green); color: #06090F; }
    .toast.info { background: var(--yellow); color: #06090F; }
    .toast.warning { background: var(--orange); color: #fff; }

    /* ── ANIMATIONS ── */
    .fade-up { opacity: 0; transform: translateY(28px); transition: opacity 0.65s ease, transform 0.65s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    /* ── TURKCELL STRIP ── */
    .tc-strip { position: fixed; top: 0; left: 0; right: 0; z-index: 1001; background: var(--yellow); padding: 10px 0; overflow: hidden; }
    .tc-strip-inner { display: flex; gap: 64px; animation: marquee 25s linear infinite; white-space: nowrap; }
    .tc-strip-item { display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 800; color: #06090F; letter-spacing: 0.04em; flex-shrink: 0; }
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
      .event-card-featured { grid-column: span 1; grid-template-columns: 1fr; }
      .event-card-featured .event-card-img { min-height: auto; aspect-ratio: 16/9; }
      .footer-grid { grid-template-columns: 1fr 1fr; }
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
      .hero-price-card { display: none; }
      .cat-grid { grid-template-columns: repeat(2, 1fr); }
      .cat-card-large { grid-row: span 1; }
      .steps-grid { grid-template-columns: repeat(2, 1fr); }
      .steps-grid::before { display: none; }
    }
    @media (max-width: 768px) {
      .nav, .tc-badge { display: none; }
      .search-bar { max-width: 200px; }
      .slide-content { left: 24px; right: 24px; max-width: 100%; }
      .promo { grid-template-columns: 1fr; padding: 40px 24px; margin: 0; }
      .promo-visual { flex-direction: row; justify-content: center; }
      .footer-grid { grid-template-columns: 1fr; }
      .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
      .newsletter { padding: 40px 24px; }
      .newsletter-form { flex-direction: column; }
      .timeline-item { grid-template-columns: 60px 1fr; }
      .timeline-price { display: none; }
      .slider-nav { display: none; }
    }
    @media (max-width: 480px) {
      .events-grid { grid-template-columns: 1fr; }
      .cat-grid { grid-template-columns: 1fr; }
      .stats-grid { grid-template-columns: 1fr; }
      .steps-grid { grid-template-columns: 1fr; }
      .stat-item { border-right: none; border-bottom: 1px solid var(--border2); }
    }
    /* Önemli Root Değişkenleri ve Temel CSS buraya gelecek */
    :root {
      --yellow: #FFD100; --navy: #0A1628; --bg: #06090F; --surface: #0C1520; --text: #E8EDF5;
      /* ... Diğer CSS kodların ... */
    }
    /* Header ve Footer için gereken CSS'lerin burada olduğundan emin ol */
    body { font-family: 'Inter', sans-serif; background: #06090F; color: #E8EDF5; }
    #header { position: fixed; top: 40px; left: 0; right: 0; z-index: 1000; padding: 0 24px; }
    .header-inner { max-width: 1320px; margin: 0 auto; height: 72px; display: flex; align-items: center; gap: 24px; }
  </style>
  @stack('styles')
</head>
<body>

<div class="tc-strip">
  <div class="tc-strip-inner">
    <span class="tc-strip-item">⚡ Turkcell Abonelerine %10 Ekstra İndirim</span>
    <span class="tc-strip-item">💳 Paycell ile Güvenli Ödeme</span>
    <span class="tc-strip-item">📱 Dijital QR Bilet</span>
    <span class="tc-strip-item">💳 Paycell ile Güvenli Ödeme</span>
    <span class="tc-strip-item">🎁 Arkadaşına Ücretsiz Bilet Hediye Et</span>
    <span class="tc-strip-item">⚡ Turkcell Abonelerine %10 Ekstra İndirim</span>
    <span class="tc-strip-item">🎟 Öncelikli Bilet Erişimi</span>
    <span class="tc-strip-item">📱 Dijital QR Bilet — Kuyruğa Girme</span>
    <span class="tc-strip-item">💳 Paycell ile Güvenli Ödeme</span>
    <span class="tc-strip-item">🎁 Arkadaşına Ücretsiz Bilet Hediye Et</span>
    <!-- Marquee etkisi için tekrarlanan itemlar -->
  </div>
</div>

<header id="header">
  <div class="header-inner">
    <a href="{{ url('/') }}" class="logo">
      <div class="logo-icon"><svg viewBox="0 0 24 24"><path d="M20 12L12 4 4 12v8h5v-5h6v5h5V12z"/></svg></div>
      <span class="logo-text">Bilet<span>Cell</span></span>
    </a>
    <nav class="nav">
      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Ana Sayfa</a>
      <a href="#events">Etkinlikler</a>
    </nav>

   <!-- app.blade.php içindeki header-actions kısmını şu şekilde güncelle -->
<div class="header-actions">
  @guest
    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Giriş Yap</a>
    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Üye Ol</a>
  @else
    <div class="tc-badge"><div class="tc-dot"></div>{{ Auth::user()->name }}</div>
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-navy btn-sm">Çıkış</button>
    </form>
  @endguest
</div>
  </div>
</header>

@yield('content')

<footer>
  <div class="container">
    <div class="footer-bottom">
      <span>© 2026 BiletCell. <span class="turkcell-logo-text">Turkcell</span> ürünüdür.</span>
    </div>
  </div>
</footer>

<script>
  // biletcell.html içindeki Header Scroll ve Toast scriptlerini buraya koy
const header = document.getElementById('header');
  window.addEventListener('scroll', () => { header.classList.toggle('scrolled', window.scrollY > 20); });
  let cur = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');
  let iv;
  function goSlide(n) {
    slides[cur].classList.remove('active'); dots[cur].classList.remove('active');
    cur = (n + slides.length) % slides.length;
    slides[cur].classList.add('active'); dots[cur].classList.add('active');
  }
  function nextSlide() { goSlide(cur + 1); }
  function prevSlide() { goSlide(cur - 1); }
  function startSlider() { iv = setInterval(nextSlide, 5000); }
  function stopSlider() { clearInterval(iv); }
  document.querySelector('.hero').addEventListener('mouseenter', stopSlider);
  document.querySelector('.hero').addEventListener('mouseleave', startSlider);
  startSlider();
  function filterCat(btn, cat) {
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('#eventsGrid .event-card').forEach(card => {
      card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
    });
  }
  function toggleFav(btn) {
    btn.classList.toggle('faved');
    const svg = btn.querySelector('svg');
    if (btn.classList.contains('faved')) { svg.style.fill='#ff4d6a'; svg.style.color='#ff4d6a'; showToast('Favorilere eklendi!','success'); }
    else { svg.style.fill='none'; svg.style.color='#fff'; showToast('Favorilerden çıkarıldı.','info'); }
  }
  function showToast(msg, type) {
    const c = document.getElementById('toast-container');
    const t = document.createElement('div');
    t.className = 'toast ' + (type||'info'); t.textContent = msg; c.appendChild(t);
    requestAnimationFrame(() => requestAnimationFrame(() => t.classList.add('show')));
    setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3200);
  }
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
  }, { threshold: 0.12 });
  document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
  function animateCount(el) {
    const target = parseInt(el.dataset.target); let c2 = 0; const step = target / 120;
    const t = setInterval(() => {
      c2 += step; if (c2 >= target) { c2 = target; clearInterval(t); }
      el.textContent = target > 10000 ? Math.floor(c2).toLocaleString('tr-TR') : Math.floor(c2);
    }, 16);
  }
  const statObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.querySelectorAll('.stat-number').forEach(animateCount); statObs.unobserve(e.target); } });
  }, { threshold: 0.3 });
  document.querySelectorAll('.stats-grid').forEach(el => statObs.observe(el));
  document.getElementById('searchInput').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.event-card').forEach(card => {
      const title = card.querySelector('.event-card-title')?.textContent.toLowerCase() || '';
      card.style.display = (!q || title.includes(q)) ? '' : 'none';
    });
  });
  window.addEventListener('scroll', () => {
    document.getElementById('header').classList.toggle('scrolled', window.scrollY > 20);
  });
</script>
@stack('scripts')
</body>
</html>
