

<?php $__env->startSection('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap');
    * { font-family: 'Prompt', sans-serif; box-sizing: border-box; }
    body { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); min-height: 100vh; overflow-x: hidden; }
    body::before { content:'';position:fixed;inset:0;background:radial-gradient(ellipse at 15% 40%,rgba(255,107,107,.06) 0%,transparent 55%),radial-gradient(ellipse at 85% 75%,rgba(78,205,196,.06) 0%,transparent 55%);pointer-events:none;z-index:0; }
    .container { position:relative;z-index:1; }

    @keyframes fadeUp    { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
    @keyframes shimmer   { 0%{background-position:-200% center} 100%{background-position:200% center} }
    @keyframes borderFlow{ 0%{background-position:0% 50%} 100%{background-position:200% 50%} }
    @keyframes pulseRing { 0%,100%{box-shadow:0 0 0 0 rgba(78,205,196,.45)} 50%{box-shadow:0 0 0 6px rgba(78,205,196,0)} }
    @keyframes vpnPulse  { 0%,100%{opacity:1} 50%{opacity:.4} }
    @keyframes sweep     { 0%{left:-80%} 100%{left:130%} }
    @keyframes ddIn      { from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }
    @keyframes projGlow  { 0%,100%{box-shadow:0 6px 24px rgba(251,146,60,.35)} 50%{box-shadow:0 8px 32px rgba(251,146,60,.6),0 0 20px rgba(251,146,60,.2)} }
    @keyframes shine     { 0%,100%{transform:translateX(-120%) rotate(45deg)} 50%{transform:translateX(120%) rotate(45deg)} }

    /* ── Back ── */
    .back-btn { display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.8);font-size:.85rem;font-weight:500;padding:8px 18px;border-radius:8px;text-decoration:none;transition:all .25s;animation:fadeUp .4s ease both; }
    .back-btn:hover { background:rgba(255,255,255,.08);border-color:rgba(255,195,18,.35);color:#ffd93d;transform:translateX(-3px); }
    .back-btn svg { transition:transform .25s; }
    .back-btn:hover svg { transform:translateX(-3px); }

    /* ── Page Header ── */
    .page-header { background:rgba(255,255,255,.05);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:2rem 2.5rem;margin-bottom:1.5rem;position:relative;z-index:100;overflow:visible;animation:fadeUp .5s ease .1s both; }
    .page-header::before { content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#ff6b6b,#ffd93d,#4ecdc4,#ff6b6b);background-size:200% auto;animation:borderFlow 4s linear infinite;border-radius:20px 20px 0 0;pointer-events:none; }
    .header-inner { display:flex;align-items:flex-start;justify-content:space-between;gap:1.5rem;flex-wrap:wrap; }
    .header-left { flex:1;min-width:0; }
    .header-right { display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0;position:relative;z-index:200; }

    .branch-name { font-size:2rem;font-weight:800;background:linear-gradient(120deg,#ff6b6b 0%,#ffd93d 50%,#4ecdc4 100%);background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 5s linear infinite;margin:0 0 .6rem;line-height:1.2; }
    .theatre-chip { display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#ff6b6b,#ffd93d);color:#1a1a2e;padding:5px 16px;border-radius:6px;font-weight:700;font-size:.95rem; }

    /* ══ PROJECTOR BADGE — ACCORDION ══ */
    .proj-badge-wrap {
        display: inline-flex;
        flex-direction: column;
        align-items: stretch;
        min-width: 230px;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 24px rgba(251,146,60,.4);
        transition: box-shadow .3s;
        animation: projGlow 3s ease-in-out infinite;
    }
    .proj-badge-wrap.open { box-shadow: 0 10px 36px rgba(251,146,60,.6); animation: none; }

    .proj-header-badge {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: linear-gradient(135deg,#f97316,#ea580c,#c2410c);
        color: #fff;
        padding: 11px 18px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        user-select: none;
        transition: filter .2s;
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0); /* placeholder สำหรับ open state */
    }
    .proj-badge-wrap.open .proj-header-badge {
        border-bottom: 1px solid rgba(0,0,0,.25);
    }
    .proj-header-badge:hover { filter: brightness(1.08); }
    .proj-header-badge::after {
        content:'';position:absolute;top:0;left:-60%;
        width:40%;height:100%;
        background:linear-gradient(105deg,transparent,rgba(255,255,255,.18),transparent);
        transform:skewX(-15deg);animation:sweep 3.5s 1s ease-in-out infinite;
    }
    .badge-left { display:flex;flex-direction:column;gap:2px;min-width:0; }
    .badge-label-row { display:flex;align-items:center;gap:5px;font-size:.66rem;font-weight:700;opacity:.8;letter-spacing:.07em; }
    .badge-label-row svg { width:11px;height:11px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0; }
    .badge-ip-val { font-size:.9rem;font-weight:800;letter-spacing:.03em;font-family:'Courier New',monospace; }
    .badge-chevron { flex-shrink:0;opacity:.8;transition:transform .35s cubic-bezier(.34,1.56,.64,1); }
    .proj-badge-wrap.open .badge-chevron { transform:rotate(180deg); }

    /* ── Accordion panel ── */
    .proj-dropdown {
        background: #0d1526;
        border-top: 1px solid rgba(251,146,60,.2);
        padding: 0 6px;
        max-height: 0;
        overflow: hidden;
        transition: max-height .38s cubic-bezier(.4,0,.2,1), padding .38s;
    }
    .proj-dropdown.open {
        max-height: 360px;
        padding: 6px 6px 6px;
    }
    .dd-label { font-size:.65rem;color:rgba(143,160,190,.6);text-transform:uppercase;letter-spacing:.1em;padding:4px 12px 2px;font-weight:600; }
    .dd-divider { height:1px;background:rgba(255,255,255,.07);margin:4px; }
    .dd-btn { display:flex;align-items:center;gap:10px;width:100%;padding:9px 12px;margin-bottom:3px;border-radius:9px;border:1px solid transparent;background:transparent;font-size:.82rem;font-family:'Prompt',sans-serif;font-weight:500;cursor:pointer;transition:all .2s;text-align:left;text-decoration:none; }
    .dd-btn:last-child { margin-bottom:0; }
    .dd-btn:hover { background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.1);color:#fff!important; }
    .dd-btn.c-cyan   { color:#67e8f9; } .dd-btn.c-green  { color:#86efac; }
    .dd-btn.c-violet { color:#c4b5fd; } .dd-btn.c-yellow { color:#fde047; }
    .dd-dot { width:7px;height:7px;border-radius:50%;flex-shrink:0; }
    .dd-dot.c-cyan   { background:#67e8f9; } .dd-dot.c-green  { background:#86efac; }
    .dd-dot.c-violet { background:#c4b5fd; } .dd-dot.c-yellow { background:#fde047; }

    /* ── Stat bar ── */
    .stat-bar { display:flex;gap:1rem;margin-top:1.5rem;flex-wrap:wrap; }
    .stat-pill { display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:10px;padding:10px 18px;transition:all .25s;animation:fadeUp .5s ease .3s both; }
    .stat-pill:hover { border-color:rgba(255,195,18,.25);background:rgba(255,255,255,.07);transform:translateY(-2px); }
    .stat-pill-icon { width:32px;height:32px;background:rgba(255,195,18,.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
    .stat-pill-icon svg { width:16px;height:16px; }
    .stat-pill-label { font-size:.74rem;color:#8fa0be;text-transform:uppercase;letter-spacing:.06em; }
    .stat-pill-value { font-size:1.1rem;font-weight:700;color:#ffe066;line-height:1; }

    /* ── Cards ── */
    .info-card { background:rgba(255,255,255,.05);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,.1);border-radius:16px;overflow:hidden;margin-bottom:1.25rem;transition:border-color .3s,box-shadow .3s,transform .3s;animation:fadeUp .5s ease both;position:relative;z-index:1; }
    .info-card:nth-child(1) { animation-delay:.2s; } .info-card:nth-child(2) { animation-delay:.3s; }
    .info-card:hover { transform:translateY(-4px);border-color:rgba(255,195,18,.18);box-shadow:0 12px 40px rgba(0,0,0,.25); }
    .card-head { display:flex;align-items:center;gap:10px;padding:.9rem 1.4rem;border-bottom:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.04);position:relative;border-radius:16px 16px 0 0; }
    .card-head::after { content:'';position:absolute;bottom:-1px;left:0;width:0;height:2px;background:linear-gradient(90deg,#ff6b6b,#ffd93d);transition:width .4s; }
    .info-card:hover .card-head::after { width:100%; }
    .card-head-icon { width:30px;height:30px;background:rgba(255,195,18,.1);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
    .card-head-icon svg { width:15px;height:15px; }
    .card-head-title { font-size:.82rem;font-weight:700;color:#ffe680;text-transform:uppercase;letter-spacing:.07em; }
    .info-row { display:flex;align-items:center;padding:.75rem 1.4rem;border-bottom:1px solid rgba(255,255,255,.06);gap:1rem;transition:background .2s;position:relative; }
    .info-row:last-child { border-bottom:none; }
    .info-row::before { content:'';position:absolute;left:0;top:0;bottom:0;width:2px;background:linear-gradient(180deg,#ff6b6b,#ffd93d);opacity:0;transform:scaleY(0);transform-origin:center;transition:all .2s; }
    .info-row:hover { background:rgba(255,255,255,.04); }
    .info-row:hover::before { opacity:1;transform:scaleY(1); }
    .row-label { min-width:135px;font-size:.84rem;color:#8fa0be;font-weight:500;flex-shrink:0; }
    .row-value  { font-size:.92rem;color:#e8edf8;flex:1;font-weight:400; }
    .row-value.accent { color:#5de8df;font-weight:600; }
    .mono { font-family:'Courier New',monospace;font-size:.84rem;color:#c5cedf;background:rgba(0,0,0,.3);border:1px solid rgba(255,255,255,.1);padding:3px 10px;border-radius:5px;transition:border-color .2s,color .2s; }
    .mono:hover { border-color:rgba(78,205,196,.4);color:#4ecdc4; }
    .format-tag { background:rgba(250,204,21,.15);border:1px solid rgba(250,204,21,.4);color:#ffe94d;padding:3px 11px;border-radius:5px;font-size:.82rem;font-weight:600; }

    /* ── Server IP ── */
    .ip-section { padding:1rem 1.4rem 1.2rem;border-top:1px solid rgba(255,255,255,.05); }
    .vpn-tag { display:inline-flex;align-items:center;gap:7px;background:rgba(255,195,18,.1);border:1px solid rgba(255,195,18,.3);color:#ffe066;font-size:.82rem;font-weight:500;padding:6px 13px;border-radius:6px;margin-bottom:.9rem; }
    .vpn-dot { width:6px;height:6px;background:#ffd93d;border-radius:50%;flex-shrink:0;animation:vpnPulse 1.8s ease-in-out infinite; }
    .ip-label { font-size:.75rem;color:#8fa0be;text-transform:uppercase;letter-spacing:.07em;margin-bottom:.5rem;font-weight:500; }
    .ip-row { display:flex;align-items:center;gap:10px;flex-wrap:wrap; }
    .ip-box { font-family:'Courier New',monospace;font-size:1.05rem;font-weight:700;color:#4ecdc4;background:rgba(0,0,0,.35);border:1px solid rgba(78,205,196,.3);padding:9px 18px;border-radius:8px;letter-spacing:.04em;animation:pulseRing 3s ease-in-out infinite;transition:border-color .3s,background .3s; }
    .ip-box:hover { border-color:rgba(78,205,196,.6);background:rgba(78,205,196,.06); }

    /* ── Buttons ── */
    .icon-btn { display:inline-flex;align-items:center;justify-content:center;gap:6px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.85);font-size:.8rem;font-weight:500;padding:7px 14px;border-radius:7px;cursor:pointer;transition:all .25s cubic-bezier(.34,1.56,.64,1);text-decoration:none;font-family:'Prompt',sans-serif;white-space:nowrap; }
    .icon-btn svg { width:14px;height:14px;flex-shrink:0; }
    .icon-btn:hover { background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.25);color:#fff;transform:scale(1.04); }
    .icon-btn:active { transform:scale(.97); }
    .icon-btn.primary { background:rgba(78,205,196,.1);border-color:rgba(78,205,196,.28);color:#4ecdc4; }
    .icon-btn.primary:hover { background:rgba(78,205,196,.2);border-color:rgba(78,205,196,.6);box-shadow:0 4px 18px rgba(78,205,196,.18);color:#4ecdc4; }
    .icon-btn.btn-open { background:rgba(255,107,107,.08);border-color:rgba(255,107,107,.28);color:#ff8787; }
    .icon-btn.btn-open:hover { background:rgba(255,107,107,.18);border-color:rgba(255,107,107,.55);box-shadow:0 4px 18px rgba(255,107,107,.18);color:#ff8787; }
    .icon-btn.btn-open .btn-arrow { transition:transform .25s; }
    .icon-btn.btn-open:hover .btn-arrow { transform:translateX(3px); }
    .icon-btn.copied { background:rgba(78,205,196,.2)!important;border-color:rgba(78,205,196,.6)!important;color:#4ecdc4!important; }

    /* ── Server Badge (cyan theme) ── */
    .srv-badge-wrap { animation: srvGlow 3s ease-in-out infinite; }
    .srv-badge-wrap.open { animation: none; box-shadow: 0 10px 36px rgba(78,205,196,.6); }
    @keyframes srvGlow { 0%,100%{box-shadow:0 6px 24px rgba(78,205,196,.35)} 50%{box-shadow:0 8px 32px rgba(78,205,196,.6),0 0 20px rgba(78,205,196,.2)} }
    .srv-header-badge { background: linear-gradient(135deg,#0e9f9f,#0d7377,#0a5f5f) !important; }

    @media (max-width:992px) { .header-right { align-items:flex-start;margin-top:.5rem; } }
    @media (max-width:768px) { .page-header{padding:1.4rem 1.2rem;} .branch-name{font-size:1.6rem;} .row-label{min-width:110px;} }
</style>

<div class="container py-4">

    <a href="<?php echo e(route('branches.theatres.index', $branch->id)); ?>" class="back-btn mb-4">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M10 12L6 8l4-4"/></svg>
        Back to Halls
    </a>

    
    <div class="page-header mb-4">
        <div class="header-inner">

            
            <div class="header-left">
                <div class="d-flex align-items-flex-start gap-3 flex-wrap">
                    <svg width="44" height="52" viewBox="0 0 100 120" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0;filter:drop-shadow(0 3px 8px rgba(232,90,60,.5));margin-top:4px;">
                        <rect x="10" y="20" width="18" height="80" fill="url(#pg1)" rx="2"/>
                        <rect x="10" y="20" width="18" height="12" fill="#D94B2A" rx="2"/>
                        <rect x="10" y="88" width="18" height="12" fill="#C44229" rx="2"/>
                        <rect x="41" y="10" width="18" height="100" fill="url(#pg2)" rx="2"/>
                        <rect x="41" y="10" width="18" height="15" fill="#D94B2A" rx="2"/>
                        <rect x="41" y="95" width="18" height="15" fill="#C44229" rx="2"/>
                        <rect x="72" y="20" width="18" height="80" fill="url(#pg3)" rx="2"/>
                        <rect x="72" y="20" width="18" height="12" fill="#D94B2A" rx="2"/>
                        <rect x="72" y="88" width="18" height="12" fill="#C44229" rx="2"/>
                        <defs>
                            <linearGradient id="pg1" x1="19" y1="20" x2="19" y2="100" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#E85A3C"/><stop offset="100%" stop-color="#C44229"/></linearGradient>
                            <linearGradient id="pg2" x1="50" y1="10" x2="50" y2="110" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#E85A3C"/><stop offset="100%" stop-color="#C44229"/></linearGradient>
                            <linearGradient id="pg3" x1="81" y1="20" x2="81" y2="100" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#E85A3C"/><stop offset="100%" stop-color="#C44229"/></linearGradient>
                        </defs>
                    </svg>
                    <div>
                        <div class="branch-name"><?php echo e($branch->name); ?></div>
                        <div class="theatre-chip">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#1a1a2e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/>
                                <line x1="12" y1="2" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="22"/>
                                <line x1="2" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="22" y2="12"/>
                            </svg>
                            Hall <?php echo e($theatre->theatre_number); ?>

                        </div>
                    </div>
                </div>
            </div>

            
            <?php if($theatre->client_ip || $theatre->projector_ip): ?>
            <div class="header-right">

                
                <?php if($theatre->client_ip): ?>
                <div class="proj-badge-wrap srv-badge-wrap" id="srv-badge-wrap">
                    <div class="proj-header-badge srv-header-badge" onclick="toggleSrvMenu(event)">
                        <div class="badge-left">
                            <div class="badge-label-row">
                                <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
                                OPEN SERVER
                            </div>
                            <div class="badge-ip-val" id="srv-ip-val"><?php echo e($theatre->client_ip); ?></div>
                        </div>
                        <svg class="badge-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>
                    <div class="proj-dropdown" id="srv-dropdown">
                        <div class="dd-divider"></div>
                        <div class="dd-label">Server Access</div>

                        <a class="dd-btn c-cyan" href="http://<?php echo e($theatre->client_ip); ?>" target="_blank">
                            <div class="dd-dot c-cyan"></div>
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            </svg>
                            Open Web Browser
                        </a>

                        <button class="dd-btn c-green" onclick="runGdcServer('<?php echo e($theatre->client_ip); ?>')">
                            <div class="dd-dot c-green"></div>
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                <path d="M8 21h8M12 17v4M7 8l3 3-3 3"/><line x1="13" y1="11" x2="17" y2="11"/>
                            </svg>
                            Open TightVNC Viewer
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
                <?php endif; ?>

                
                <?php if($theatre->projector_ip): ?>
                <div class="proj-badge-wrap" id="proj-badge-wrap">

                    <div class="proj-header-badge" onclick="toggleProjMenu(event)">
                        <div class="badge-left">
                            <div class="badge-label-row">
                                <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><circle cx="12" cy="12" r="3"/></svg>
                                REMOTE PROJECTOR
                            </div>
                            <div class="badge-ip-val" id="proj-ip-val"><?php echo e($theatre->projector_ip); ?></div>
                        </div>
                        <svg class="badge-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>

                    <div class="proj-dropdown" id="proj-dropdown">

                   

                        <div class="dd-divider"></div>
                        <div class="dd-label">Remote Access</div>

                        <button class="dd-btn c-yellow" onclick="runProjectorVNC('<?php echo e($theatre->projector_ip); ?>')">
                            <div class="dd-dot c-yellow"></div>
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                <path d="M8 21h8M12 17v4M7 8l3 3-3 3"/><line x1="13" y1="11" x2="17" y2="11"/>
                            </svg>
                            เปิด Remote Projector (VNC)
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
                <?php endif; ?>

            </div>
            <?php endif; ?>

        </div>

        <div class="stat-bar">
            <div class="stat-pill">
                <div class="stat-pill-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#ffd93d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-pill-label">Total Seats</div>
                    <div class="stat-pill-value" id="seat-count-val"><?php echo e(number_format($theatre->seat_count ?? 0)); ?></div>
                </div>
            </div>
            <?php if($theatre->Type_name): ?>
            <div class="stat-pill">
                <div class="stat-pill-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#ffd93d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="14" rx="2"/><line x1="8" y1="22" x2="16" y2="22"/><line x1="12" y1="18" x2="12" y2="22"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-pill-label">Screen Type</div>
                    <div class="stat-pill-value" style="font-size:.9rem;padding-top:2px;"><?php echo e($theatre->Type_name); ?></div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($theatre->special_format): ?>
            <div class="stat-pill">
                <div class="stat-pill-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#ffd93d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-pill-label">Format</div>
                    <div class="stat-pill-value" style="font-size:.9rem;padding-top:2px;"><?php echo e($theatre->special_format); ?></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="row g-3">

        <div class="col-lg-6">
            <div class="info-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffd93d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <span class="card-head-title">General Information</span>
                </div>
                <div class="info-row"><div class="row-label">Hall No.</div><div class="row-value accent"><?php echo e($theatre->theatre_number ?? '-'); ?></div></div>
                <?php if($theatre->Type_name): ?>
                <div class="info-row"><div class="row-label">Screen Type</div><div class="row-value"><?php echo e($theatre->Type_name); ?></div></div>
                <?php endif; ?>
                <?php if($theatre->special_format): ?>
                <div class="info-row"><div class="row-label">Special Format</div><div class="row-value"><span class="format-tag"><?php echo e($theatre->special_format); ?></span></div></div>
                <?php endif; ?>
                <div class="info-row"><div class="row-label">Seat Capacity</div><div class="row-value accent"><?php echo e(number_format($theatre->seat_count ?? 0)); ?> <span style="color:#6a748f;font-weight:400;">seats</span></div></div>
                <?php if($theatre->three_d_type): ?>
                <div class="info-row"><div class="row-label">3D Type</div><div class="row-value"><?php echo e($theatre->three_d_type); ?></div></div>
                <?php endif; ?>
                <?php if($theatre->initial_installation): ?>
                <div class="info-row"><div class="row-label">Installed</div><div class="row-value"><?php echo e($theatre->initial_installation->format('d/m/Y')); ?></div></div>
                <?php endif; ?>
                <?php if($theatre->version): ?>
                <div class="info-row"><div class="row-label">Version</div><div class="row-value"><?php echo e($theatre->version); ?></div></div>
                <?php endif; ?>
            </div>

            <div class="info-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffd93d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
                    </div>
                    <span class="card-head-title">Sound System</span>
                </div>
                <div class="info-row"><div class="row-label">Brand</div><div class="row-value accent"><?php echo e($theatre->sound_make ?? '-'); ?></div></div>
                <div class="info-row"><div class="row-label">Model</div><div class="row-value"><?php echo e($theatre->sound_model ?? '-'); ?></div></div>
                <?php if($theatre->sound_ip): ?>
                <div class="info-row"><div class="row-label">Sound IP</div><div class="row-value"><span class="mono"><?php echo e($theatre->sound_ip); ?></span></div></div>
                <?php endif; ?>
                <?php if($theatre->sound_port): ?>
                <div class="info-row"><div class="row-label">Port</div><div class="row-value"><span class="mono"><?php echo e($theatre->sound_port); ?></span></div></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="info-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffd93d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
                    </div>
                    <span class="card-head-title">Server</span>
                </div>
                <div class="info-row"><div class="row-label">Brand</div><div class="row-value accent"><?php echo e($theatre->server_make ?? '-'); ?></div></div>
                <div class="info-row"><div class="row-label">Model</div><div class="row-value"><?php echo e($theatre->server_model ?? '-'); ?></div></div>
                <?php if($theatre->server_serial): ?>
                <div class="info-row"><div class="row-label">Serial</div><div class="row-value"><span class="mono"><?php echo e($theatre->server_serial); ?></span></div></div>
                <?php endif; ?>
                <?php if($theatre->client_ip): ?>
                <div class="info-row"><div class="row-label">Server IP</div><div class="row-value"><span class="mono"><?php echo e($theatre->client_ip); ?></span></div></div>
                <?php endif; ?>
            </div>

            <div class="info-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffd93d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 8h.01M8 8h.01"/><rect x="2" y="4" width="20" height="16" rx="2"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <span class="card-head-title">Projector</span>
                </div>
                <div class="info-row"><div class="row-label">Brand</div><div class="row-value accent"><?php echo e($theatre->projector_make ?? '-'); ?></div></div>
                <div class="info-row"><div class="row-label">Model</div><div class="row-value"><?php echo e($theatre->projector_model ?? '-'); ?></div></div>
                <?php if($theatre->projector_serial): ?>
                <div class="info-row"><div class="row-label">Serial</div><div class="row-value"><span class="mono"><?php echo e($theatre->projector_serial); ?></span></div></div>
                <?php endif; ?>
                
                <?php if($theatre->projector_ip): ?>
                <div class="info-row">
                    <div class="row-label">Projector IP</div>
                    <div class="row-value"><span class="mono"><?php echo e($theatre->projector_ip); ?></span></div>
                </div>
                <?php endif; ?>
                <?php if($theatre->lamp_type): ?>
                <div class="info-row"><div class="row-label">Lamp / Laser</div><div class="row-value"><?php echo e($theatre->lamp_type); ?></div></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function copyText(text, btn) {
        const orig = btn.innerHTML;
        const done = () => {
            btn.classList.add('copied');
            btn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><polyline points="20 6 9 17 4 12"/></svg> Copied';
            setTimeout(() => { btn.classList.remove('copied'); btn.innerHTML = orig; }, 2000);
        };
        navigator.clipboard ? navigator.clipboard.writeText(text).then(done).catch(() => fallback(text,done)) : fallback(text,done);
    }
    function fallback(text,cb) { const t=document.createElement('input');t.value=text;document.body.appendChild(t);t.select();document.execCommand('copy');document.body.removeChild(t);cb(); }

    const sBtn=document.getElementById('copy-server-ip-btn');
    const sEl =document.getElementById('server-ip-text');
    if(sBtn && sEl) sBtn.addEventListener('click',()=>copyText(sEl.textContent.trim(),sBtn));

    const seatEl=document.getElementById('seat-count-val');
    if(seatEl){ const target=parseInt(seatEl.textContent.replace(/,/g,''),10); if(!isNaN(target)&&target>0&&target<10000){ let cur=0;const step=target/40;const iv=setInterval(()=>{ cur=Math.min(cur+step,target);seatEl.textContent=Math.floor(cur).toLocaleString();if(cur>=target)clearInterval(iv); },18); } }
});

function toggleSrvMenu(e) {
    e.stopPropagation();
    const dd   = document.getElementById('srv-dropdown');
    const wrap = document.getElementById('srv-badge-wrap');
    dd.classList.toggle('open');
    wrap.classList.toggle('open');
}

async function runGdcServer(ip) {
    try {
        const st=await fetch('http://localhost:18182/status'); const sj=await st.json();
        if(!sj.ok) throw new Error('not running');
        const r=await fetch(`http://localhost:18182/run?ip=${encodeURIComponent(ip)}`); const d=await r.json();
        if(!d.ok){alert('❌ ไม่พบ TightVNC Viewer ในเครื่อง');return;}
        alert('✅ เปิด TightVNC Viewer แล้ว\n📋 IP: '+d.ip);
    } catch(e) { alert('❌ ยังไม่ได้เปิด tightvnc-agent.exe\nให้กด "ดาวน์โหลด" แล้วเปิดก่อน'); }
}

function toggleProjMenu(e) {
    e.stopPropagation();
    const dd   = document.getElementById('proj-dropdown');
    const wrap = document.getElementById('proj-badge-wrap');
    dd.classList.toggle('open');
    wrap.classList.toggle('open');
}
function closeAllDD() {
    document.querySelectorAll('.proj-dropdown.open').forEach(el=>el.classList.remove('open'));
    document.querySelectorAll('.proj-badge-wrap.open,.srv-badge-wrap.open').forEach(el=>el.classList.remove('open'));
}
document.addEventListener('click', closeAllDD);

function copyProjIp(btn) {
    const ip = document.getElementById('proj-ip-val')?.textContent.trim();
    if (!ip) return;
    const orig = btn.innerHTML;
    const done = () => { btn.innerHTML='<div class="dd-dot c-cyan"></div><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Copied!'; setTimeout(()=>{ btn.innerHTML=orig; },2000); };
    navigator.clipboard ? navigator.clipboard.writeText(ip).then(done).catch(()=>{ prompt('Copy:',ip); }) : (prompt('Copy:',ip), done());
}

function downloadTightVncAgent() { window.open('/downloads/tightvnc-agent.exe','_blank'); }

async function runProjectorVNC(ip) {
    try {
        const st=await fetch('http://localhost:18182/status'); const sj=await st.json();
        if(!sj.ok) throw new Error('not running');
        const r=await fetch(`http://localhost:18182/run?ip=${encodeURIComponent(ip)}`); const d=await r.json();
        if(!d.ok){alert('❌ ไม่พบ TightVNC Viewer ในเครื่อง');return;}
        alert('✅ เปิด Remote Projector แล้ว\n📋 IP: '+d.ip);
    } catch(e) { alert('❌ ยังไม่ได้เปิด tightvnc-agent.exe\nให้กด "ดาวน์โหลด" แล้วเปิดก่อน'); }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/theatres/show.blade.php ENDPATH**/ ?>