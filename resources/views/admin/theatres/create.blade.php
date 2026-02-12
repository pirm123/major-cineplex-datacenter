@extends('layouts.app')

@section('title', 'Add New Theatre – Major Cinema')

@section('content')
<div class="container py-4">
    <h1 class="text-light mb-3">Add New Theatre</h1>

    <form action="{{ route('admin.theatres.store') }}" method="POST"
          class="p-3 rounded-4"
          style="background:#020617;border:1px solid #1f2937;">
        @csrf
        @include('admin.theatres.partials.form', ['theatre' => null])
    </form>
</div>
@endsection