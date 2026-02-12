<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $branch->name }} – รายชื่อโรงฉาย</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700&display=swap" rel="stylesheet">

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

        .header-wrapper {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .header-wrapper::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 195, 18, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .mc-title {
            font-weight: 700;
            font-size: 2.5rem;
            background: linear-gradient(135deg, #ff6b6b 0%, #ffd93d 50%, #4ecdc4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 30px rgba(255, 107, 107, 0.3);
        }

        .mc-subtitle {
            color: #a8b2d1;
            font-size: 1rem;
            font-weight: 300;
        }

        .ip-badge-wrapper {
            position: relative;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: stretch;
        }

        /* ไอคอน SVG */
        .icon-globe {
            width: 16px;
            height: 16px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        .icon-server {
            width: 16px;
            height: 16px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        /* Base style สำหรับทั้งสองปุ่ม */
        .badge-base {
            padding: 11px 20px;
            font-weight: 700;
            font-size: 0.95rem;
            border-radius: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            border: 2px solid;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 170px;
            justify-content: center;
        }

        .badge-header {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.75rem;
            opacity: 0.85;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .badge-value {
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        /* ปุ่ม Branch IP */
        .mc-ip-badge {
            background: linear-gradient(135deg, #ffd93d 0%, #ffed4e 100%);
            color: #1a1a2e;
            box-shadow: 0 8px 25px rgba(255, 195, 18, 0.4);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .mc-ip-badge::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0%, 100% { transform: translateX(-100%) rotate(45deg); }
            50% { transform: translateX(100%) rotate(45deg); }
        }

        /* ปุ่ม TMS */
        .mc-tms-badge {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%);
            color: #ffffff;
            box-shadow: 
                0 8px 25px rgba(6, 182, 212, 0.4),
                inset 0 1px 2px rgba(255, 255, 255, 0.25);
            border-color: rgba(103, 232, 249, 0.4);
        }

        .mc-tms-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                135deg,
                transparent 0%,
                rgba(255, 255, 255, 0.1) 50%,
                transparent 100%
            );
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mc-tms-badge::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -150%;
            width: 200%;
            height: 300%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.15),
                rgba(255, 255, 255, 0.3),
                rgba(255, 255, 255, 0.15),
                transparent
            );
            transform: skewX(-20deg);
            animation: tmsShine 5s ease-in-out infinite;
        }

        @keyframes tmsShine {
            0% {
                left: -150%;
            }
            40% {
                left: 150%;
            }
            100% {
                left: 150%;
            }
        }

        .mc-tms-badge:hover {
            background: linear-gradient(135deg, #22d3ee 0%, #06b6d4 50%, #0891b2 100%);
            transform: translateY(-3px) scale(1.03);
            box-shadow: 
                0 12px 35px rgba(6, 182, 212, 0.6),
                0 0 30px rgba(34, 211, 238, 0.3),
                inset 0 1px 3px rgba(255, 255, 255, 0.3);
            border-color: rgba(165, 243, 252, 0.6);
            color: #ffffff;
        }

        .mc-tms-badge:hover::before {
            opacity: 1;
        }

        .mc-tms-badge:active {
            transform: translateY(-1px) scale(1.01);
            box-shadow: 
                0 6px 20px rgba(6, 182, 212, 0.5),
                inset 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        /* เพิ่มเอฟเฟกต์ glow เบาๆ */
        @keyframes tmsGlow {
            0%, 100% {
                box-shadow: 
                    0 8px 25px rgba(6, 182, 212, 0.4),
                    inset 0 1px 2px rgba(255, 255, 255, 0.25);
            }
            50% {
                box-shadow: 
                    0 8px 25px rgba(6, 182, 212, 0.55),
                    0 0 25px rgba(34, 211, 238, 0.25),
                    inset 0 1px 2px rgba(255, 255, 255, 0.25);
            }
        }

        .mc-tms-badge {
            animation: tmsGlow 3s ease-in-out infinite;
        }

        .mc-tms-badge:hover {
            animation: none;
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

        .table-wrapper {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 0;
            overflow: hidden;
        }

        .table {
            margin: 0;
            color: #e2e8f0;
        }

        .table thead {
            background: linear-gradient(135deg, rgba(255, 107, 107, 0.15), rgba(78, 205, 196, 0.15));
            border-bottom: 2px solid rgba(255, 195, 18, 0.3);
        }

        .table thead th {
            color: #ffd93d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1.2rem 1rem;
            border: none;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s;
        }

        .table tbody tr:hover {
            background: rgba(255, 195, 18, 0.08);
            transform: scale(1.01);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.15);
        }

        .table tbody td {
            padding: 1.2rem 1rem;
            border: none;
            vertical-align: middle;
        }

        .theatre-number {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, rgba(255, 107, 107, 0.2), rgba(255, 195, 18, 0.2));
            padding: 8px 16px;
            border-radius: 12px;
            display: inline-block;
            min-width: 60px;
            text-align: center;
            border: 1px solid rgba(255, 195, 18, 0.3);
        }

        .badge-type {
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.25), rgba(14, 165, 233, 0.25));
            color: #7dd3fc;
            border: 1px solid rgba(56, 189, 248, 0.5);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(56, 189, 248, 0.2);
        }

        .badge-special {
            background: linear-gradient(135deg, rgba(250, 204, 21, 0.25), rgba(251, 146, 60, 0.25));
            color: #fde047;
            border: 1px solid rgba(250, 204, 21, 0.5);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(250, 204, 21, 0.2);
        }

        .equipment-text {
            color: #cbd5e1;
            font-size: 0.9rem;
        }

        .btn-detail {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
            color: #fff;
            font-weight: 600;
            border-radius: 50px;
            padding: 8px 20px;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            font-size: 0.9rem;
        }

        .btn-detail:hover {
            background: linear-gradient(135deg, #ff8787 0%, #ffd93d 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 195, 18, 0.4);
            color: #1a1a2e;
        }

        .seat-count {
            font-weight: 600;
            color: #4ecdc4;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .mc-title {
                font-size: 1.8rem;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            .table {
                font-size: 0.85rem;
            }

            .header-wrapper {
                padding: 1.5rem;
            }

            .badge-base {
                padding: 9px 16px;
                font-size: 0.85rem;
                min-width: 140px;
            }

            .ip-badge-wrapper {
                justify-content: flex-start;
            }
        }

        .stats-row {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .stat-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 1.5rem;
            border-radius: 15px;
            flex: 1;
            min-width: 150px;
        }

        .stat-label {
            color: #a8b2d1;
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }

        .stat-value {
            color: #ffd93d;
            font-size: 1.5rem;
            font-weight: 700;
        }
    </style>
</head>

<body>

<div class="container py-4">

    <a href="{{ route('home') }}" class="back-btn mb-3">
        ← Back to Home
    </a>

    <div class="header-wrapper">
        <div class="header-content">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-3 mb-lg-0">
                    <div class="mc-title">🎬 {{ $branch->name }}</div>
                    <div class="mc-subtitle">
                        View theatres, projection systems, servers, and projectors for this branch
                    </div>
                    
                    <div class="stats-row">
                        <div class="stat-box">
                            <div class="stat-label">Total Theatres</div>
                            <div class="stat-value">{{ count($theatres) }}</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-label">Total Seats</div>
                            <div class="stat-value">{{ number_format($theatres->sum('seat_count')) }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <div class="ip-badge-wrapper">
                        {{-- Branch IP --}}
                        <div class="mc-ip-badge badge-base">
                            <div class="badge-header">
                                <svg class="icon-globe" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                </svg>
                                <span>Branch IP</span>
                            </div>
                            <div class="badge-value">{{ $branch->branch_ip }}</div>
                        </div>

                        {{-- TMS Badge --}}
                        @if (!empty($branch->tms_ip))
                            <a
                                href="http://{{ $branch->tms_ip }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mc-tms-badge badge-base"
                                title="Open TMS System"
                            >
                                <div class="badge-header">
                                    <svg class="icon-server" viewBox="0 0 24 24">
                                        <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                        <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                        <line x1="6" y1="6" x2="6.01" y2="6"></line>
                                        <line x1="6" y1="18" x2="6.01" y2="18"></line>
                                    </svg>
                                    <span>TMS Server</span>
                                </div>
                                <div class="badge-value">{{ $branch->tms_ip }}</div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>Theatre</th>
                <th>Screen Type</th>
                <th>Special Format</th>
                <th>Seats</th>
                <th>Projector</th>
                <th>Server</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($theatres as $theatre)
                <tr>
                    <td>
                        <span class="theatre-number">{{ $theatre->theatre_number }}</span>
                    </td>

                    <td>
                        @if($theatre->Type_name)
                            <span class="badge-type">{{ $theatre->Type_name }}</span>
                        @else
                            <span style="color: #64748b;">-</span>
                        @endif
                    </td>

                    <td>
                        @if($theatre->special_format)
                            <span class="badge-special">{{ $theatre->special_format }}</span>
                        @else
                            <span style="color: #64748b;">-</span>
                        @endif
                    </td>

                    <td>
                        <span class="seat-count">{{ number_format($theatre->seat_count) }}</span>
                    </td>

                    <td class="equipment-text">
                        {{ $theatre->projector_make }} {{ $theatre->projector_model }}
                    </td>

                    <td class="equipment-text">
                        {{ $theatre->server_make }} {{ $theatre->server_model }}
                    </td>

                    <td class="text-center">
                        <a href="{{ route('branches.theatres.show', [$branch->id, $theatre->id]) }}"
                           class="btn-detail">
                            View Details →
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>