@extends('layouts.app')

@section('title', 'Admin Dashboard – Major Cinema Data Center')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700;800&family=Kanit:wght@300;400;600;700&display=swap');

    * {
        font-family: 'Prompt', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
        
    }

    /* ============= ANIMATED BACKGROUND ============= */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 50%, rgba(250, 204, 21, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(249, 115, 22, 0.06) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(250, 204, 21, 0.05) 0%, transparent 50%);
        animation: gradientShift 15s ease infinite;
        pointer-events: none;
        z-index: 0;
    }

    @keyframes gradientShift {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

 .container {
        position: relative;
        z-index: 1;
        max-width: 1600px;
    }


    /* ============= HEADER WITH ANIMATION ============= */
    .admin-header {
        margin-bottom: 3.5rem;
        text-align: center;
        position: relative;
        animation: fadeInDown 0.8s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .welcome-badge {
        display: inline-block;
        background: rgba(250, 204, 21, 0.15);
        border: 1px solid rgba(250, 204, 21, 0.3);
        padding: 0.6rem 2rem;
        border-radius: 50px;
        color: #facc15;
        font-weight: 600;
        margin-bottom: 1.3rem;
        font-size: 0.95rem;
        box-shadow: 0 2px 12px rgba(250, 204, 21, 0.15);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 2px 12px rgba(250, 204, 21, 0.15);
        }
        50% {
            box-shadow: 0 4px 20px rgba(250, 204, 21, 0.3);
        }
    }

    .admin-title {
        font-size: 3.8rem;
        font-weight: 800;
        font-family: 'Kanit', sans-serif;
        background: linear-gradient(135deg, #facc15 0%, #f97316 50%, #fbbf24 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.9rem;
        letter-spacing: -2px;
        filter: drop-shadow(0 2px 12px rgba(250, 204, 21, 0.3));
        animation: titleGlow 3s ease-in-out infinite;
    }

    @keyframes titleGlow {
        0%, 100% {
            filter: drop-shadow(0 2px 12px rgba(250, 204, 21, 0.3));
        }
        50% {
            filter: drop-shadow(0 4px 20px rgba(250, 204, 21, 0.5));
        }
    }

    .admin-subtitle {
        font-size: 1.05rem;
        color: #94a3b8;
        font-weight: 400;
        line-height: 1.7;
        max-width: 600px;
        margin: 0 auto;
        letter-spacing: 0.2px;
    }

    /* ============= STATS CARDS ============= */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.8rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 18px;
        padding: 2rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, transparent, #facc15, transparent);
        transition: left 0.5s ease;
    }

    .stat-card:nth-child(2)::before {
        background: linear-gradient(90deg, transparent, #f97316, transparent);
    }

    .stat-card:nth-child(3)::before {
        background: linear-gradient(90deg, transparent, #fbbf24, transparent);
    }

    .stat-card:hover::before {
        left: 100%;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 12px 40px rgba(250, 204, 21, 0.3);
        border-color: rgba(250, 204, 21, 0.4);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: rgba(250, 204, 21, 0.15);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.2rem;
        transition: all 0.3s ease;
    }

    .stat-card:nth-child(2) .stat-icon {
        background: rgba(249, 115, 22, 0.15);
    }

    .stat-card:nth-child(3) .stat-icon {
        background: rgba(251, 191, 36, 0.15);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        font-family: 'Kanit', sans-serif;
        background: linear-gradient(135deg, #facc15, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.4rem;
        line-height: 1;
    }

    /* Adjust font size for user name in third stat card */
    .stat-card:nth-child(3) .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .stat-label {
        color: #94a3b8;
        font-size: 0.95rem;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    /* ============= MANAGEMENT CARDS ============= */
    .section-title {
        font-size: 1.9rem;
        font-weight: 700;
        font-family: 'Kanit', sans-serif;
        color: #f1f5f9;
        margin-bottom: 2rem;
        letter-spacing: -0.5px;
        position: relative;
        display: inline-block;
        animation: fadeInUp 0.8s ease-out 0.4s backwards;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #facc15, transparent);
        border-radius: 2px;
    }

    .admin-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .admin-card {
        background: #0f172a;
        border-radius: 18px;
        border: 1px solid #1e293b;
        padding: 2.5rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
        animation: fadeInUp 0.8s ease-out backwards;
    }

    .admin-card:nth-child(1) { animation-delay: 0.5s; }
    .admin-card:nth-child(2) { animation-delay: 0.6s; }

    .admin-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at top left, rgba(250, 204, 21, 0.1), transparent 50%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .admin-card:nth-child(2)::before {
        background: radial-gradient(circle at top left, rgba(249, 115, 22, 0.1), transparent 50%);
    }

    .admin-card:hover::before {
        opacity: 1;
    }

    .admin-card:hover {
        transform: translateY(-10px);
        border-color: #facc15;
        box-shadow: 0 12px 40px rgba(250, 204, 21, 0.3);
    }

    .card-icon {
        width: 70px;
        height: 70px;
        background: rgba(250, 204, 21, 0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.8rem;
        transition: all 0.4s ease;
        position: relative;
    }

    .admin-card:nth-child(2) .card-icon {
        background: rgba(249, 115, 22, 0.15);
    }

    .card-icon::before {
        content: '';
        position: absolute;
        inset: -3px;
        border-radius: 16px;
        background: linear-gradient(135deg, #facc15, #f97316);
        opacity: 0;
        filter: blur(8px);
        transition: opacity 0.4s ease;
    }

    .admin-card:hover .card-icon::before {
        opacity: 0.6;
    }

    .admin-card:hover .card-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .card-icon svg {
        width: 36px;
        height: 36px;
        fill: #facc15;
        position: relative;
        z-index: 1;
    }

    .admin-card:nth-child(2) .card-icon svg {
        fill: #f97316;
    }

    .admin-card h4 {
        font-size: 1.7rem;
        font-weight: 700;
        font-family: 'Kanit', sans-serif;
        color: #f1f5f9;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
        position: relative;
        z-index: 1;
    }

    .admin-card p {
        color: #94a3b8;
        font-size: 0.98rem;
        line-height: 1.7;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    .admin-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.7rem;
        border-radius: 999px;
        padding: 0.9rem 2.2rem;
        font-weight: 600;
        background: linear-gradient(135deg, #facc15, #f97316);
        color: #111827;
        border: none;
        text-decoration: none;
        box-shadow: 0 6px 18px rgba(250, 204, 21, 0.35);
        transition: all 0.3s ease;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .admin-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .admin-btn:hover::before {
        left: 100%;
    }

    .admin-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(250, 204, 21, 0.5);
        color: #020617;
    }

    .btn-arrow {
        transition: transform 0.3s ease;
        font-size: 1.1rem;
    }

    .admin-btn:hover .btn-arrow {
        transform: translateX(6px);
    }

    /* ============= QUICK ACTIONS ============= */
    .quick-actions {
        margin-top: 3rem;
        padding: 2.5rem;
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.8s ease-out 0.7s backwards;
    }

    .quick-actions h5 {
        font-size: 1.5rem;
        font-weight: 700;
        font-family: 'Kanit', sans-serif;
        color: #f1f5f9;
        margin-bottom: 1.8rem;
        letter-spacing: -0.3px;
    }

    .action-links {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .action-link {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.75rem 1.8rem;
        border-radius: 12px;
        color: #94a3b8;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.93rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .action-link::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(250, 204, 21, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.4s ease, height 0.4s ease;
    }

    .action-link:hover::before {
        width: 300px;
        height: 300px;
    }

    .action-link:hover {
        border-color: rgba(250, 204, 21, 0.4);
        color: #facc15;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(250, 204, 21, 0.25);
    }

    .action-link span {
        position: relative;
        z-index: 1;
    }

    /* ============= RESPONSIVE ============= */
    @media (max-width: 768px) {
        .admin-title {
            font-size: 2.5rem;
        }

        .admin-subtitle {
            font-size: 0.95rem;
        }

        .stats-grid,
        .admin-cards {
            grid-template-columns: 1fr;
        }

        .action-links {
            flex-direction: column;
        }

        .action-link {
            text-align: center;
        }

        .section-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container py-4">

    {{-- Header --}}
    <div class="admin-header">
        <div class="welcome-badge">
            Welcome, {{ auth()->user()->name }}
        </div>
        <div class="admin-title">Admin Dashboard</div>
        <div class="admin-subtitle">
            Branch and Theatre Management System<br>
            Major Cinema Data Center
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#facc15">
                    <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                    <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                </svg>
            </div>
            <div class="stat-number">183</div>
            <div class="stat-label">Total Branches</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f97316">
                    <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 18.375V5.625zM21 9.375A.375.375 0 0020.625 9h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zM10.875 18.75a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5zM3.375 15h7.5a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375zm0-3.75h7.5a.375.375 0 00.375-.375v-1.5A.375.375 0 0010.875 9h-7.5A.375.375 0 003 9.375v1.5c0 .207.168.375.375.375z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="stat-number">843</div>
            <div class="stat-label">Total Theatres</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#fbbf24">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="stat-number">{{ auth()->user()->name }}</div>
            <div class="stat-label">Logged in as Admin</div>
        </div>
    </div>

    {{-- Management Section --}}
    <h3 class="section-title">Management Tools</h3>
    
    <div class="admin-cards">
        {{-- Manage Branches --}}
        <div class="admin-card">
            <div class="card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                    <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                </svg>
            </div>
            <h4>Manage Branches</h4>
            <p>
                Add, edit, and delete all cinema branch information across the country. 
                Control branch details, locations, and regional organization.
            </p>
            <a href="{{ route('admin.branches.index') }}" class="admin-btn">
                <span>Go to Branches</span>
                <span class="btn-arrow">→</span>
            </a>
        </div>

        {{-- Manage Theatres --}}
        <div class="admin-card">
            <div class="card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 18.375V5.625zM21 9.375A.375.375 0 0020.625 9h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zM10.875 18.75a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5zM3.375 15h7.5a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375zm0-3.75h7.5a.375.375 0 00.375-.375v-1.5A.375.375 0 0010.875 9h-7.5A.375.375 0 003 9.375v1.5c0 .207.168.375.375.375z" clip-rule="evenodd" />
                </svg>
            </div>
            <h4>Manage Theatres</h4>
            <p>
                Manage all theatre information including projectors, servers, and IP addresses. 
                Update technical specifications and equipment details.
            </p>
            <a href="{{ route('admin.theatres.index') }}" class="admin-btn">
                <span>Go to Theatres</span>
                <span class="btn-arrow">→</span>
            </a>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="quick-actions">
        <h5>Quick Actions</h5>
        <div class="action-links">
            <a href="{{ route('admin.branches.create') }}" class="action-link"><span>Add New Branch</span></a>
            <a href="{{ route('admin.theatres.create') }}" class="action-link"><span>Add New Theatre</span></a>
            <a href="{{ route('home') }}" class="action-link"><span>View Public Site</span></a>
        </div>
    </div>

</div>
@endsection