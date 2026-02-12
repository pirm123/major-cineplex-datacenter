@extends('layouts.app')

@section('title', 'จัดการผู้ใช้')

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

    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.15) 100%);
        border: 1px solid rgba(239, 68, 68, 0.5);
        border-radius: 12px;
        color: #ef4444;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
        box-shadow: 
            0 5px 20px rgba(239, 68, 68, 0.25),
            0 2px 10px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
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
        transform: translateY(-2px);
        box-shadow: 
            0 15px 40px rgba(255, 170, 0, 0.6),
            0 8px 20px rgba(0, 0, 0, 0.4);
        color: #0f1b2e;
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
        width: 100%;
        table-layout: fixed;
    }

    .table thead th {
        background: linear-gradient(135deg, rgba(255, 153, 0, 0.2) 0%, rgba(255, 170, 0, 0.15) 100%);
        border-bottom: 2px solid rgba(255, 153, 0, 0.5);
        color: #ffaa00;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        padding: 1.2rem 1rem;
        white-space: nowrap;
        border: none;
        text-align: left;
    }

    .table thead th:nth-child(1) {
        width: 60px;
    }

    .table thead th:nth-child(2) {
        width: 180px;
    }

    .table thead th:nth-child(3) {
        width: 250px;
    }

    .table thead th:nth-child(4) {
        width: 150px;
    }

    .table thead th:nth-child(5) {
        width: 220px;
    }

    .table thead th:nth-child(6) {
        width: 120px;
    }

    .table tbody tr {
        border-bottom: 1px solid rgba(255, 153, 0, 0.15);
        transition: all 0.3s;
        background: #ffffff;
    }

    .table tbody tr:nth-child(even) {
        background: #f8f9fa;
    }

    .table tbody tr:hover {
        background: rgba(255, 153, 0, 0.08) !important;
        box-shadow: 0 4px 12px rgba(255, 153, 0, 0.2);
    }

    .table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        color: #1a1a1a;
        font-size: 0.95rem;
        font-weight: 600;
        border: none;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table tbody td:first-child {
        color: #ff9900;
        font-weight: 700;
        font-size: 1rem;
        text-align: center;
    }

    .table tbody td:nth-child(2) {
        color: #1a1a1a;
        font-weight: 700;
    }

    .table tbody td:nth-child(3) {
        color: #333333;
        font-weight: 600;
    }

    .badge-admin {
        background: linear-gradient(135deg, rgba(255, 153, 0, 0.3) 0%, rgba(255, 170, 0, 0.25) 100%);
        border: 1px solid #ff990099;
        color: #ffaa00;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-block;
        box-shadow: 
            0 4px 12px rgba(255, 153, 0, 0.3),
            0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .badge-user {
        background: linear-gradient(135deg, rgba(53, 198, 255, 0.3) 0%, rgba(72, 185, 255, 0.25) 100%);
        border: 1px solid #00d5ffa8;
        color: #0dbeff;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: 
            0 4px 12px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.05);
    }

    .role-form {
        display: flex;
        gap: 0.6rem;
        align-items: center;
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .role-select {
        background: rgba(10, 18, 32, 0.85);
        border: 1px solid rgba(255, 153, 0, 0.3);
        border-radius: 8px;
        padding: 0.45rem 0.8rem;
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
        min-width: 100px;
        flex-shrink: 0;
    }

    .btn-save {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.25) 0%, rgba(14, 165, 233, 0.2) 100%);
        border: 1px solid rgba(56, 189, 248, 0.5);
        color: #38bdf8;
        padding: 0.45rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 
            0 4px 12px rgba(56, 189, 248, 0.2),
            0 2px 6px rgba(0, 0, 0, 0.3);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-save:hover {
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
        padding: 0.45rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 
            0 4px 12px rgba(239, 68, 68, 0.2),
            0 2px 6px rgba(0, 0, 0, 0.3);
        white-space: nowrap;
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

    .btn-disabled {
        background: rgba(100, 116, 139, 0.2);
        border: 1px solid rgba(148, 163, 184, 0.3);
        color: #64748b;
        padding: 0.45rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: not-allowed;
        opacity: 0.5;
    }

    .role-form {
        display: flex;
        gap: 0.6rem;
        align-items: center;
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #69aaff;
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .admin-header {
            padding: 1.5rem;
        }

        .admin-title {
            font-size: 1.5rem;
        }

        .search-form {
            flex-direction: column;
        }

        .btn-search {
            width: 100%;
        }

        .table {
            font-size: 0.85rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }

        .role-form {
            flex-direction: column;
            gap: 0.5rem;
        }

        .role-select,
        .btn-save,
        .btn-delete {
            width: 100%;
        }
    }
</style>

<div class="container py-4">

    {{-- Admin Header --}}
    <div class="admin-header">
        <h1 class="admin-title">
            Manage System Users
        </h1>
        <div class="admin-subtitle">
            Add / Remove / Change user permissions
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('status'))
        <div class="alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Search Section --}}
    <div class="search-container">
        <form method="GET" action="{{ route('admin.users.index') }}" class="search-form">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="search-input"
                placeholder="Search by name or email ..."
            >
            <button type="submit" class="btn-search">
                Search
            </button>
        </form>
    </div>

    {{-- Table Section --}}
    <div class="table-wrapper">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Current Role</th>
                        <th>Manage Role</th>
                        <th>Delete User</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            {{-- Role Badge --}}
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge-admin">Admin</span>
                                @else
                                    <span class="badge-user">User</span>
                                @endif
                            </td>

                            {{-- Role Update Form --}}
                            <td>
                                <form action="{{ route('admin.users.updateRole', $user->id) }}"
                                      method="POST"
                                      class="role-form">

                                    @csrf
                                    @method('PATCH')

                                    <select name="role" class="role-select">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>

                                    <button type="submit" class="btn-save">
                                        Save
                                    </button>
                                </form>
                            </td>

                            {{-- Delete User Button --}}
                            <td>
                                @if(auth()->id() === $user->id)
                                    {{-- Prevent deleting yourself --}}
                                    <button class="btn-disabled" disabled>
                                        Cannot delete
                                    </button>
                                @else
                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-delete">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                No users found in the system
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection