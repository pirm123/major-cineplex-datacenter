@extends('layouts.app')

@section('title', 'Edit Theatre – Major Cinema')

@section('content')
<div class="container py-4">

    <h1 class="text-light mb-3">
        Edit Theatre {{ $theatre->theatre_number }}
        ({{ $theatre->branch->name ?? '-' }})
    </h1>

    <form action="{{ route('admin.theatres.update', [
            $theatre,
            'branch_id' => request('branch_id'),
            'search'    => request('search'),
        ]) }}"
        method="POST"
        class="p-3 rounded-4"
        style="background:#020617;border:1px solid #1f2937;">

        @csrf
        @method('PUT')

        {{-- 🔑 Keep previous filters --}}
        <input type="hidden" name="branch_id" value="{{ request('branch_id') }}">
        <input type="hidden" name="search" value="{{ request('search') }}">

        @include('admin.theatres.partials.form', ['theatre' => $theatre])

        {{-- Bottom buttons --}}
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-success">
                Save Changes
            </button>

            <a href="{{ route('admin.theatres.index', request()->only(['branch_id','search'])) }}"
               class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection