<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Prompt', sans-serif; }
        body { background: #0f172a; color: #f1f5f9; min-height: 100vh; }

        /* ══ NAVBAR ══ */
        .navbar-custom {
            background: rgba(10, 14, 30, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
            min-height: 58px;
            padding: 0;
        }
        /* animated top line */
        .navbar-custom::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, #ff6b6b, #ffd93d, #4ecdc4, #ff6b6b);
            background-size: 200% auto;
            animation: navLine 5s linear infinite;
        }
        @keyframes navLine {
            0%   { background-position: 0% center; }
            100% { background-position: 200% center; }
        }
        .navbar-custom .container { min-height: 58px; }

        /* Brand */
        .navbar-brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; padding: 0; flex-shrink: 0;
        }
        .navbar-logo-icon {
            width: 28px; height: 34px; flex-shrink: 0;
            filter: drop-shadow(0 0 7px rgba(232,90,60,0.5));
            transition: filter 0.3s;
        }
        .navbar-brand:hover .navbar-logo-icon { filter: drop-shadow(0 0 12px rgba(255,195,18,0.65)); }
        .navbar-logo-text {
            font-size: 1.08rem; font-weight: 700;
            background: linear-gradient(120deg, #ff6b6b 0%, #ffd93d 55%, #4ecdc4 100%);
            background-size: 200% auto;
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            animation: brandShimmer 6s linear infinite;
        }
        @keyframes brandShimmer {
            0%   { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        /* Nav links */
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.62) !important;
            font-size: 0.83rem; font-weight: 500;
            padding: 6px 11px !important;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex; align-items: center; gap: 5px;
            border: 1px solid transparent;
            white-space: nowrap;
        }
        .navbar-nav .nav-link:hover {
            color: rgba(255,255,255,0.95) !important;
            background: rgba(255,255,255,0.07);
            border-color: rgba(255,255,255,0.08);
        }
        .navbar-nav .nav-link.active {
            color: #ffd93d !important;
            background: rgba(255,195,18,0.1);
            border-color: rgba(255,195,18,0.2);
            font-weight: 600;
        }
        .nav-icon { width: 13px; height: 13px; flex-shrink: 0; opacity: 0.65; transition: opacity 0.2s; }
        .nav-link:hover .nav-icon, .nav-link.active .nav-icon { opacity: 1; }

        /* Separator */
        .nav-sep { width: 1px; height: 18px; background: rgba(255,255,255,0.1); margin: 0 3px; flex-shrink: 0; }

        /* Admin badge */
        .admin-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: rgba(255,195,18,0.13);
            border: 1px solid rgba(255,195,18,0.28);
            color: #ffd93d;
            padding: 2px 9px 2px 6px;
            font-size: 0.7rem; font-weight: 700;
            border-radius: 20px; letter-spacing: 0.05em; text-transform: uppercase;
            margin-left: 3px;
        }
        .admin-dot {
            width: 5px; height: 5px; background: #ffd93d; border-radius: 50%;
            animation: dotPulse 2s ease-in-out infinite;
        }
        @keyframes dotPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(255,195,18,0.6); }
            50%       { box-shadow: 0 0 0 3px rgba(255,195,18,0); }
        }

        /* Logout */
        .btn-logout {
            display: inline-flex !important; align-items: center; gap: 5px;
            background: rgba(255,107,107,0.08) !important;
            border: 1px solid rgba(255,107,107,0.25) !important;
            color: rgba(255,107,107,0.8) !important;
            font-size: 0.82rem; font-weight: 500;
            padding: 5px 14px !important; border-radius: 7px;
            cursor: pointer; font-family: 'Prompt', sans-serif;
        }
        .btn-logout:hover {
            background: rgba(255,107,107,0.16) !important;
            border-color: rgba(255,107,107,0.45) !important;
            color: #ff8787 !important;
        }
        .btn-logout svg { width: 13px; height: 13px; }

        /* Login */
        .btn-login {
            background: rgba(255,195,18,0.1) !important;
            border: 1px solid rgba(255,195,18,0.28) !important;
            color: #ffd93d !important;
            font-size: 0.82rem; font-weight: 600;
            padding: 5px 16px !important; border-radius: 7px;
        }
        .btn-login:hover { background: rgba(255,195,18,0.18) !important; }

        /* Toggler */
        .navbar-toggler {
            border: 1px solid rgba(255,255,255,0.15);
            padding: 5px 8px;
            background: rgba(255,255,255,0.04) !important;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Footer */
        footer {
            margin-top: 60px; padding: 20px 0;
            text-align: center; color: rgba(148,163,184,0.45);
            font-size: 0.8rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        /* Mobile collapse panel */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(10,14,30,0.97);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255,255,255,0.07);
                border-radius: 12px;
                padding: 0.75rem 1rem;
                margin-top: 8px;
            }
            .navbar-nav .nav-link { padding: 9px 12px !important; }
            .nav-sep { width: 100%; height: 1px; margin: 4px 0; }
            .navbar-nav.gap-1 { gap: 2px !important; }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <svg class="navbar-logo-icon" viewBox="0 0 100 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="20" width="18" height="80" fill="url(#navP1)" rx="2"/>
                <rect x="10" y="20" width="18" height="12" fill="#D94B2A" rx="2"/>
                <rect x="10" y="88" width="18" height="12" fill="#C44229" rx="2"/>
                <rect x="41" y="10" width="18" height="100" fill="url(#navP2)" rx="2"/>
                <rect x="41" y="10" width="18" height="15" fill="#D94B2A" rx="2"/>
                <rect x="41" y="95" width="18" height="15" fill="#C44229" rx="2"/>
                <rect x="72" y="20" width="18" height="80" fill="url(#navP3)" rx="2"/>
                <rect x="72" y="20" width="18" height="12" fill="#D94B2A" rx="2"/>
                <rect x="72" y="88" width="18" height="12" fill="#C44229" rx="2"/>
                <defs>
                    <linearGradient id="navP1" x1="19" y1="20" x2="19" y2="100"><stop offset="0%" stop-color="#E85A3C"/><stop offset="100%" stop-color="#C44229"/></linearGradient>
                    <linearGradient id="navP2" x1="50" y1="10" x2="50" y2="110"><stop offset="0%" stop-color="#E85A3C"/><stop offset="100%" stop-color="#C44229"/></linearGradient>
                    <linearGradient id="navP3" x1="81" y1="20" x2="81" y2="100"><stop offset="0%" stop-color="#E85A3C"/><stop offset="100%" stop-color="#C44229"/></linearGradient>
                </defs>
            </svg>
            <span class="navbar-logo-text">Major Cineplex</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto align-items-center gap-1">

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Home
                    </a>
                </li>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role === 'admin'): ?>

                        <li class="d-flex align-items-center"><div class="nav-sep"></div></li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                                Dashboard
                                <span class="admin-badge"><div class="admin-dot"></div>Admin</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.branches.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.branches.index')); ?>">
                                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                Manage Branches
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.theatres.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.theatres.index')); ?>">
                                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="22"/><line x1="2" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="22" y2="12"/></svg>
                                Manage Theatres
                            </a>
                        </li>

                        <li class="d-flex align-items-center"><div class="nav-sep"></div></li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.excel') ? 'active' : ''); ?>" href="<?php echo e(route('admin.excel')); ?>">
                                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                Import / Export Excel
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users.index')); ?>">
                                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                Manage Users
                            </a>
                        </li>

                    <?php endif; ?>

                    <li class="d-flex align-items-center"><div class="nav-sep"></div></li>

                    <li class="nav-item">
                        <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin:0;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="nav-link btn-logout">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Logout
                            </button>
                        </form>
                    </li>

                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn-login" href="<?php echo e(route('login')); ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>

<main class="py-4 container">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<footer>
    <?php echo e(config('app.name')); ?> &copy; <?php echo e(date('Y')); ?>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>