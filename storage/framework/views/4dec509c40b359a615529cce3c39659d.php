<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Major Cinema Data Center')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Prompt', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top left, #1f2937 0, #020617 45%, #020617 100%);
            color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 1000px;
            padding: 2rem 1.5rem;
        }

        .auth-shell {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
            gap: 0;
            border-radius: 2rem;
            overflow: hidden;
            background: radial-gradient(circle at top left, rgba(248, 250, 252, 0.05), rgba(15, 23, 42, 0.9));
            box-shadow:
                0 24px 80px rgba(15, 23, 42, 0.9),
                0 0 40px rgba(78, 205, 196, 0.1);
            border: 1px solid rgba(78, 205, 196, 0.15);
            backdrop-filter: blur(18px);
        }

        .auth-hero {
            position: relative;
            padding: 3rem;
            background: 
                radial-gradient(circle at 0% 0%, rgba(78, 205, 196, 0.12), transparent 55%),
                radial-gradient(circle at 100% 100%, rgba(255, 211, 61, 0.08), transparent 55%),
                linear-gradient(145deg, #020617 0%, #0f172a 40%, #020617 100%);
            border-right: 1px solid rgba(78, 205, 196, 0.2);
            overflow: hidden;
        }

        .auth-hero::before {
            content: '';
            position: absolute;
            inset: -40%;
            background:
                radial-gradient(circle at 0 0, rgba(78, 205, 196, 0.15) 0, transparent 55%),
                radial-gradient(circle at 100% 0, rgba(255, 211, 61, 0.12) 0, transparent 55%),
                radial-gradient(circle at 50% 100%, rgba(68, 163, 160, 0.1) 0, transparent 55%);
            opacity: .8;
            mix-blend-mode: screen;
            animation: heroGlow 20s ease-in-out infinite;
        }

        @keyframes heroGlow {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(10%, 5%) scale(1.1); }
        }

        .auth-hero-inner {
            position: relative;
            z-index: 1;
            display: flex;
            height: 100%;
            flex-direction: column;
            justify-content: space-between;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .auth-logo:hover {
            transform: translateX(4px);
        }

        .auth-logo-badge {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4ecdc4, #44a3a0, #ffd93d);
            box-shadow: 
                0 12px 35px rgba(78, 205, 196, 0.5),
                0 0 0 4px rgba(78, 205, 196, 0.1);
            position: relative;
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        .auth-logo-inner {
            width: 2.8rem;
            height: 2.8rem;
            border-radius: 1rem;
            background: radial-gradient(circle at 30% 0, #4ecdc4, #020617 75%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
        }

        .auth-logo-text {
            display: flex;
            flex-direction: column;
        }

        .auth-logo-title {
            font-weight: 800;
            letter-spacing: .1em;
            font-size: .9rem;
            text-transform: uppercase;
            background: linear-gradient(135deg, #fff, #4ecdc4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .auth-logo-sub {
            font-size: .75rem;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 400;
        }

        .auth-heading {
            margin-top: 2.5rem;
        }

        .auth-title {
            font-size: 2rem;
            line-height: 1.3;
            font-weight: 800;
            color: #f9fafb;
            margin: 0;
        }

        .auth-title span {
            background: linear-gradient(135deg, #4ecdc4, #ffd93d, #44a3a0);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientShift 8s ease infinite;
            background-size: 200% 200%;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .auth-subtitle {
            margin-top: 1rem;
            font-size: .95rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        .auth-meta {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
            font-size: .85rem;
            color: rgba(255, 255, 255, 0.65);
        }

        .auth-meta-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem;
            background: rgba(78, 205, 196, 0.05);
            border-radius: .75rem;
            border: 1px solid rgba(78, 205, 196, 0.1);
            transition: all 0.3s ease;
        }

        .auth-meta-item:hover {
            background: rgba(78, 205, 196, 0.08);
            border-color: rgba(78, 205, 196, 0.2);
            transform: translateX(4px);
        }

        .auth-dot {
            width: .6rem;
            height: .6rem;
            min-width: .6rem;
            border-radius: 999px;
            background: linear-gradient(135deg, #4ecdc4, #44a3a0);
            box-shadow: 
                0 0 0 4px rgba(78, 205, 196, 0.15),
                0 0 20px rgba(78, 205, 196, 0.3);
            animation: dotPulse 2s ease-in-out infinite;
        }

        @keyframes dotPulse {
            0%, 100% { box-shadow: 0 0 0 4px rgba(78, 205, 196, 0.15), 0 0 20px rgba(78, 205, 196, 0.3); }
            50% { box-shadow: 0 0 0 6px rgba(78, 205, 196, 0.2), 0 0 25px rgba(78, 205, 196, 0.5); }
        }

        .auth-footnote {
            margin-top: 2rem;
            font-size: .75rem;
            color: rgba(255, 255, 255, 0.4);
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .auth-form-side {
            padding: 3rem 2.5rem;
            background: radial-gradient(circle at top, rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.98));
        }

        .auth-form-card {
            background: rgba(15, 23, 42, 0.98);
            border-radius: 1.5rem;
            border: 1px solid rgba(78, 205, 196, 0.15);
            padding: 2rem 1.75rem;
            box-shadow:
                0 18px 45px rgba(15, 23, 42, 0.9),
                0 0 0 1px rgba(78, 205, 196, 0.08);
            color: #e5e7eb;
        }

        .auth-form-card label {
            color: #e5e7eb;
            font-size: .9rem;
        }

        .auth-form-card input[type="email"],
        .auth-form-card input[type="password"],
        .auth-form-card input[type="text"] {
            background-color: #020617;
            border-color: #4b5563;
            color: #f9fafb;
        }

        .auth-form-card input::placeholder {
            color: #6b7280;
        }

        .auth-form-card .text-gray-600,
        .auth-form-card .text-gray-700,
        .auth-form-card .text-gray-800,
        .auth-form-card .text-gray-900 {
            color: #e5e7eb;
        }

        .auth-form-card .text-gray-400 {
            color: rgba(255, 255, 255, 0.7);
        }

        .auth-form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #f9fafb;
            margin-bottom: .35rem;
        }

        .auth-form-subtitle {
            font-size: .9rem;
            color: #9ca3af;
            margin-bottom: 1.4rem;
        }

        .auth-form-title span {
            color: #4ecdc4;
        }

        .auth-toggle {
            display: flex;
            justify-content: flex-end;
            gap: .5rem;
            margin-bottom: 1.15rem;
            font-size: .8rem;
        }

        .auth-toggle a {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.6);
            transition: color 0.2s ease;
        }

        .auth-toggle a:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        .auth-toggle a span {
            color: #4ecdc4;
            font-weight: 600;
        }

        /* Language Switcher */
        .lang-switcher {
            display: flex;
            justify-content: flex-end;
            margin-bottom: .75rem;
        }

        .lang-switcher-inner {
            display: inline-flex;
            border-radius: 999px;
            border: 1px solid rgba(78, 205, 196, 0.3);
            overflow: hidden;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
        }

        .lang-link {
            padding: 6px 14px;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .lang-link.active {
            background: linear-gradient(135deg, #4ecdc4, #44a3a0);
            color: #020617;
        }

        .lang-link:not(.active) {
            color: rgba(255, 255, 255, 0.6);
        }

        .lang-link:not(.active):hover {
            color: #4ecdc4;
            background: rgba(78, 205, 196, 0.1);
        }

        @media (max-width: 900px) {
            .auth-shell {
                grid-template-columns: minmax(0, 1fr);
            }

            .auth-hero {
                padding-bottom: 2.5rem;
                border-right: none;
                border-bottom: 1px solid rgba(78, 205, 196, 0.2);
            }

            .auth-form-side {
                padding-top: 2rem;
            }

            .auth-meta {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .auth-wrapper {
                padding-inline: 1rem;
            }

            .auth-shell {
                border-radius: 1.5rem;
            }

            .auth-hero {
                padding: 2rem 1.75rem;
            }

            .auth-form-side {
                padding: 1.75rem 1.5rem;
            }

            .auth-form-card {
                padding: 1.5rem 1.25rem;
            }

            .auth-title {
                font-size: 1.6rem;
            }

            .auth-logo-badge {
                width: 3rem;
                height: 3rem;
            }

            .auth-logo-inner {
                width: 2.4rem;
                height: 2.4rem;
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Major Cinema Data Center')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Prompt', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top left, #1f2937 0, #020617 45%, #020617 100%);
            color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 1000px;
            padding: 2rem 1.5rem;
        }

        .auth-shell {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
            gap: 0;
            border-radius: 2rem;
            overflow: hidden;
            background: radial-gradient(circle at top left, rgba(248, 250, 252, 0.05), rgba(15, 23, 42, 0.9));
            box-shadow:
                0 24px 80px rgba(15, 23, 42, 0.9),
                0 0 40px rgba(78, 205, 196, 0.1);
            border: 1px solid rgba(78, 205, 196, 0.15);
            backdrop-filter: blur(18px);
        }

        .auth-hero {
            position: relative;
            padding: 3rem;
            background:
                radial-gradient(circle at 0% 0%, rgba(78, 205, 196, 0.12), transparent 55%),
                radial-gradient(circle at 100% 100%, rgba(255, 211, 61, 0.08), transparent 55%),
                linear-gradient(145deg, #020617 0%, #0f172a 40%, #020617 100%);
            border-right: 1px solid rgba(78, 205, 196, 0.2);
            overflow: hidden;
        }

        .auth-hero-inner {
            position: relative;
            z-index: 1;
            display: flex;
            height: 100%;
            flex-direction: column;
            justify-content: space-between;
        }

        .auth-form-side {
            padding: 3rem 2.5rem;
            background: radial-gradient(circle at top, rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.98));
        }

        .auth-form-card {
            background: rgba(15, 23, 42, 0.98);
            border-radius: 1.5rem;
            border: 1px solid rgba(78, 205, 196, 0.15);
            padding: 2rem 1.75rem;
            box-shadow:
                0 18px 45px rgba(15, 23, 42, 0.9),
                0 0 0 1px rgba(78, 205, 196, 0.08);
            color: #e5e7eb;
        }

        @media (max-width: 900px) {
            .auth-shell {
                grid-template-columns: minmax(0, 1fr);
            }

            .auth-hero {
                padding-bottom: 2.5rem;
                border-right: none;
                border-bottom: 1px solid rgba(78, 205, 196, 0.2);
            }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-shell">
        <div class="auth-hero">
            <div class="auth-hero-inner">
                <div>
                    <a href="/" class="auth-logo">
                        <div class="auth-logo-badge">
                            <div class="auth-logo-inner">M</div>
                        </div>
                        <div class="auth-logo-text">
                            <span class="auth-logo-title">MAJOR CINEPLEX</span>
                            <span class="auth-logo-sub">Data Center Platform</span>
                        </div>
                    </a>

                    <h1 class="auth-title">
                        <?php echo e(__('guest.title_line_1')); ?><br>
                        <span><?php echo e(__('guest.title_line_2')); ?></span>
                        <?php echo e(__('guest.title_line_3')); ?>

                    </h1>

                    <p class="auth-subtitle">
                        <?php echo e(__('guest.subtitle')); ?>

                    </p>
                </div>

                <div>
                    <div class="auth-meta">
                        <div class="auth-meta-item">
                            <span class="auth-dot"></span>
                            <span><?php echo e(__('guest.feature_1')); ?></span>
                        </div>
                        <div class="auth-meta-item">
                            <span class="auth-dot"></span>
                            <span><?php echo e(__('guest.feature_2')); ?></span>
                        </div>
                    </div>

                    <p class="auth-footnote">
                        <?php echo e(__('guest.footnote')); ?>

                    </p>
                </div>
            </div>
        </div>

        <div class="auth-form-side">
            <div class="auth-form-card">
                <?php echo e($slot); ?>

            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/guest.blade.php ENDPATH**/ ?>