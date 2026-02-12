@extends('layouts.app')

@section('title', 'จัดการสาขา – Major Cineplex Data Center')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700&display=swap');

    * {
        font-family: 'Prompt', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #1a2845 0%, #0f1b2e 50%, #1a3050 100%);
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
            radial-gradient(circle at 20% 50%, rgba(255, 153, 0, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 193, 7, 0.06) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(255, 152, 0, 0.04) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 1600px;
    }

    .admin-header {
        background: linear-gradient(135deg, rgba(22, 35, 56, 0.95) 0%, rgba(15, 27, 46, 0.9) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 153, 0, 0.25);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.5),
            0 2px 10px rgba(255, 153, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .admin-header::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 5px;
        background: linear-gradient(180deg, #ff9900 0%, #ffaa00 100%);
        border-radius: 20px 0 0 20px;
        box-shadow: 0 0 25px rgba(255, 153, 0, 0.6);
    }

    .header-title-section {
        flex: 1;
    }

    .admin-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #ffaa00 0%, #ff9900 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        filter: drop-shadow(0 2px 10px rgba(255, 153, 0, 0.4));
    }

    .admin-subtitle {
        color: #b0bfd1;
        font-size: 0.95rem;
        font-weight: 300;
    }

    .btn-add-branch {
        background: linear-gradient(135deg, #ff9900 0%, #ffaa00 100%);
        border: none;
        color: #0f1b2e;
        font-weight: 700;
        padding: 0.9rem 2.2rem;
        border-radius: 50px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        box-shadow: 
            0 10px 30px rgba(255, 153, 0, 0.45),
            0 5px 15px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        white-space: nowrap;
    }

    .btn-add-branch:hover {
        background: linear-gradient(135deg, #ffaa00 0%, #ffbb00 100%);
        transform: translateY(-3px);
        box-shadow: 
            0 15px 40px rgba(255, 170, 0, 0.6),
            0 8px 20px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.5);
        color: #0f1b2e;
    }

    .search-container {
        background: linear-gradient(135deg, rgba(22, 35, 56, 0.95) 0%, rgba(15, 27, 46, 0.9) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 153, 0, 0.25);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.5),
            0 2px 10px rgba(255, 153, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .search-form {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .search-input {
        flex: 1;
        background: rgba(10, 18, 32, 0.85);
        border: 1px solid rgba(255, 153, 0, 0.3);
        border-radius: 50px;
        padding: 0.9rem 1.8rem;
        color: #ffffff;
        font-size: 0.95rem;
        transition: all 0.3s;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.4);
    }

    .search-input:focus {
        background: rgba(10, 18, 32, 0.95);
        border-color: rgba(255, 153, 0, 0.6);
        box-shadow: 
            0 0 0 3px rgba(255, 153, 0, 0.2),
            inset 0 2px 10px rgba(0, 0, 0, 0.4),
            0 5px 15px rgba(255, 153, 0, 0.25);
        outline: none;
        color: #ffffff;
    }

    .search-input::placeholder {
        color: #6b7688;
    }

    .btn-search {
        background: linear-gradient(135deg, #ff9900 0%, #ffaa00 100%);
        border: none;
        color: #0f1b2e;
        font-weight: 700;
        padding: 0.9rem 2.2rem;
        border-radius: 50px;
        transition: all 0.3s;
        font-size: 0.95rem;
        box-shadow: 
            0 10px 30px rgba(255, 153, 0, 0.45),
            0 5px 15px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        white-space: nowrap;
    }

    .btn-search:hover {
        transform: translateY(-3px);
        box-shadow: 
            0 15px 40px rgba(255, 170, 0, 0.6),
            0 8px 20px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.5);
        color: #0f1b2e;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(52, 211, 153, 0.2) 0%, rgba(16, 185, 129, 0.15) 100%);
        border: 1px solid rgba(52, 211, 153, 0.5);
        border-radius: 12px;
        color: #34d399;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
        box-shadow: 
            0 5px 20px rgba(52, 211, 153, 0.25),
            0 2px 10px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
    }

    .branch-card {
        background: linear-gradient(135deg, rgba(22, 35, 56, 0.95) 0%, rgba(15, 27, 46, 0.9) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 153, 0, 0.25);
        border-radius: 18px;
        padding: 1.8rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        overflow: hidden;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.5),
            0 2px 10px rgba(255, 153, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .branch-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 153, 0, 0.15), transparent);
        transition: left 0.5s;
    }

    .branch-card:hover::before {
        left: 100%;
    }

    .branch-card:hover {
        transform: translateY(-8px);
        box-shadow: 
            0 25px 70px rgba(0, 0, 0, 0.6),
            0 10px 30px rgba(255, 153, 0, 0.4),
            0 0 50px rgba(255, 170, 0, 0.25),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 153, 0, 0.6);
    }

    .branch-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.2rem;
        gap: 1rem;
    }

    .branch-info {
        flex: 1;
    }

    .branch-name {
        font-size: 1.4rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
        text-shadow: 0 2px 10px rgba(255, 255, 255, 0.15);
    }

    .branch-name::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #ff9900, #ffaa00);
        transition: width 0.3s;
        box-shadow: 0 0 10px rgba(255, 153, 0, 0.6);
    }

    .branch-card:hover .branch-name::after {
        width: 100%;
    }

    .branch-address {
        color: #a0aec0;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .badge-ip {
        background: linear-gradient(135deg, rgba(255, 153, 0, 0.3) 0%, rgba(255, 170, 0, 0.25) 100%);
        border: 1px solid rgba(255, 153, 0, 0.6);
        color: #ffaa00;
        padding: 0.45rem 1.1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: 
            0 5px 15px rgba(255, 153, 0, 0.35),
            0 2px 8px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
    }

    .branch-stats {
        display: flex;
        gap: 0.8rem;
        margin-bottom: 1.2rem;
        flex-wrap: wrap;
    }

    .stat-badge {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.25) 0%, rgba(14, 165, 233, 0.2) 100%);
        border: 1px solid rgba(56, 189, 248, 0.5);
        color: #38bdf8;
        padding: 0.45rem 1.1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        box-shadow: 
            0 5px 15px rgba(56, 189, 248, 0.25),
            0 2px 8px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
    }

    .stat-badge-id {
        background: linear-gradient(135deg, rgba(100, 116, 139, 0.3) 0%, rgba(71, 85, 105, 0.25) 100%);
        border: 1px solid rgba(148, 163, 184, 0.4);
        color: #cbd5e1;
        box-shadow: 
            0 5px 15px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }

    .branch-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.8rem;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 153, 0, 0.2);
    }

    .btn-edit {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.25) 0%, rgba(14, 165, 233, 0.2) 100%);
        border: 1px solid rgba(56, 189, 248, 0.5);
        color: #38bdf8;
        padding: 0.65rem 1.6rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        box-shadow: 
            0 5px 15px rgba(56, 189, 248, 0.25),
            0 2px 8px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.35) 0%, rgba(14, 165, 233, 0.3) 100%);
        border-color: rgba(56, 189, 248, 0.7);
        color: #7dd3fc;
        transform: translateY(-2px);
        box-shadow: 
            0 8px 25px rgba(56, 189, 248, 0.4),
            0 4px 12px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .btn-delete {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.25) 0%, rgba(220, 38, 38, 0.2) 100%);
        border: 1px solid rgba(239, 68, 68, 0.5);
        color: #ef4444;
        padding: 0.65rem 1.6rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 
            0 5px 15px rgba(239, 68, 68, 0.25),
            0 2px 8px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.35) 0%, rgba(220, 38, 38, 0.3) 100%);
        border-color: rgba(239, 68, 68, 0.7);
        transform: translateY(-2px);
        color: #f87171;
        box-shadow: 
            0 8px 25px rgba(239, 68, 68, 0.4),
            0 4px 12px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
    }

    .empty-state {
        background: linear-gradient(135deg, rgba(22, 35, 56, 0.95) 0%, rgba(15, 27, 46, 0.9) 100%);
        backdrop-filter: blur(20px);
        border: 1px dashed rgba(255, 153, 0, 0.35);
        border-radius: 18px;
        padding: 4rem 2rem;
        text-align: center;
        color: #a0aec0;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    @media (max-width: 768px) {
        .admin-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1.5rem;
        }

        .admin-title {
            font-size: 1.5rem;
        }

        .btn-add-branch {
            width: 100%;
            justify-content: center;
        }

        .search-form {
            flex-direction: column;
        }

        .btn-search {
            width: 100%;
        }

        .branch-header {
            flex-direction: column;
        }

        .badge-ip {
            align-self: flex-start;
        }

        .branch-actions {
            flex-direction: column;
        }

        .btn-edit,
        .btn-delete {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container py-4">

    {{-- Admin Header --}}
    <div class="admin-header">
        <div class="header-title-section">
            <h1 class="admin-title">
                Manage Major Cineplex Branches
            </h1>
            <div class="admin-subtitle">
                Add / Edit / Delete branches and total theatres
            </div>
        </div>

        <a href="{{ route('admin.branches.create') }}"
           class="btn-add-branch">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New Branch
        </a>
    </div>

    {{-- Search Section --}}
    <div class="search-container">
        <form method="GET"
              action="{{ route('admin.branches.index') }}"
              class="search-form">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="search-input"
                placeholder="Search branch name or branch IP, e.g. Bangkapi / 10.13"
            >
            <button type="submit" class="btn-search">
                Search
            </button>
        </form>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Branch List --}}
    <div class="row g-4">
        @forelse($branches as $branch)
            <div class="col-lg-6 col-md-6">
                <div class="branch-card">
                    <div class="branch-header">
                        <div class="branch-info">
                            <h2 class="branch-name">
                                {{ $branch->name }}
                            </h2>
                            <div class="branch-address">
                                {{ $branch->address }}
                            </div>
                        </div>
                        <div class="badge-ip">
                            IP: {{ $branch->branch_ip ?? '-' }}
                        </div>
                    </div>

                    <div class="branch-stats">
                        <span class="stat-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                                <polyline points="17 2 12 7 7 2"></polyline>
                            </svg>
                            Total Theatres: {{ $branch->total_theatres }}
                        </span>
                        <span class="stat-badge stat-badge-id">
                            ID: {{ $branch->id }}
                        </span>
                    </div>

                    <div class="branch-actions">
                        <a href="{{ route('admin.branches.edit', $branch) }}"
                           class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.branches.destroy', $branch) }}"
                              method="POST"
                              style="display: inline;"
                              onsubmit="return confirm('Delete this branch along with all theatres?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #4b5563;">
                            <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                            <polyline points="17 2 12 7 7 2"></polyline>
                        </svg>
                    </div>
                    <h3 style="color: #a0aec0; font-weight: 600; margin-bottom: 0.5rem;">
                        No branches found
                    </h3>
                    <p style="color: #6b7688; font-size: 0.9rem;">
                        Try searching with different keywords or add a new branch
                    </p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection