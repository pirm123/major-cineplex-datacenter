@extends('layouts.app')

@section('title', 'จัดการโรงทั้งหมด – Major Cinema')

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

    .btn-add-theatre {
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

    .btn-add-theatre:hover {
        background: linear-gradient(135deg, #ffaa00 0%, #ffbb00 100%);
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

    .filter-wrapper {
        background: linear-gradient(135deg, rgba(22, 35, 56, 0.95) 0%, rgba(15, 27, 46, 0.9) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 153, 0, 0.25);
        border-radius: 16px;
        padding: 1.8rem;
        margin-bottom: 2rem;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.5),
            0 2px 10px rgba(255, 153, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .filter-form {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1;
        min-width: 220px;
    }

    .filter-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #ffaa00;
    }

    .filter-icon {
        width: 1rem;
        height: 1rem;
        color: #ffaa00;
    }

    .filter-select,
    .filter-input {
        background: rgba(10, 18, 32, 0.85) !important;
        border: 1px solid rgba(255, 153, 0, 0.3) !important;
        color: #fff !important;
        border-radius: 50px !important;
        padding: 0.75rem 1.3rem;
        transition: all 0.3s;
        font-size: 0.9rem;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.4);
    }

    .filter-select:focus,
    .filter-input:focus {
        background: rgba(10, 18, 32, 0.95) !important;
        border-color: rgba(255, 153, 0, 0.6) !important;
        box-shadow: 
            0 0 0 3px rgba(255, 153, 0, 0.2),
            inset 0 2px 10px rgba(0, 0, 0, 0.4),
            0 5px 15px rgba(255, 153, 0, 0.25) !important;
        outline: none;
    }

    .filter-select:hover,
    .filter-input:hover {
        border-color: rgba(255, 153, 0, 0.45) !important;
    }

    .filter-input::placeholder {
        color: #6b7688;
    }

    .filter-select option {
        background: #162034;
        color: #fff;
        padding: 0.5rem;
    }

    .btn-search {
        background: linear-gradient(135deg, #ff9900 0%, #ffaa00 100%);
        border: none;
        color: #0f1b2e;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        transition: all 0.3s;
        font-size: 0.9rem;
        white-space: nowrap;
        box-shadow: 
            0 10px 30px rgba(255, 153, 0, 0.45),
            0 5px 15px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
    }

    .btn-search:hover {
        background: linear-gradient(135deg, #ffaa00 0%, #ffbb00 100%);
        transform: translateY(-2px);
        box-shadow: 
            0 15px 40px rgba(255, 170, 0, 0.6),
            0 8px 20px rgba(0, 0, 0, 0.4);
        color: #0f1b2e;
    }

    .btn-clear {
        background: rgba(100, 116, 139, 0.25);
        border: 1px solid rgba(148, 163, 184, 0.3);
        color: #cbd5e1;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
        white-space: nowrap;
        box-shadow: 
            0 5px 15px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.05);
    }

    .btn-clear:hover {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.25) 0%, rgba(220, 38, 38, 0.2) 100%);
        border-color: rgba(239, 68, 68, 0.5);
        color: #ef4444;
        transform: translateY(-2px);
        box-shadow: 
            0 8px 25px rgba(239, 68, 68, 0.3),
            0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .table-wrapper {
        background: linear-gradient(135deg, rgba(22, 35, 56, 0.95) 0%, rgba(15, 27, 46, 0.9) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 153, 0, 0.25);
        border-radius: 16px;
        padding: 0;
        overflow-x: auto;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.5),
            0 2px 10px rgba(255, 153, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .table {
        margin-bottom: 0;
        color: #fff;
        background: transparent;
        min-width: 1200px;
        width: 100%;
    }

    .table thead th {
        background: linear-gradient(135deg, rgba(255, 153, 0, 0.2) 0%, rgba(255, 170, 0, 0.15) 100%);
        border-bottom: 2px solid rgba(255, 153, 0, 0.5);
        color: #ffaa00;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1.2rem 1rem;
        white-space: nowrap;
        border: none;
    }

    .table thead th:nth-child(6),
    .table thead th:nth-child(7) {
        min-width: 180px;
        color: #ffaa00;
    }

    .table tbody tr {
        border-bottom: 1px solid rgba(255, 153, 0, 0.15);
        transition: all 0.3s;
        background: rgba(10, 18, 32, 0.4);
    }

    .table tbody tr:nth-child(even) {
        background: rgba(22, 35, 56, 0.5);
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, rgba(255, 153, 0, 0.15) 0%, rgba(255, 170, 0, 0.1) 100%) !important;
        box-shadow: 0 4px 12px rgba(255, 153, 0, 0.2);
    }

    .table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 500;
        border: none;
        white-space: nowrap;
    }

    .table tbody td:first-child {
        color: #2890ff;
        font-weight: 600;
        min-width: 220px;
    }

    .table tbody td:nth-child(2) {
        color: #fbbf24;
        font-weight: 600;
        text-align: center;
        min-width: 60px;
    }

    .table tbody td:nth-child(3),
    .table tbody td:nth-child(4) {
        color: #fbbf24;
        font-weight: 600;
        min-width: 80px;
    }

    .table tbody td:nth-child(5) {
        text-align: right;
        font-weight: 600;
        color: #34d399;
        min-width: 80px;
    }

    .table tbody td:nth-child(6),
    .table tbody td:nth-child(7) {
        min-width: 180px;
        max-width: 200px;
        color: #2890ff;
    }

    .table tbody td:nth-child(6):empty::before,
    .table tbody td:nth-child(7):empty::before {
        content: '-';
        color: #6b7280;
    }

    .table tbody td:nth-child(8) {
        font-family: 'Courier New', monospace;
        color: #4aabff;
        font-weight: 600;
        min-width: 120px;
    }

    .btn-edit {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.25) 0%, rgba(14, 165, 233, 0.2) 100%);
        border: 1px solid rgba(56, 189, 248, 0.5);
        color: #38bdf8;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        box-shadow: 
            0 4px 12px rgba(56, 189, 248, 0.2),
            0 2px 6px rgba(0, 0, 0, 0.3);
        margin-right: 0.5rem;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.35) 0%, rgba(14, 165, 233, 0.3) 100%);
        border-color: rgba(56, 189, 248, 0.7);
        color: #7dd3fc;
        transform: translateY(-2px);
        box-shadow: 
            0 6px 20px rgba(56, 189, 248, 0.35),
            0 3px 10px rgba(0, 0, 0, 0.3);
    }

    .btn-delete {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.25) 0%, rgba(220, 38, 38, 0.2) 100%);
        border: 1px solid rgba(239, 68, 68, 0.5);
        color: #ef4444;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 
            0 4px 12px rgba(239, 68, 68, 0.2),
            0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.35) 0%, rgba(220, 38, 38, 0.3) 100%);
        border-color: rgba(239, 68, 68, 0.7);
        color: #f87171;
        transform: translateY(-2px);
        box-shadow: 
            0 6px 20px rgba(239, 68, 68, 0.35),
            0 3px 10px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 992px) {
        .admin-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1.5rem;
        }

        .admin-title {
            font-size: 1.5rem;
        }

        .btn-add-theatre {
            width: 100%;
            justify-content: center;
        }

        .filter-group {
            min-width: 100%;
        }

        .btn-search,
        .btn-clear {
            width: 100%;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            font-size: 0.85rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }
    }
