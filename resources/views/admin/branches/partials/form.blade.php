@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label text-light">{{ __('admin.branch_name') }}</label>
    <input type="text" name="name" class="form-control bg-dark text-light border-secondary"
           value="{{ old('name', $branch->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label text-light">{{ __('admin.address') }}</label>
    <textarea name="address" rows="2" class="form-control bg-dark text-light border-secondary" required>{{ old('address', $branch->address ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label text-light">{{ __('admin.branch_ip') }}</label>
    <input type="text" name="branch_ip" class="form-control bg-dark text-light border-secondary"
           value="{{ old('branch_ip', $branch->branch_ip ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label text-light">{{ __('admin.total_theatres') }}</label>
    <input type="number" name="total_theatres" class="form-control bg-dark text-light border-secondary"
           value="{{ old('total_theatres', $branch->total_theatres ?? 0) }}" min="0">
</div>
