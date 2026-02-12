<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', config('app.name'))</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Prompt', sans-serif; }
        body { background: #0f172a; color: #f1f5f9; min-height: 100vh; }
        .navbar-custom { background: #1e293b; border-bottom: 1px solid #334155; }
        .navbar-brand { display:flex; align-items:center; gap:10px; text-decoration:none; padding:0; }
        .navbar-logo-icon { width:36px; height:43px; flex-shrink:0; }
        .navbar-logo-text { font-size:1.35rem; font-weight:700; color:#facc15; letter-spacing:.5px; line-height:1; }
        .navbar-brand:hover .navbar-logo-text { color:#fde047; }
        .nav-link { color:#e2e8f0 !important; }
        .nav-link:hover { color:#facc15 !important; }
        .nav-link.active { color:#facc15 !important; font-weight:600; }
        .admin-badge { background:#f59e0b; padding:3px 8px; font-size:.75rem; border-radius:6px; color:#1e1e1e; }
        footer { margin-top:60px; padding:20px 0; text-align:center; color:#94a3b8; font-size:.85rem; }
        @media (max-width:768px){
            .navbar-logo-icon{ width:30px; height:36px; }
            .navbar-logo-text{ font-size:1.1rem; }
        }
    </style>

    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            {{-- โลโก้เดิม ไม่ยุ่ง --}}
            <svg class="navbar-logo-icon" viewBox="0 0 100 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="20" width="18" height="80" fill="url(#navPillar1)" rx="2"/>
                <rect x="10" y="20" width="18" height="12" fill="#D94B2A" rx="2"/>
                <rect x="10" y="88" width="18" height="12" fill="#C44229" rx="2"/>
                <rect x="41" y="10" width="18" height="100" fill="url(#navPillar2)" rx="2"/>
                <rect x="41" y="10" width="18" height="15" fill="#D94B2A" rx="2"/>
                <rect x="41" y="95" width="18" height="15" fill="#C44229" rx="2"/>
                <rect x="72" y="20" width="18" height="80" fill="url(#navPillar3)" rx="2"/>
                <rect x="72" y="20" width="18" height="12" fill="#D94B2A" rx="2"/>
                <rect x="72" y="88" width="18" height="12" fill="#C44229" rx="2"/>
                <defs>
                    <linearGradient id="navPillar1" x1="19" y1="20" x2="19" y2="100">
                        <stop offset="0%" stop-color="#E85A3C"/>
                        <stop offset="50%" stop-color="#D94B2A"/>
                        <stop offset="100%" stop-color="#C44229"/>
                    </linearGradient>
                    <linearGradient id="navPillar2" x1="50" y1="10" x2="50" y2="110">
                        <stop offset="0%" stop-color="#E85A3C"/>
                        <stop offset="50%" stop-color="#D94B2A"/>
                        <stop offset="100%" stop-color="#C44229"/>
                    </linearGradient>
                    <linearGradient id="navPillar3" x1="81" y1="20" x2="81" y2="100">
                        <stop offset="0%" stop-color="#E85A3C"/>
                        <stop offset="50%" stop-color="#D94B2A"/>
                        <stop offset="100%" stop-color="#C44229"/>
                    </linearGradient>
                </defs>
            </svg>
            <span class="navbar-logo-text">Major Cineplex</span>
        </a>

        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                @auth
                    @if(auth()->user()->role === 'admin')

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                               href="{{ route('admin.dashboard') }}">
                                Dashboard <span class="admin-badge">Admin</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}"
                               href="{{ route('admin.branches.index') }}">
                                Manage Branches
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.theatres.*') ? 'active' : '' }}"
                               href="{{ route('admin.theatres.index') }}">
                                Manage Theatres
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                               href="{{ route('admin.users.index') }}">
                                Manage Users
                            </a>
                        </li>

                    @endif

                    {{-- ❌ ตัดเมนูชื่อผู้ใช้ออกตามที่สั่ง --}}

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link" style="display:inline; cursor:pointer;">
                                Logout
                            </button>
                        </form>
                    </li>

                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<main class="py-4 container">
    @yield('content')
</main>

<footer>
    {{ config('app.name') }} © {{ date('Y') }}
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>