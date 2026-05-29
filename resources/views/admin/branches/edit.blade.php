@extends('layouts.app')

@section('title', 'แก้ไขสาขา – Major Cinema')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700&display=swap');

    * {
        font-family: 'Prompt', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        min-height: 100vh;
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

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #ff6b6b 0%, #ffd93d 50%, #4ecdc4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        position: relative;
        z-index: 1;
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

    .alert-success {
        background: linear-gradient(135deg, rgba(78, 205, 196, 0.2), rgba(78, 205, 196, 0.1));
        border: 1px solid rgba(78, 205, 196, 0.4);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        color: #4ecdc4;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success::before {
        content: '✅';
        font-size: 1.5rem;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s;
    }

    .form-card:hover {
        border-color: rgba(255, 195, 18, 0.3);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.15);
    }

    .form-label {
        color: #a8b2d1;
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control, .form-select {
        background: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        color: #fff !important;
        border-radius: 12px !important;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
        font-size: 0.95rem;
        width: 100%;
    }

    .form-control:focus, .form-select:focus {
        background: rgba(0, 0, 0, 0.4) !important;
        border-color: rgba(78, 205, 196, 0.5) !important;
        box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.1) !important;
        color: #fff !important;
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(168, 178, 209, 0.5);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-select option {
        background: #1a1a2e;
        color: #fff;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        flex-wrap: wrap;
        position: sticky;
        bottom: 20px;
        z-index: 100;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.3);
    }

    .btn-save {
        background: linear-gradient(135deg, #ff6b6b 0%, #ffd93d 100%);
        border: none;
        color: #1a1a2e;
        font-weight: 600;
        padding: 0.75rem 2.5rem;
        border-radius: 50px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        font-size: 1rem;
        cursor: pointer;
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #ffd93d 0%, #4ecdc4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 195, 18, 0.5);
        color: #1a1a2e;
    }

    .btn-cancel {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        font-weight: 500;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 107, 107, 0.4);
        color: #ff6b6b;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }

        .form-card {
            padding: 1.5rem;
        }

        .button-group {
            position: relative;
            bottom: auto;
        }
    }
</style>

<div class="container py-4">

    <a href="{{ route('admin.branches.index') }}" class="back-btn mb-3">
        ← Back to Branch List
    </a>

    <div class="page-header">
        <h1 class="page-title"> Edit Branch: {{ $branch->name }}</h1>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.branches.update', $branch) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-card">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label"> Branch Name</label>
                    <input type="text" 
                           name="name"
                           class="form-control"
                           value="{{ old('name', $branch->name) }}"
                           placeholder="e.g. Major Cineplex Sukhumvit"
                           required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label"> Address</label>
                    <textarea name="address"
                              class="form-control"
                              placeholder="Enter branch address">{{ old('address', $branch->address) }}</textarea>
                </div>

                {{-- Branch IP (existing) --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label"> Branch IP</label>
                    <input type="text" 
                           name="branch_ip"
                           class="form-control"
                           value="{{ old('branch_ip', $branch->branch_ip) }}"
                           placeholder="e.g. 10.131.2.247">
                </div>

                {{-- ✅ New: TMS IP --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        TMS IP 
                        <span class="badge"
                            style="background:#34d399; color:#022c22; font-weight:600;">
                            IP:PORT
                        </span>
                    </label>
                    <input type="text"
                           name="tms_ip"
                           class="form-control"
                           value="{{ old('tms_ip', $branch->tms_ip) }}"
                           placeholder="e.g. 10.131.10.240:9000">
                </div>

                {{-- ✅ New: TMS APP --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        TMS APP
                        <span class="badge" style="background:#34d399; color:#022c22; font-weight:600;">
                            IP
                        </span>
                    </label>
                    <input type="text"
                            name="tms_app_ip"
                            class="form-control"
                            value="{{ old('tms_app_ip', $branch->tms_app_ip ?? '') }}"
                            placeholder="e.g. 10.131.10.240">
                </div>

                {{-- Total Theatres (existing) --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label"> Total Theatres</label>
                    <input type="number" 
                           name="total_theatres"
                           class="form-control"
                           value="{{ old('total_theatres', $branch->total_theatres ?? 0) }}"
                           placeholder="e.g. 15"
                           min="0">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label"> Region</label>
                    <select name="region" class="form-select" required>
                        @foreach($regions as $reg)
                            <option value="{{ $reg }}"
                                {{ old('region', $branch->region) == $reg ? 'selected' : '' }}>
                                {{ $reg }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="btn-save">
                 Save Data
            </button>
            <a href="{{ route('admin.branches.index') }}" class="btn-cancel">
                Cancel
            </a>
        </div>

        <div style="height: 100px;"></div>

    </form>

</div>

@endsection