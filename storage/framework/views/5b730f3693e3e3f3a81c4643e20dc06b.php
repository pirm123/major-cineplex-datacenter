

<?php $__env->startSection('content'); ?>
<style>
    * { font-family: 'Prompt', sans-serif; }
    body {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        min-height: 100vh; position: relative; overflow-x: hidden;
    }
    body::before {
        content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background-image:
            radial-gradient(circle at 20% 50%, rgba(255,107,107,0.07) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(78,205,196,0.07) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(255,195,18,0.05) 0%, transparent 50%);
        pointer-events: none; z-index: 0;
    }
    .container { position: relative; z-index: 1; }

    @keyframes borderFlow { 0%{background-position:0% center} 100%{background-position:200% center} }
    @keyframes shimmer    { 0%{background-position:0% center} 100%{background-position:200% center} }
    @keyframes shine      { 0%,100%{transform:translateX(-120%) rotate(45deg)} 50%{transform:translateX(120%) rotate(45deg)} }
    @keyframes tmsGlow    {
        0%,100%{box-shadow:0 6px 24px rgba(6,182,212,0.35)}
        50%{box-shadow:0 8px 32px rgba(6,182,212,0.55),0 0 20px rgba(34,211,238,0.2)}
    }
    @keyframes ddIn { from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }
    @keyframes pop {
        from { opacity:0; transform:scale(0.82) translateY(18px); }
        to   { opacity:1; transform:scale(1) translateY(0); }
    }
    @keyframes sweep { 0%{left:-80%} 100%{left:130%} }
    @keyframes breathe {
        0%,100% { box-shadow: var(--glow-idle); }
        50%      { box-shadow: var(--glow-pulse); }
    }
    @keyframes ipGlow {
        0%,100%{box-shadow:0 6px 24px rgba(255,195,18,0.35)}
        50%{box-shadow:0 8px 32px rgba(255,195,18,0.6),0 0 20px rgba(255,237,78,0.2)}
    }
    @keyframes tmsAppGlow {
        0%,100%{box-shadow:0 6px 24px rgba(139,92,246,0.4)}
        50%{box-shadow:0 8px 32px rgba(139,92,246,0.65),0 0 24px rgba(167,139,250,0.25)}
    }

    /* ── Back ── */
    .back-btn {
        display:inline-flex;align-items:center;gap:8px;
        background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.12);
        color:rgba(255,255,255,0.8);font-size:0.85rem;font-weight:500;
        padding:8px 18px;border-radius:8px;text-decoration:none;transition:all 0.25s;
    }
    .back-btn svg { transition:transform 0.25s; }
    .back-btn:hover { border-color:rgba(255,195,18,0.4);color:#ffd93d;transform:translateX(-3px); }
    .back-btn:hover svg { transform:translateX(-3px); }

    /* ── Header ── */
    .header-wrapper {
        background:rgba(255,255,255,0.04);backdrop-filter:blur(18px);
        border:1px solid rgba(255,255,255,0.1);border-radius:20px;
        padding:2rem 2.5rem;position:relative;overflow:visible;
    }
    .header-wrapper::before {
        content:'';position:absolute;top:0;left:0;right:0;height:2px;border-radius:20px 20px 0 0;
        background:linear-gradient(90deg,#ff6b6b,#ffd93d,#4ecdc4,#ff6b6b);
        background-size:200% auto;animation:borderFlow 4s linear infinite;
        pointer-events:none;z-index:0;
    }
    .mc-title {
        font-weight:800;font-size:2rem;
        background:linear-gradient(120deg,#ff6b6b 0%,#ffd93d 50%,#4ecdc4 100%);
        background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;
        background-clip:text;animation:shimmer 5s linear infinite;margin-bottom:0.2rem;
    }
    .mc-subtitle { color:#8fa0be;font-size:0.85rem;font-weight:300; }
    .stats-row { display:flex;gap:1rem;margin-top:1.25rem;flex-wrap:wrap; }
    .stat-box {
        background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.09);
        padding:0.8rem 1.4rem;border-radius:12px;flex:1;min-width:110px;transition:all 0.25s;
    }
    .stat-box:hover { border-color:rgba(255,195,18,0.3);transform:translateY(-2px); }
    .stat-label { color:#8fa0be;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.07em;margin-bottom:0.15rem; }
    .stat-value { color:#ffe066;font-size:1.5rem;font-weight:700;line-height:1; }
    .right-col { display:flex;flex-direction:column;align-items:flex-end;gap:0.75rem; }

    /* ── Badge group ── */
    .badge-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-end;
    }

    /* ══════════════════════════════════
       ACCORDION BADGE (CLIENT IP style)
    ══════════════════════════════════ */
    .acc-badge-wrap {
        display: inline-flex;
        flex-direction: column;
        align-items: stretch;
        min-width: 210px;
        border-radius: 18px;
        overflow: hidden;
        transition: box-shadow .3s;
    }

    /* ── CLIENT IP (gold) ── */
    .acc-badge-wrap.gold {
        box-shadow: 0 6px 24px rgba(255,195,18,.4);
        animation: ipGlow 3s ease-in-out infinite;
    }
    .acc-badge-wrap.gold.open {
        box-shadow: 0 10px 36px rgba(255,195,18,.65);
        animation: none;
    }
    .acc-badge-wrap.gold .acc-badge-head {
        background: linear-gradient(135deg,#ffd93d,#ffed4e,#fbbf24);
        color: #1a1a2e;
        border-bottom: 1px solid rgba(0,0,0,0);
    }
    .acc-badge-wrap.gold.open .acc-badge-head {
        border-bottom: 1px solid rgba(0,0,0,.2);
    }
    .acc-badge-wrap.gold .acc-panel {
        background: #1a1400;
        border-top: 1px solid rgba(255,195,18,.2);
    }

    /* ── TMS APP (violet) ── */
    .acc-badge-wrap.violet {
        box-shadow: 0 6px 24px rgba(139,92,246,.4);
        animation: tmsAppGlow 3s ease-in-out infinite;
    }
    .acc-badge-wrap.violet.open {
        box-shadow: 0 10px 36px rgba(139,92,246,.65);
        animation: none;
    }
    .acc-badge-wrap.violet .acc-badge-head {
        background: linear-gradient(135deg,#7c3aed,#6d28d9,#5b21b6);
        color: #fff;
        border-bottom: 1px solid rgba(0,0,0,0);
    }
    .acc-badge-wrap.violet.open .acc-badge-head {
        border-bottom: 1px solid rgba(0,0,0,.3);
    }
    .acc-badge-wrap.violet .acc-panel {
        background: #0d0a1e;
        border-top: 1px solid rgba(139,92,246,.2);
    }

    /* ── Badge head (clickable top part) ── */
    .acc-badge-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 11px 18px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        user-select: none;
        transition: filter .2s;
        border: none;
    }
    .acc-badge-head:hover { filter: brightness(1.08); }
    .acc-badge-head::after {
        content:'';position:absolute;top:0;left:-60%;
        width:40%;height:100%;
        background:linear-gradient(105deg,transparent,rgba(255,255,255,.18),transparent);
        transform:skewX(-15deg);animation:sweep 3.5s 1s ease-in-out infinite;
    }

    .acc-badge-left { display:flex;flex-direction:column;gap:2px;min-width:0; }
    .acc-badge-label { display:flex;align-items:center;gap:5px;font-size:.66rem;font-weight:700;opacity:.75;letter-spacing:.08em; }
    .acc-badge-label svg { width:11px;height:11px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0; }
    .acc-badge-ip { font-size:.9rem;font-weight:800;letter-spacing:.03em;font-family:'Courier New',monospace; }
    .acc-chevron { flex-shrink:0;opacity:.8;transition:transform .35s cubic-bezier(.34,1.56,.64,1); }
    .acc-badge-wrap.open .acc-chevron { transform:rotate(180deg); }

    /* ── Accordion panel ── */
    .acc-panel {
        max-height: 0;
        overflow: hidden;
        padding: 0 6px;
        transition: max-height .38s cubic-bezier(.4,0,.2,1), padding .38s;
    }
    .acc-badge-wrap.open .acc-panel {
        max-height: 300px;
        padding: 6px;
    }

    /* ── Dropdown buttons ── */
    .dd-label {
        font-size:.63rem;color:rgba(143,160,190,.55);
        text-transform:uppercase;letter-spacing:.1em;
        padding:4px 12px 2px;font-weight:600;
    }
    .dd-divider { height:1px;background:rgba(255,255,255,.07);margin:4px; }
    .dd-btn {
        display:flex;align-items:center;gap:10px;width:100%;
        padding:9px 12px;margin-bottom:3px;border-radius:9px;
        border:1px solid transparent;background:transparent;
        font-size:.82rem;font-family:'Prompt',sans-serif;font-weight:500;
        cursor:pointer;transition:all .2s;text-align:left;text-decoration:none;
    }
    .dd-btn:last-child { margin-bottom:0; }
    .dd-btn:hover { background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.1);color:#fff!important; }
    .dd-btn.c-yellow { color:#fde047; }
    .dd-btn.c-blue   { color:#67e8f9; }
    .dd-btn.c-violet { color:#c4b5fd; }
    .dd-btn.c-green  { color:#86efac; }
    .dd-dot { width:7px;height:7px;border-radius:50%;flex-shrink:0; }
    .dd-dot.c-yellow { background:#fde047; }
    .dd-dot.c-blue   { background:#67e8f9; }
    .dd-dot.c-violet { background:#c4b5fd; }
    .dd-dot.c-green  { background:#86efac; }

    /* ── TMS Server badge (cyan — link, ไม่มี dropdown) ── */
    .mc-tms-badge {
        display:inline-flex;flex-direction:column;align-items:center;gap:3px;
        background:linear-gradient(135deg,#06b6d4,#0891b2,#0e7490);color:#fff;
        padding:10px 22px;border-radius:50px;border:2px solid rgba(103,232,249,.4);
        text-decoration:none;position:relative;overflow:hidden;
        transition:all .3s;min-width:148px;
        animation:tmsGlow 3s ease-in-out infinite;
    }
    .mc-tms-badge::after {
        content:'';position:absolute;top:0;left:-60%;width:40%;height:100%;
        background:linear-gradient(105deg,transparent,rgba(255,255,255,.15),transparent);
        transform:skewX(-15deg);animation:sweep 4s 0.5s ease-in-out infinite;
    }
    .mc-tms-badge:hover { transform:translateY(-3px);box-shadow:0 12px 32px rgba(6,182,212,.6);color:#fff;animation:none; }
    .mc-tms-badge .acc-badge-label { opacity:.7;letter-spacing:.08em;font-size:.66rem;font-weight:700; }
    .mc-tms-badge .acc-badge-ip { font-size:.9rem;font-weight:800;font-family:'Courier New',monospace; }

    /* ── TMS row (server + app side-by-side) ── */
    .tms-row {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        flex-wrap: nowrap;
        justify-content: flex-end;
    }

    /* ══════════════════════════════
       HALL BUTTON GRID
    ══════════════════════════════ */
    .halls-section-title {
        display:flex;align-items:center;gap:10px;
        font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;
        color:rgba(168,178,209,0.4);margin-bottom:1rem;
    }
    .halls-section-title::after { content:'';flex:1;height:1px;background:rgba(255,255,255,0.05); }

    .halls-grid {
        display:grid;
        grid-template-columns:repeat(auto-fill, minmax(110px, 1fr));
        gap:10px;
    }

    .hall-card {
        aspect-ratio: 1 / 1;
        display:flex;align-items:center;justify-content:center;
        text-decoration:none;color:inherit;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        position: relative; overflow: hidden;
        transition: transform 0.28s cubic-bezier(0.34,1.56,0.64,1),
                    border-color 0.22s ease,
                    background 0.22s ease,
                    box-shadow 0.22s ease;
        cursor: pointer;
        --c:    255,255,255;
        --glow-idle:  0 4px 16px rgba(var(--c),0.08);
        --glow-hover: 0 20px 50px rgba(var(--c),0.28), inset 0 1px 0 rgba(255,255,255,0.06);
        --glow-pulse: 0 6px 22px rgba(var(--c),0.18);
    }
    .hall-card::before {
        content:'';
        position:absolute;top:0;left:10%;right:10%;height:1.5px;border-radius:2px;
        background:linear-gradient(90deg,transparent,rgba(var(--c),0.8),transparent);
        opacity:0;transition:opacity 0.3s;
    }
    .hall-card:hover::before { opacity:1; }
    .hall-card::after {
        content:'';
        position:absolute;top:-60%;left:-80%;
        width:50%;height:220%;
        background:linear-gradient(105deg,transparent,rgba(255,255,255,0.07),transparent);
        transform:skewX(-15deg);pointer-events:none;
    }
    .hall-card:hover::after { animation:sweep 0.5s ease both; }
    .hall-card:hover {
        transform: translateY(-8px) scale(1.06);
        border-color: rgba(var(--c),0.4);
        background: rgba(var(--c),0.08);
        box-shadow: var(--glow-hover);
    }
    .hall-card:active { transform:translateY(-3px) scale(1.02); }

    .hall-name {
        font-size: 1rem;font-weight: 800;color: #dce4f5;
        letter-spacing: 0.02em;line-height: 1.2;text-align: center;
        position: relative; z-index: 1;
        transition: color 0.2s, transform 0.28s cubic-bezier(0.34,1.56,0.64,1);
        pointer-events: none;
    }
    .hall-card:hover .hall-name { transform: scale(1.08); }

    .hall-card.is-imax {
        --c: 56,189,248;
        background: rgba(56,189,248,0.06); border-color: rgba(56,189,248,0.25);
        animation: breathe 3.5s ease-in-out infinite;
        --glow-idle:  0 4px 18px rgba(56,189,248,0.15);
        --glow-pulse: 0 6px 26px rgba(56,189,248,0.3);
        --glow-hover: 0 20px 50px rgba(56,189,248,0.4), inset 0 1px 0 rgba(255,255,255,0.07);
    }
    .hall-card.is-imax .hall-name { color:#7dd3fc; font-size:1.1rem; letter-spacing:0.06em; }
    .hall-card.is-imax:hover { animation:none; }

    .hall-card.is-atmos {
        --c: 250,204,21;
        background: rgba(250,204,21,0.05); border-color: rgba(250,204,21,0.2);
        --glow-hover: 0 20px 50px rgba(250,204,21,0.3), inset 0 1px 0 rgba(255,255,255,0.05);
    }
    .hall-card.is-atmos .hall-name { color:#fde047; }

    .hall-card.is-4dx {
        --c: 251,146,60;
        background: rgba(251,146,60,0.06); border-color: rgba(251,146,60,0.22);
        animation: breathe 4s ease-in-out infinite;
        --glow-idle:  0 4px 18px rgba(251,146,60,0.12);
        --glow-pulse: 0 6px 26px rgba(251,146,60,0.28);
        --glow-hover: 0 20px 50px rgba(251,146,60,0.38), inset 0 1px 0 rgba(255,255,255,0.07);
    }
    .hall-card.is-4dx .hall-name { color:#fb923c; font-size:1.1rem; letter-spacing:0.06em; }
    .hall-card.is-4dx:hover { animation:none; }

    .hall-card.is-kids {
        --c: 167,139,250;
        background: rgba(167,139,250,0.06); border-color: rgba(167,139,250,0.22);
        --glow-hover: 0 20px 50px rgba(167,139,250,0.32), inset 0 1px 0 rgba(255,255,255,0.06);
    }
    .hall-card.is-kids .hall-name { color:#c4b5fd; }

    .hall-card:nth-child(1)  { animation-delay:.04s; } .hall-card:nth-child(2)  { animation-delay:.08s; }
    .hall-card:nth-child(3)  { animation-delay:.12s; } .hall-card:nth-child(4)  { animation-delay:.16s; }
    .hall-card:nth-child(5)  { animation-delay:.20s; } .hall-card:nth-child(6)  { animation-delay:.24s; }
    .hall-card:nth-child(7)  { animation-delay:.28s; } .hall-card:nth-child(8)  { animation-delay:.32s; }
    .hall-card:nth-child(9)  { animation-delay:.36s; } .hall-card:nth-child(10) { animation-delay:.40s; }
    .hall-card:nth-child(11) { animation-delay:.44s; } .hall-card:nth-child(12) { animation-delay:.48s; }
    .hall-card:not(.is-imax):not(.is-4dx) {
        animation: pop 0.32s cubic-bezier(0.22,1.2,0.36,1) both;
    }
    .hall-card.is-imax, .hall-card.is-4dx {
        animation: pop 0.32s cubic-bezier(0.22,1.2,0.36,1) both,
                   breathe 3.5s 0.5s ease-in-out infinite;
    }

    @media (max-width:992px) {
        .right-col { align-items:flex-start;margin-top:1.5rem; }
        .badge-group { align-items:flex-start; }
        .tms-row { justify-content:flex-start; }
    }
    @media (max-width:768px) {
        .mc-title{font-size:1.6rem;}
        .header-wrapper{padding:1.4rem 1.2rem;}
        .halls-grid{grid-template-columns:repeat(auto-fill,minmax(90px,1fr));}
        .tms-row { flex-wrap:wrap; }
    }
    @media (max-width:480px) { .halls-grid{grid-template-columns:repeat(4,1fr);gap:8px;} }
</style>

<div class="container py-4">

    <a href="<?php echo e(route('home')); ?>" class="back-btn mb-4 d-inline-flex">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M10 12L6 8l4-4"/></svg>
        Back to Home
    </a>

    
    <div class="header-wrapper mb-4">
        <div class="row align-items-start g-4">
            <div class="col-lg-7">
                <div class="mc-title"><?php echo e($branch->name); ?></div>
                <div class="mc-subtitle">Theatres · Projection Systems · Servers &amp; Projectors</div>
                <div class="stats-row">
                    <div class="stat-box">
                        <div class="stat-label">Total Theatres</div>
                        <div class="stat-value"><?php echo e(count($theatres)); ?></div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Total Seats</div>
                        <div class="stat-value"><?php echo e(number_format($theatres->sum('seat_count'))); ?></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="right-col">
                    <div class="badge-group">

                        
                        <div class="acc-badge-wrap gold" id="client-ip-wrap">
                            <div class="acc-badge-head" onclick="toggleAcc('client-ip-wrap')">
                                <div class="acc-badge-left">
                                    <div class="acc-badge-label">
                                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                        CLIENT IP
                                    </div>
                                    <div class="acc-badge-ip"><?php echo e($branch->branch_ip); ?></div>
                                </div>
                                <svg class="acc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                            </div>
                            <div class="acc-panel">
                                <button class="dd-btn c-yellow" onclick="runRemoteUtilities('<?php echo e($branch->branch_ip); ?>')">
                                    <div class="dd-dot c-yellow"></div>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="3" width="20" height="14" rx="2"/>
                                        <path d="M8 21h8M12 17v4M7 8l3 3-3 3"/><line x1="13" y1="11" x2="17" y2="11"/>
                                    </svg>
                                    เปิด Remote Utilities
                                </button>
                                <button class="dd-btn c-blue" onclick="downloadRuAgent()">
                                    <div class="dd-dot c-blue"></div>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                        <polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                    ดาวน์โหลด ru-agent.exe
                                </button>
                            </div>
                        </div>

                        <?php if(!empty($branch->tms_ip)): ?>
                        
                        <div class="tms-row">

                            
                            <a href="http://<?php echo e($branch->tms_ip); ?>" target="_blank" class="mc-tms-badge">
                                <div class="acc-badge-label" style="color:rgba(255,255,255,.7);">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:11px;height:11px;">
                                        <rect x="2" y="2" width="20" height="8" rx="2"/>
                                        <rect x="2" y="14" width="20" height="8" rx="2"/>
                                        <line x1="6" y1="6" x2="6.01" y2="6"/>
                                        <line x1="6" y1="18" x2="6.01" y2="18"/>
                                    </svg>
                                    TMS SERVER
                                </div>
                                <div class="acc-badge-ip"><?php echo e($branch->tms_ip); ?></div>
                            </a>

                            
                            <div class="acc-badge-wrap violet" id="tms-app-wrap">
                                <div class="acc-badge-head" onclick="toggleAcc('tms-app-wrap')">
                                    <div class="acc-badge-left">
                                        <div class="acc-badge-label">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                <path d="M3 9h18M9 21V9"/>
                                            </svg>
                                            TMS APP
                                        </div>
                                        <div class="acc-badge-ip"><?php echo e($branch->tms_app_ip ?? 'N/A'); ?></div>
                                    </div>
                                    <svg class="acc-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                                        <polyline points="6 9 12 15 18 9"/>
                                    </svg>
                                </div>
                                <div class="acc-panel">
                                    <button class="dd-btn c-yellow" onclick="runTightVNC('<?php echo e($branch->tms_app_ip); ?>')">
                                        <div class="dd-dot c-yellow"></div>
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="3" width="20" height="14" rx="2"/>
                                            <path d="M8 21h8M12 17v4M7 8l3 3-3 3"/><line x1="13" y1="11" x2="17" y2="11"/>
                                        </svg>
                                        เปิด TightVNC (TMS APP)
                                    </button>
                                    <button class="dd-btn c-violet" onclick="downloadTightVncAgent()">
                                        <div class="dd-dot c-violet"></div>
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                            <polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                                        </svg>
                                        ดาวน์โหลด tightvnc-agent.exe
                                    </button>
                                </div>
                            </div>

                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="halls-section-title">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="opacity:0.4"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
        Theatres
    </div>

    <div class="halls-grid">
        <?php $__currentLoopData = $theatres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theatre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $sf  = strtolower($theatre->special_format ?? '');
            $cls = 'hall-card';
            if      (str_contains($sf,'imax'))  $cls .= ' is-imax';
            elseif  (str_contains($sf,'atmos')) $cls .= ' is-atmos';
            elseif  (str_contains($sf,'4dx'))   $cls .= ' is-4dx';
            elseif  (str_contains($sf,'kids'))  $cls .= ' is-kids';

            if      (str_contains($sf,'imax'))  $name = 'IMAX';
            elseif  (str_contains($sf,'4dx'))   $name = '4DX';
            elseif  (str_contains($sf,'kids'))  $name = 'Kids '.$theatre->theatre_number;
            else                                $name = 'Hall '.$theatre->theatre_number;
        ?>
        <a href="<?php echo e(route('branches.theatres.show', [$branch->id, $theatre->id])); ?>" class="<?php echo e($cls); ?>">
            <span class="hall-name"><?php echo e($name); ?></span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>

<script>
/* ── Accordion toggle ── */
function toggleAcc(id) {
    const wrap = document.getElementById(id);
    if (!wrap) return;
    // ปิด accordion อื่นก่อน (optional: ถ้าต้องการให้เปิดทีละอัน)
    document.querySelectorAll('.acc-badge-wrap.open').forEach(el => {
        if (el.id !== id) el.classList.remove('open');
    });
    wrap.classList.toggle('open');
}

/* ปิดเมื่อคลิกนอก */
document.addEventListener('click', function(e) {
    if (!e.target.closest('.acc-badge-wrap')) {
        document.querySelectorAll('.acc-badge-wrap.open')
            .forEach(el => el.classList.remove('open'));
    }
});

/* ── Remote Utilities ── */
function downloadRuAgent() { window.open('/downloads/ru-agent.exe', '_blank'); }

async function runRemoteUtilities(ip) {
    try {
        const s  = await fetch('http://localhost:18181/status');
        const sj = await s.json();
        if (!sj.ok) { alert('❌ ru-agent ยังไม่พร้อมใช้งาน'); return; }
        const r = await fetch(`http://localhost:18181/run?ip=${encodeURIComponent(ip)}`);
        const d = await r.json();
        if (!d.ok) { alert('❌ ไม่พบ Remote Utilities Viewer ในเครื่อง'); return; }
        alert('✅ เปิด Remote Utilities แล้ว\n📋 IP: ' + d.ip);
    } catch (e) {
        alert('❌ ยังไม่ได้เปิด ru-agent.exe\nให้กด "ดาวน์โหลด" แล้วเปิดก่อน');
    }
}

/* ── TightVNC ── */
function downloadTightVncAgent() { window.open('/downloads/tightvnc-agent.exe', '_blank'); }

async function runTightVNC(ip) {
    try {
        const st     = await fetch('http://localhost:18182/status');
        const stJson = await st.json();
        if (!stJson.ok) throw new Error('agent not running');
        const r = await fetch(`http://localhost:18182/run?ip=${encodeURIComponent(ip)}`);
        const d = await r.json();
        if (!d.ok) { alert('❌ ไม่พบ TightVNC Viewer ในเครื่อง'); return; }
        alert('✅ เปิด TightVNC แล้ว\n📋 IP: ' + d.ip);
    } catch (e) {
        alert('❌ ยังไม่ได้เปิด tightvnc-agent.exe\nให้กด "ดาวน์โหลด" แล้วเปิดก่อน');
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/theatres/index.blade.php ENDPATH**/ ?>