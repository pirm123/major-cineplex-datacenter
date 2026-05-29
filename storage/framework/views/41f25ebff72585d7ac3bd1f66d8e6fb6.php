<?php $__env->startSection('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700;800&family=Kanit:wght@300;400;600;700&display=swap');

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
            radial-gradient(circle at 20% 50%, rgba(255, 107, 107, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(78, 205, 196, 0.12) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(255, 195, 18, 0.1) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
        animation: floating 30s ease-in-out infinite;
    }

    @keyframes floating {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 1; }
        25% { transform: translate(2%, -2%) scale(1.05); opacity: 0.9; }
        50% { transform: translate(-2%, 2%) scale(1); opacity: 1; }
        75% { transform: translate(2%, 2%) scale(1.05); opacity: 0.9; }
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 1600px;
    }

    /* ============= HERO SECTION ============= */
    .hero-section {
        text-align: center;
        padding: 3rem 0 2.5rem;
        position: relative;
    }

    .main-title {
        font-size: 4.5rem;
        font-weight: 800;
        font-family: 'Kanit', sans-serif;
        background: linear-gradient(135deg, #ff6b6b 0%, #ffd93d 50%, #4ecdc4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.8rem;
        animation: title-glow 3s ease-in-out infinite alternate;
        letter-spacing: -2px;
        filter: drop-shadow(0 0 30px rgba(255, 107, 107, 0.4));
    }

    @keyframes title-glow {
        from {
            filter: drop-shadow(0 0 20px rgba(255, 107, 107, 0.4)) brightness(1);
            transform: scale(1);
        }
        to {
            filter: drop-shadow(0 0 40px rgba(255, 195, 18, 0.6)) brightness(1.1);
            transform: scale(1.02);
        }
    }

    .subtitle {
        font-size: 1.4rem;
        color: #a8b2d1;
        font-weight: 400;
        letter-spacing: 1.5px;
        margin-bottom: 2.5rem;
        text-shadow: 0 2px 10px rgba(78, 205, 196, 0.3);
        animation: subtitle-float 4s ease-in-out infinite;
    }

    @keyframes subtitle-float {
        0%, 100% { transform: translateY(0); opacity: 0.9; }
        50% { transform: translateY(-5px); opacity: 1; }
    }

    /* ============= SEARCH BAR ============= */
    .home-search {
        max-width: 750px;
        margin: 0 auto 3rem;
        display: flex;
        gap: 0.8rem;
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.08), rgba(78, 205, 196, 0.06));
        padding: 0.6rem;
        border-radius: 60px;
        backdrop-filter: blur(25px);
        border: 2px solid rgba(255, 107, 107, 0.3);
        box-shadow: 0 10px 40px rgba(255, 107, 107, 0.2),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .home-search::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(135deg, #ff6b6b, #ffd93d, #4ecdc4, #ff6b6b);
        background-size: 300% 300%;
        border-radius: 60px;
        opacity: 0;
        z-index: -1;
        transition: opacity 0.4s;
        animation: gradient-shift 6s ease infinite;
    }

    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .home-search:hover {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.12), rgba(78, 205, 196, 0.09));
        border-color: rgba(255, 195, 18, 0.5);
        box-shadow: 0 15px 50px rgba(255, 107, 107, 0.3);
        transform: translateY(-2px);
    }

    .home-search:hover::before {
        opacity: 0.15;
    }

    .home-search-input {
        flex: 1;
        background: rgba(255, 255, 255, 0.08);
        border: 2px solid rgba(255, 255, 255, 0.1);
        padding: 1.1rem 2rem;
        border-radius: 50px;
        font-size: 1rem;
        color: #ffffff;
        outline: none;
        transition: all 0.3s;
        font-weight: 500;
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .home-search-input::placeholder {
        color: #a8b2d1;
        font-weight: 400;
        opacity: 0.7;
    }

    .home-search-input:focus {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 195, 18, 0.5);
        box-shadow: 0 0 0 3px rgba(255, 195, 18, 0.15),
                    inset 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .home-search-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: white;
        font-weight: 700;
        padding: 1rem 2.8rem;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 6px 25px rgba(255, 107, 107, 0.4);
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
    }

    .home-search-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .home-search-btn:hover::before {
        left: 100%;
    }

    .home-search-btn:hover {
        background: linear-gradient(135deg, #ff8787 0%, #ffd93d 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 35px rgba(255, 195, 18, 0.5);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .home-search-btn:active {
        transform: translateY(-1px);
        box-shadow: 0 5px 20px rgba(255, 107, 107, 0.4);
    }

    /* ============= CLEAR BUTTON ============= */
    .home-search-clear-btn {
        background: linear-gradient(135deg, rgba(168, 178, 209, 0.12), rgba(168, 178, 209, 0.08));
        border: 2px solid rgba(168, 178, 209, 0.25);
        color: #a8b2d1;
        font-weight: 700;
        padding: 1rem 2.2rem;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        letter-spacing: 0.8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .home-search-clear-btn::before {
        content: '✕';
        position: absolute;
        left: -30px;
        font-size: 1.2rem;
        transition: left 0.3s;
        opacity: 0;
    }

    .home-search-clear-btn:hover::before {
        left: 15px;
        opacity: 1;
    }

    .home-search-clear-btn:hover {
        background: linear-gradient(135deg, rgba(168, 178, 209, 0.2), rgba(168, 178, 209, 0.15));
        border-color: rgba(168, 178, 209, 0.4);
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(168, 178, 209, 0.2);
        padding-left: 3rem;
    }

    .home-search-clear-btn:active {
        transform: translateY(-1px) scale(0.98);
    }

    /* ============= STATS OVERVIEW ============= */
    .stats-overview {
        display: flex;
        justify-content: center;
        gap: 2.5rem;
        margin-top: 2.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .stat-box {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.1), rgba(78, 205, 196, 0.08));
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 195, 18, 0.3);
        padding: 2.5rem 3.5rem;
        border-radius: 25px;
        text-align: center;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 40px rgba(255, 107, 107, 0.2),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .stat-box::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(
            from 0deg,
            transparent 0deg,
            rgba(255, 195, 18, 0.15) 90deg,
            transparent 180deg
        );
        animation: rotate-gradient 6s linear infinite;
        opacity: 0;
        transition: opacity 0.5s;
    }

    @keyframes rotate-gradient {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .stat-box:hover::before {
        opacity: 1;
    }

    .stat-box:hover {
        transform: translateY(-15px) scale(1.08);
        border-color: rgba(255, 195, 18, 0.6);
        box-shadow: 0 20px 60px rgba(255, 107, 107, 0.4),
                    0 0 50px rgba(255, 195, 18, 0.3),
                    inset 0 1px 0 rgba(255, 255, 255, 0.2);
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.15), rgba(78, 205, 196, 0.12));
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        font-family: 'Kanit', sans-serif;
        background: linear-gradient(135deg, #ffd93d, #ff6b6b, #4ecdc4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
        filter: drop-shadow(0 2px 10px rgba(255, 195, 18, 0.4));
    }

    .stat-label {
        color: #a8b2d1;
        font-size: 1.1rem;
        font-weight: 600;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
        letter-spacing: 0.5px;
    }

    /* ============= REGION SECTION ============= */
    .region-section {
        margin-top: 2.5rem;
        margin-bottom: 2.5rem;
    }

    .region-header {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.08), rgba(78, 205, 196, 0.06));
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 195, 18, 0.25);
        border-radius: 20px;
        padding: 1.8rem 2.2rem;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 32px rgba(255, 107, 107, 0.15);
    }

    .region-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 195, 18, 0.1), transparent);
        transition: left 0.8s;
    }

    .region-header:hover::after {
        left: 100%;
    }

    .region-header:hover {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.12), rgba(78, 205, 196, 0.09));
        border-color: rgba(255, 195, 18, 0.5);
        box-shadow: 0 15px 50px rgba(255, 107, 107, 0.25),
                    0 0 40px rgba(255, 195, 18, 0.2);
        transform: translateX(8px);
    }

    .region-header::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 6px;
        background: linear-gradient(180deg, #ff6b6b 0%, #ffd93d 50%, #4ecdc4 100%);
        border-radius: 20px 0 0 20px;
        box-shadow: 0 0 25px rgba(255, 107, 107, 0.6);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0%, 100% { opacity: 1; box-shadow: 0 0 25px rgba(255, 107, 107, 0.4); }
        50% { opacity: 0.7; box-shadow: 0 0 40px rgba(255, 195, 18, 0.8); }
    }

    .region-icon {
        font-size: 2rem;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ff6b6b, #ffd93d);
        border-radius: 18px;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4),
                    inset 0 1px 0 rgba(255, 255, 255, 0.2);
        position: relative;
    }

    .region-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), transparent);
        opacity: 0;
        transition: opacity 0.5s;
    }

    .region-header:hover .region-icon::before {
        opacity: 1;
    }

    .region-icon svg {
        fill: white;
        width: 28px;
        height: 28px;
        filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.3));
    }

    .region-header:hover .region-icon {
        transform: scale(1.2) rotate(5deg);
        background: linear-gradient(135deg, #ffd93d, #4ecdc4);
        box-shadow: 0 12px 35px rgba(255, 195, 18, 0.6),
                    inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    .region-title {
        font-size: 2rem;
        font-weight: 700;
        font-family: 'Kanit', sans-serif;
        background: linear-gradient(135deg, #ffd93d, #ff6b6b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        text-shadow: 0 2px 15px rgba(255, 195, 18, 0.3);
        letter-spacing: -0.5px;
    }

    .region-count {
        margin-left: auto;
        margin-right: 0.5rem;
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.15), rgba(78, 205, 196, 0.1));
        border: 2px solid rgba(255, 195, 18, 0.3);
        padding: 0.6rem 1.8rem;
        border-radius: 50px;
        color: #ffd93d;
        font-weight: 700;
        font-size: 1rem;
        box-shadow: 0 5px 20px rgba(255, 107, 107, 0.2);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        transition: all 0.3s;
    }

    .region-header:hover .region-count {
        background: linear-gradient(135deg, rgba(255, 195, 18, 0.2), rgba(255, 107, 107, 0.15));
        border-color: rgba(255, 195, 18, 0.5);
        box-shadow: 0 8px 30px rgba(255, 195, 18, 0.3);
    }

    .region-arrow {
        font-size: 1.6rem;
        color: #ffd93d;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        text-shadow: 0 0 15px rgba(255, 195, 18, 0.4);
    }

    .region-header:hover .region-arrow {
        color: #4ecdc4;
        text-shadow: 0 0 20px rgba(78, 205, 196, 0.6);
    }

    .region-arrow.open {
        transform: rotate(90deg);
    }

    .region-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), 
                    opacity 0.4s ease,
                    padding 0.4s ease;
        opacity: 0;
        padding-top: 0;
    }

    .region-content.open {
        max-height: 10000px;
        opacity: 1;
        padding-top: 2rem;
    }

    /* ============= BRANCH CARD ============= */
    .branch-card {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.06), rgba(78, 205, 196, 0.04));
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 195, 18, 0.2);
        border-radius: 25px;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 12px 45px rgba(255, 107, 107, 0.15);
    }

    .branch-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 195, 18, 0.1), transparent);
        transition: left 0.7s;
    }

    .branch-card:hover::before {
        left: 100%;
    }

    .branch-card::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 25px;
        padding: 2px;
        background: linear-gradient(135deg, #ff6b6b, #ffd93d, #4ecdc4);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.5s;
    }

    .branch-card:hover::after {
        opacity: 0.4;
    }

    .branch-card:hover {
        transform: translateY(-15px) scale(1.04);
        box-shadow: 0 25px 70px rgba(255, 107, 107, 0.3),
                    0 0 60px rgba(255, 195, 18, 0.2);
        border-color: rgba(255, 195, 18, 0.5);
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.1), rgba(78, 205, 196, 0.08));
    }

    .card-body {
        padding: 2.2rem;
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        min-height: 420px;
    }

    .theatre-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, rgba(78, 205, 196, 0.2), rgba(78, 205, 196, 0.15));
        border: 2px solid rgba(78, 205, 196, 0.4);
        padding: 0.5rem 1.4rem;
        border-radius: 50px;
        font-size: 0.9rem;
        color: #4ecdc4;
        font-weight: 700;
        box-shadow: 0 6px 25px rgba(78, 205, 196, 0.3);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        animation: badge-glow 2s ease-in-out infinite;
    }

    @keyframes badge-glow {
        0%, 100% { box-shadow: 0 6px 25px rgba(78, 205, 196, 0.2); }
        50% { box-shadow: 0 8px 35px rgba(78, 205, 196, 0.5); }
    }

    .cinema-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #4ecdc4, #44a3a0);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.3rem;
        font-size: 2rem;
        box-shadow: 0 10px 30px rgba(78, 205, 196, 0.4),
                    inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .cinema-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), transparent);
        opacity: 0;
        transition: opacity 0.5s;
    }

    .branch-card:hover .cinema-icon::before {
        opacity: 1;
    }

    .branch-card:hover .cinema-icon {
        transform: scale(1.15) rotate(-8deg);
        background: linear-gradient(135deg, #4ecdc4, #ffd93d);
        box-shadow: 0 15px 45px rgba(78, 205, 196, 0.6),
                    inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    .cinema-icon svg {
        fill: white;
        width: 38px;
        height: 38px;
        filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.3));
    }

    .card-title {
        font-size: 1.6rem;
        font-weight: 700;
        font-family: 'Kanit', sans-serif;
        color: #ffffff;
        margin-bottom: 1.2rem;
        position: relative;
        display: inline-block;
        text-shadow: 0 2px 10px rgba(255, 195, 18, 0.2);
        min-height: 40px;
        letter-spacing: -0.5px;
    }

    .card-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #ff6b6b, #ffd93d, #4ecdc4);
        border-radius: 5px;
        transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 15px rgba(255, 195, 18, 0.4);
    }

    .branch-card:hover .card-title::after {
        width: 100%;
    }

    .theatre-info {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.1), rgba(255, 195, 18, 0.08));
        border: 2px solid rgba(255, 195, 18, 0.25);
        padding: 0.9rem 1.3rem;
        border-radius: 18px;
        margin-bottom: 1.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.7rem;
        box-shadow: 0 5px 20px rgba(255, 107, 107, 0.1);
        transition: all 0.3s;
    }

    .branch-card:hover .theatre-info {
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.15), rgba(255, 195, 18, 0.12));
        border-color: rgba(255, 195, 18, 0.4);
        box-shadow: 0 8px 30px rgba(255, 195, 18, 0.2);
    }

    .theatre-info-text {
        color: #a8b2d1;
        font-size: 1rem;
        font-weight: 600;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .theatre-info-number {
        font-size: 2rem;
        font-weight: 800;
        font-family: 'Kanit', sans-serif;
        background: linear-gradient(135deg, #ffd93d, #ff6b6b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0.3rem;
        filter: drop-shadow(0 2px 8px rgba(255, 195, 18, 0.3));
    }

    .address-text {
        color: #a8b2d1;
        font-size: 0.95rem;
        line-height: 1.8;
        margin-bottom: 1.5rem;
        height: 85px;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        overflow: hidden;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .view-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
        border: 2px solid rgba(255, 255, 255, 0.15);
        color: #ffffff;
        font-weight: 700;
        padding: 1.1rem 2.5rem;
        border-radius: 50px;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        letter-spacing: 1px;
        font-size: 1rem;
        box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);
        width: 100%;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-top: auto;
        position: relative;
        overflow: hidden;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .view-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s;
    }

    .view-btn:hover::before {
        left: 100%;
    }

    .view-btn:hover {
        background: linear-gradient(135deg, #ff8787 0%, #ffd93d 100%);
        transform: translateY(-4px);
        box-shadow: 0 15px 50px rgba(255, 195, 18, 0.5);
        color: #1a1a2e;
        border-color: rgba(255, 255, 255, 0.3);
    }

    .view-btn:active {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(255, 107, 107, 0.4);
    }

    /* ============= RESPONSIVE ============= */
    @media (max-width: 768px) {
        .main-title {
            font-size: 2.8rem;
        }

        .subtitle {
            font-size: 1.1rem;
        }

        .region-title {
            font-size: 1.4rem;
        }

        .stats-overview {
            gap: 1.5rem;
        }

        .stat-box {
            padding: 1.5rem 2rem;
        }

        .stat-number {
            font-size: 2.5rem;
        }

        .region-count {
            padding: 0.4rem 1rem;
            font-size: 0.85rem;
        }

        .region-header {
            padding: 1.2rem 1.5rem;
        }

        .address-text {
            height: auto;
            min-height: 60px;
        }

        .home-search {
            flex-direction: column;
            gap: 0.6rem;
            padding: 0.8rem;
        }

        .home-search-btn {
            padding: 1rem 2rem;
            width: 100%;
        }

        .home-search-clear-btn {
            padding: 1rem 2rem;
            width: 100%;
        }

        .home-search-clear-btn:hover {
            padding-left: 2rem;
        }

        .home-search-clear-btn::before {
            content: '✕ ';
            position: static;
            opacity: 1;
            margin-right: 0.5rem;
        }
    }
</style>

<div class="container py-4">

    
    <div class="hero-section">
        <h1 class="main-title">Major Cineplex</h1>

        <p class="subtitle">
            <?php echo e(__('home.hero_subtitle')); ?>

        </p>

        <div class="stats-overview">
            <div class="stat-box">
                <div class="stat-number">
                    <?php echo e($branchCount ?? $branches->count()); ?>

                </div>
                <div class="stat-label">
                    <?php echo e(__('home.total_branches')); ?>

                </div>
            </div>

            <div class="stat-box">
                <div class="stat-number">
                    <?php echo e($theatreCount ?? $branches->sum('theatres_count')); ?>

                </div>
                <div class="stat-label">
                    <?php echo e(__('home.total_theatres')); ?>

                </div>
            </div>
        </div>
    </div>
    
    
    <form method="GET" action="<?php echo e(route('home')); ?>" class="home-search">
        <input 
            type="text" 
            name="q" 
            value="<?php echo e(request('q')); ?>"
            placeholder=" Search branch Ratchayothin / Bangkapi"
            class="home-search-input"
        >
        <button type="submit" class="home-search-btn">
            Search
        </button>
        <?php if(request('q')): ?>
            <a href="<?php echo e(route('home')); ?>" class="home-search-clear-btn">
                Clear
            </a>
        <?php endif; ?>
    </form>

    
    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php
            $regionMap = [
                'กรุงเทพมหานคร' => 'region_bkk',
                'กรุงเทพฯ' => 'region_bkk',
                'ภาคกลาง' => 'region_central',
                'ภาคเหนือ' => 'region_north',
                'ภาคตะวันออก' => 'region_east',
                'ภาคตะวันตก' => 'region_west',
                'ภาคใต้' => 'region_south',
                'ภาคตะวันออกเฉียงเหนือ' => 'region_northeast',
            ];

            $regionKeyName = $regionMap[$region] ?? null;
            $regionKey = 'region-' . $loop->index;
        ?>

        <div class="region-section">

            
            <div class="region-header" onclick="toggleRegion('<?php echo e($regionKey); ?>')">

                <span class="region-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0z"/>
                    </svg>
                </span>

                <h2 class="region-title">
                    <?php echo e(__('home.regions.' . $region)); ?>

                </h2>

                <span class="region-count">
                    <?php echo e($items->count()); ?> <?php echo e(__('home.branches_count')); ?>

                </span>

                <span class="region-arrow" id="arrow-<?php echo e($regionKey); ?>">▸</span>
            </div>

            
            <div class="region-content" id="region-<?php echo e($regionKey); ?>">
                <div class="row g-4">

                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="branch-card">

                                <div class="theatre-badge">
                                    <?php echo e($branch->theatres_count); ?> <?php echo e(__('home.theatres_suffix')); ?>

                                </div>

                                <div class="card-body">

                                    <div class="cinema-icon">
                                        <svg viewBox="0 0 80 80">
                                            <rect x="15" y="20" width="10" height="40"/>
                                            <rect x="35" y="20" width="10" height="40"/>
                                            <rect x="55" y="20" width="10" height="40"/>
                                            <path d="M12,15 L68,15 L68,22 L12,22 Z"/>
                                        </svg>
                                    </div>

                                    <h4 class="card-title">
                                        <?php echo e($branch->name); ?>

                                    </h4>

                                    <div class="theatre-info">
                                        <span class="theatre-info-text">
                                            <?php echo e(__('home.total_theatres')); ?>

                                        </span>
                                        <span class="theatre-info-number">
                                            <?php echo e($branch->theatres_count); ?>

                                        </span>
                                        <span class="theatre-info-text">
                                            <?php echo e(__('home.theatres_suffix')); ?>

                                        </span>
                                    </div>

                                    <p class="address-text">
                                        📍 <?php echo e($branch->address ?? __('home.no_address')); ?>

                                    </p>

                                    <a href="<?php echo e(route('branches.theatres.index', $branch->id)); ?>"
                                       class="view-btn">
                                        <?php echo e(__('home.view_theatres')); ?> →
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12 text-center text-muted">
                            <?php echo e(__('home.no_data')); ?>

                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<script>
function toggleRegion(key) {

    const content = document.getElementById('region-' + key);
    const arrow = document.getElementById('arrow-' + key);
    const isOpen = content.classList.contains('open');

    // 🔒 ปิดทุกภาคก่อน
    document.querySelectorAll('.region-content.open').forEach(el => {
        el.classList.remove('open');
    });

    document.querySelectorAll('.region-arrow.open').forEach(el => {
        el.classList.remove('open');
    });

    // 🔓 ถ้าภาคที่กด "ยังไม่เปิด" → เปิดมัน
    if (!isOpen) {
        content.classList.add('open');
        arrow.classList.add('open');
    }
}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/home.blade.php ENDPATH**/ ?>