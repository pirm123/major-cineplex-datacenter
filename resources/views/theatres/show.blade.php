@extends('layouts.app')

@section('content')
<style>
    * {
        font-family: 'Prompt', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(255, 107, 107, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(78, 205, 196, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(255, 195, 18, 0.06) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .container {
        position: relative;
        z-index: 1;
    }

    .page-header {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 30% 50%, rgba(255, 195, 18, 0.1) 0%, transparent 60%);
        pointer-events: none;
    }

    .header-content {
        position: relative;
        z-index: 1;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #ff6b6b 0%, #ffd93d 50%, #4ecdc4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .theatre-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #ff6b6b, #ffd93d);
        color: #1a1a2e;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        font-weight: 500;
        padding: 10px 24px;
        border-radius: 50px;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 195, 18, 0.4);
        color: #ffd93d;
        transform: translateX(-5px);
    }

    .info-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s;
        margin-bottom: 1.5rem;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(255, 107, 107, 0.2);
        border-color: rgba(255, 195, 18, 0.3);
    }

    .card-header-custom {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.15), rgba(78, 205, 196, 0.15));
        border-bottom: 2px solid rgba(255, 195, 18, 0.3);
        padding: 1rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        color: #ffd93d;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-body-custom {
        padding: 1.2rem 1.5rem;
    }

    .info-row {
        display: flex;
        align-items: flex-start;
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        gap: 1rem;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #a8b2d1;
        font-weight: 500;
        min-width: 140px;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .info-value {
        color: #fff;
        font-weight: 400;
        flex: 1;
        font-size: 0.9rem;
    }

    .info-value strong {
        color: #4ecdc4;
        font-weight: 600;
    }

    .special-badge {
        background: linear-gradient(135deg, rgba(250, 204, 21, 0.25), rgba(251, 146, 60, 0.25));
        color: #fde047;
        border: 1px solid rgba(250, 204, 21, 0.5);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
    }

    .ip-display {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(78, 205, 196, 0.3);
        padding: 12px 16px;
        border-radius: 12px;
        font-family: 'Courier New', monospace;
        font-size: 1.1rem;
        color: #4ecdc4;
        margin: 0.5rem 0;
        display: inline-block;
        font-weight: 600;
    }

    .copy-btn {
        background: linear-gradient(135deg, #4ecdc4 0%, #44a3a0 100%);
        border: none;
        color: #1a1a2e;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 50px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
        cursor: pointer;
        font-size: 0.85rem;
    }

    .copy-btn:hover {
        background: linear-gradient(135deg, #44a3a0 0%, #ffd93d 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(78, 205, 196, 0.4);
    }

    .open-server-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 10px 24px;
        border-radius: 50px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .open-server-btn:hover {
        background: linear-gradient(135deg, #ff8787 0%, #ffd93d 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 195, 18, 0.4);
        color: white;
    }

    .copy-status {
        color: #4ecdc4;
        font-weight: 600;
        animation: fadeIn 0.3s;
        font-size: 0.85rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .serial-code {
        background: rgba(0, 0, 0, 0.3);
        padding: 4px 10px;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        color: #a8b2d1;
    }

    .vpn-notice {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.15), rgba(255, 195, 18, 0.15));
        border: 1px solid rgba(255, 195, 18, 0.3);
        padding: 0.8rem 1.2rem;
        border-radius: 12px;
        color: #ffd93d;
        font-size: 0.85rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .icon-badge {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1rem;
        border-radius: 12px;
        text-align: center;
    }

    .stat-label {
        color: #a8b2d1;
        font-size: 0.85rem;
        margin-bottom: 0.3rem;
    }

    .stat-value {
        color: #ffd93d;
        font-size: 1.3rem;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }
        .info-label {
            min-width: 110px;
            font-size: 0.85rem;
        }
        .theatre-badge {
            font-size: 1rem;
            padding: 6px 16px;
        }
    }
</style>

<div class="container py-4">
    <a href="{{ route('branches.theatres.index', $branch->id) }}" class="back-btn mb-3">
        ← Back to Theatres
    </a>

    <div class="page-header">
        <div class="header-content">
            <div class="d-flex align-items-center gap-3 flex-wrap mb-3">
                <svg class="icon-badge" viewBox="0 0 100 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="10" y="20" width="18" height="80" fill="url(#pillarGrad1)" rx="2"/>
                    <rect x="10" y="20" width="18" height="12" fill="#D94B2A" rx="2"/>
                    <rect x="10" y="88" width="18" height="12" fill="#C44229" rx="2"/>
                    
                    <rect x="41" y="10" width="18" height="100" fill="url(#pillarGrad2)" rx="2"/>
                    <rect x="41" y="10" width="18" height="15" fill="#D94B2A" rx="2"/>
                    <rect x="41" y="95" width="18" height="15" fill="#C44229" rx="2"/>
                    
                    <rect x="72" y="20" width="18" height="80" fill="url(#pillarGrad3)" rx="2"/>
                    <rect x="72" y="20" width="18" height="12" fill="#D94B2A" rx="2"/>
                    <rect x="72" y="88" width="18" height="12" fill="#C44229" rx="2"/>
                    
                    <defs>
                        <linearGradient id="pillarGrad1" x1="19" y1="20" x2="19" y2="100" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#E85A3C"/>
                            <stop offset="50%" stop-color="#D94B2A"/>
                            <stop offset="100%" stop-color="#C44229"/>
                        </linearGradient>
                        <linearGradient id="pillarGrad2" x1="50" y1="10" x2="50" y2="110" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#E85A3C"/>
                            <stop offset="50%" stop-color="#D94B2A"/>
                            <stop offset="100%" stop-color="#C44229"/>
                        </linearGradient>
                        <linearGradient id="pillarGrad3" x1="81" y1="20" x2="81" y2="100" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#E85A3C"/>
                            <stop offset="50%" stop-color="#D94B2A"/>
                            <stop offset="100%" stop-color="#C44229"/>
                        </linearGradient>
                    </defs>
                </svg>
                <div>
                    <div class="page-title">{{ $branch->name }}</div>
                    <div class="theatre-badge">Theatre {{ $theatre->theatre_number }}</div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-label">Total Seats</div>
                    <div class="stat-value">{{ number_format($theatre->seat_count ?? 0) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- Left Column --}}
        <div class="col-lg-6">
            {{-- General Information --}}
            <div class="info-card">
                <div class="card-header-custom">
                    General Information
                </div>
                <div class="card-body-custom">
                    <div class="info-row">
                        <div class="info-label">Theatre No.:</div>
                        <div class="info-value"><strong>{{ $theatre->theatre_number ?? '-' }}</strong></div>
                    </div>

                    @if($theatre->Type_name)
                    <div class="info-row">
                        <div class="info-label">Screen Type:</div>
                        <div class="info-value">{{ $theatre->Type_name }}</div>
                    </div>
                    @endif

                    @if($theatre->special_format)
                    <div class="info-row">
                        <div class="info-label">Special Format:</div>
                        <div class="info-value">
                            <span class="special-badge">{{ $theatre->special_format }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="info-row">
                        <div class="info-label">Seat Capacity:</div>
                        <div class="info-value"><strong>{{ number_format($theatre->seat_count ?? 0) }}</strong> seats</div>
                    </div>

                    @if($theatre->three_d_type)
                    <div class="info-row">
                        <div class="info-label">3D Type:</div>
                        <div class="info-value">{{ $theatre->three_d_type }}</div>
                    </div>
                    @endif

                    @if($theatre->initial_installation)
                    <div class="info-row">
                        <div class="info-label">Initial Installation:</div>
                        <div class="info-value">{{ $theatre->initial_installation->format('d/m/Y') }}</div>
                    </div>
                    @endif

                    @if($theatre->version)
                    <div class="info-row">
                        <div class="info-label">Version:</div>
                        <div class="info-value">{{ $theatre->version }}</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Sound System --}}
            <div class="info-card">
                <div class="card-header-custom">
                    Sound System
                </div>
                <div class="card-body-custom">
                    <div class="info-row">
                        <div class="info-label">Brand:</div>
                        <div class="info-value"><strong>{{ $theatre->sound_make ?? '-' }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Model:</div>
                        <div class="info-value">{{ $theatre->sound_model ?? '-' }}</div>
                    </div>
                    @if($theatre->sound_ip)
                    <div class="info-row">
                        <div class="info-label">Sound IP:</div>
                        <div class="info-value">
                            <span class="serial-code">{{ $theatre->sound_ip }}</span>
                        </div>
                    </div>
                    @endif
                    @if($theatre->sound_port)
                    <div class="info-row">
                        <div class="info-label">Sound Port:</div>
                        <div class="info-value">{{ $theatre->sound_port }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-lg-6">
            {{-- Server --}}
            <div class="info-card">
                <div class="card-header-custom">
                    Server (Media Block)
                </div>
                <div class="card-body-custom">
                    <div class="info-row">
                        <div class="info-label">Brand:</div>
                        <div class="info-value"><strong>{{ $theatre->server_make ?? '-' }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Model:</div>
                        <div class="info-value">{{ $theatre->server_model ?? '-' }}</div>
                    </div>
                    @if($theatre->server_serial)
                    <div class="info-row">
                        <div class="info-label">Serial:</div>
                        <div class="info-value">
                            <span class="serial-code">{{ $theatre->server_serial }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Projector --}}
            <div class="info-card">
                <div class="card-header-custom">
                    Projector
                </div>
                <div class="card-body-custom">
                    <div class="info-row">
                        <div class="info-label">Brand:</div>
                        <div class="info-value"><strong>{{ $theatre->projector_make ?? '-' }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Model:</div>
                        <div class="info-value">{{ $theatre->projector_model ?? '-' }}</div>
                    </div>
                    @if($theatre->projector_serial)
                    <div class="info-row">
                        <div class="info-label">Serial:</div>
                        <div class="info-value">
                            <span class="serial-code">{{ $theatre->projector_serial }}</span>
                        </div>
                    </div>
                    @endif
                    @if($theatre->projector_ip)
                    <div class="info-row">
                        <div class="info-label">Projector IP:</div>
                        <div class="info-value">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="serial-code" id="projector-ip-text">{{ $theatre->projector_ip }}</span>
                                <button id="copy-projector-ip-btn" class="copy-btn" type="button">
                                    Copy IP
                                </button>
                                <span id="copy-projector-ip-status" class="copy-status" style="display:none;">
                                    ✓ Copied!
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($theatre->lamp_type)
                    <div class="info-row">
                        <div class="info-label">Lamp / Laser Type:</div>
                        <div class="info-value">{{ $theatre->lamp_type }}</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Network / Server IP --}}
            <div class="info-card">
                <div class="card-header-custom">
                    Server / IP
                </div>
                <div class="card-body-custom">
                    <div class="vpn-notice">
                        <span>Connect to VPN before accessing</span>
                    </div>

                    <div class="info-label mb-2">Server IP Address:</div>
                    <div class="ip-display">{{ $theatre->client_ip ?? '-' }}</div>

                    @if($theatre->client_ip)
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <a href="http://{{ $theatre->client_ip }}" target="_blank" class="open-server-btn">
                            Open Server
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('copy-projector-ip-btn');
    const textEl = document.getElementById('projector-ip-text');
    const status = document.getElementById('copy-projector-ip-status');

    if (btn && textEl) {
        btn.addEventListener('click', function () {
            const ip = textEl.textContent.trim();
            if (!ip) return;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(ip)
                    .then(() => showCopied())
                    .catch(() => fallbackCopy(ip));
            } else {
                fallbackCopy(ip);
            }
        });
    }

    function fallbackCopy(text) {
        const temp = document.createElement('input');
        temp.value = text;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand('copy');
        document.body.removeChild(temp);
        showCopied();
    }

    function showCopied() {
        if (status) {
            status.style.display = 'inline-block';
            setTimeout(() => {
                status.style.display = 'none';
            }, 2000);
        }
    }
});
</script>

@endsection