</style>

<div class="container py-4">

    {{-- Admin Header --}}
    <div class="admin-header">
        <div class="header-title-section">
            <h1 class="admin-title">
                Manage All Theatres
            </h1>
            <div class="admin-subtitle">
                Add / Edit theatre data, Server, Projector, IP, etc.
            </div>
        </div>

        <a href="{{ route('admin.theatres.create', request()->only(['branch_id','search'])) }}"
           class="btn-add-theatre">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New Theatre
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter Section --}}
    <div class="filter-wrapper">
        <form method="GET" action="{{ route('admin.theatres.index') }}" class="filter-form">

            {{-- Branch Dropdown --}}
            <div class="filter-group">
                <label for="branch_id" class="filter-label">
                    <svg class="filter-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Branch
                </label>
                <select name="branch_id" id="branch_id" class="filter-select">
                    <option value="">All Branches</option>
                    @foreach($branches as $b)
                        <option value="{{ $b->id }}" {{ request('branch_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Search Input --}}
            <div class="filter-group">
                <label for="search" class="filter-label">
                    <svg class="filter-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    Search
                </label>
                <input type="text"
                       name="search"
                       id="search"
                       value="{{ request('search') }}"
                       placeholder="Search theatre / Projector / Server / IP"
                       class="filter-input">
            </div>

            {{-- Search Button --}}
            <button type="submit" class="btn-search">
                Search
            </button>

            {{-- Clear Button --}}
            @if(request('branch_id') || request('search'))
                <a href="{{ route('admin.theatres.index') }}" class="btn-clear">
                    Clear
                </a>
            @endif

        </form>
    </div>

    {{-- Table Section --}}
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Theatre</th>
                        <th>Type</th>
                        <th>Special</th>
                        <th class="text-end">Seats</th>
                        <th>Projector</th>
                        <th>Server</th>
                        <th>IP</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($theatres as $theatre)
                    <tr>
                        <td>{{ $theatre->branch->name ?? '-' }}</td>
                        <td>{{ $theatre->theatre_number }}</td>
                        <td>{{ $theatre->Type_name ?? '-' }}</td>
                        <td>{{ $theatre->special_format ?? '-' }}</td>
                        <td class="text-end">{{ number_format($theatre->seat_count) }}</td>
                        <td>
                            @if($theatre->projector_make || $theatre->projector_model)
                                {{ $theatre->projector_make }} {{ $theatre->projector_model }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($theatre->server_make || $theatre->server_model)
                                {{ $theatre->server_make }} {{ $theatre->server_model }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $theatre->client_ip ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.theatres.edit', [
                                $theatre,
                                'branch_id' => request('branch_id'),
                                'search'    => request('search'),
                            ]) }}"
                               class="btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('admin.theatres.destroy', [
                                $theatre,
                                'branch_id' => request('branch_id'),
                                'search'    => request('search'),
                            ]) }}"
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Do you want to delete this theatre?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection