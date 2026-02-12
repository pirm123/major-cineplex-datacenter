<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700&display=swap');

    * {
        font-family: 'Prompt', sans-serif;
    }

    .form-section {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s;
    }

    .form-section:hover {
        border-color: rgba(78, 205, 196, 0.3);
        box-shadow: 0 8px 25px rgba(78, 205, 196, 0.15);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: #4ecdc4;
        margin-bottom: 1.2rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid rgba(78, 205, 196, 0.3);
    }

    .section-icon {
        width: 1.5rem;
        height: 1.5rem;
        color: #4ecdc4;
        stroke-width: 2;
    }

    .form-label {
        color: #a8b2d1 !important;
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        background: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        color: #fff !important;
        border-radius: 12px !important;
        padding: 0.65rem 1rem;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        background: rgba(0, 0, 0, 0.4) !important;
        border-color: rgba(78, 205, 196, 0.5) !important;
        box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.1) !important;
        color: #fff !important;
    }

    .form-control::placeholder {
        color: rgba(168, 178, 209, 0.5);
    }

    .form-select option {
        background: #1a1a2e;
        color: #fff;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.1));
        border: 1px solid rgba(239, 68, 68, 0.4);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        color: #ff6b6b;
        margin-bottom: 1.5rem;
    }

    .alert-danger ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .alert-danger li {
        padding: 0.3rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .alert-danger li::before {
        content: '•';
        font-size: 1.5rem;
        color: #ef4444;
    }

    .btn-save {
        background: linear-gradient(135deg, #4ecdc4 0%, #44a3a0 100%);
        border: none;
        color: #1a1a2e;
        font-weight: 600;
        padding: 0.75rem 2.5rem;
        border-radius: 50px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(78, 205, 196, 0.4);
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #44a3a0 0%, #ffd93d 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(78, 205, 196, 0.5);
        color: #1a1a2e;
    }

    .btn-icon {
        width: 1.125rem;
        height: 1.125rem;
        stroke-width: 2.5;
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
        gap: 0.5rem;
    }

    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(239, 68, 68, 0.4);
        color: #ef4444;
        transform: translateY(-2px);
    }

    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
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
</style>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Basic Information --}}
<div class="form-section">
    <div class="section-header">
        <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            <path d="M9 12h6m-6 4h6"/>
        </svg>
        <span>Basic Information</span>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Branch</label>
            <select name="branch_id" class="form-select" required>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}"
                        {{ old('branch_id', $theatre->branch_id ?? '') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Theatre No.</label>
            <input type="number" name="theatre_number"
                   class="form-control"
                   value="{{ old('theatre_number', $theatre->theatre_number ?? '') }}" 
                   placeholder="e.g. 1, 2, 3"
                   >
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Seat Capacity</label>
            <input type="number" name="seat_count"
                   class="form-control"
                   value="{{ old('seat_count', $theatre->seat_count ?? 0) }}"
                   placeholder="e.g. 150">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Type (Laser / IMAX, etc.)</label>
            <input type="text" name="Type_name"
                   class="form-control"
                   value="{{ old('Type_name', $theatre->Type_name ?? '') }}"
                   placeholder="e.g. Laser, Digital">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Special Format (Kids, ATMOS, etc.)</label>
            <input type="text" name="special_format"
                   class="form-control"
                   value="{{ old('special_format', $theatre->special_format ?? '') }}"
                   placeholder="e.g. Dolby Atmos, IMAX">
        </div>
    </div>
</div>

{{-- Projector --}}
<div class="form-section">
    <div class="section-header">
        <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <rect x="2" y="7" width="20" height="15" rx="2" ry="2"/>
            <polyline points="17 2 12 7 7 2"/>
        </svg>
        <span>Projector</span>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <label class="form-label">Projector Make (Brand)</label>
            <input type="text" name="projector_make"
                   class="form-control"
                   value="{{ old('projector_make', $theatre->projector_make ?? '') }}"
                   placeholder="e.g. Barco, Christie">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Projector Model</label>
            <input type="text" name="projector_model"
                   class="form-control"
                   value="{{ old('projector_model', $theatre->projector_model ?? '') }}"
                   placeholder="e.g. CP4220, S4">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Projector Serial</label>
            <input type="text" name="projector_serial"
                   class="form-control"
                   value="{{ old('projector_serial', $theatre->projector_serial ?? '') }}"
                   placeholder="e.g. ABC123456">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Projector IP</label>
            <input type="text" name="projector_ip"
                   class="form-control"
                   value="{{ old('projector_ip', $theatre->projector_ip ?? '') }}"
                   placeholder="e.g. 192.168.1.100">
        </div>
    </div>
</div>

{{-- Server (Media Block) --}}
<div class="form-section">
    <div class="section-header">
        <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
            <line x1="6" y1="6" x2="6.01" y2="6"/>
            <line x1="6" y1="18" x2="6.01" y2="18"/>
        </svg>
        <span>Server (Media Block)</span>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <label class="form-label">Server Make (Brand)</label>
            <input type="text" name="server_make"
                   class="form-control"
                   value="{{ old('server_make', $theatre->server_make ?? '') }}"
                   placeholder="e.g. Dolby, GDC">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Server Model</label>
            <input type="text" name="server_model"
                   class="form-control"
                   value="{{ old('server_model', $theatre->server_model ?? '') }}"
                   placeholder="e.g. IMS3000, SR-1000">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Server Serial</label>
            <input type="text" name="server_serial"
                   class="form-control"
                   value="{{ old('server_serial', $theatre->server_serial ?? '') }}"
                   placeholder="e.g. SN987654">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Server IP</label>
            <input type="text" name="client_ip"
                   class="form-control"
                   value="{{ old('client_ip', $theatre->client_ip ?? '') }}"
                   placeholder="e.g. 192.168.1.50">
        </div>
    </div>
</div>

{{-- Sound System --}}
<div class="form-section">
    <div class="section-header">
        <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
            <path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
        </svg>
        <span>Sound System</span>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <label class="form-label">Sound Make (Brand)</label>
            <input type="text" name="sound_make"
                   class="form-control"
                   value="{{ old('sound_make', $theatre->sound_make ?? '') }}"
                   placeholder="e.g. Dolby, QSC">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Sound Model</label>
            <input type="text" name="sound_model"
                   class="form-control"
                   value="{{ old('sound_model', $theatre->sound_model ?? '') }}"
                   placeholder="e.g. CP850, CP950">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Sound IP</label>
            <input type="text" name="sound_ip"
                   class="form-control"
                   value="{{ old('sound_ip', $theatre->sound_ip ?? '') }}"
                   placeholder="e.g. 192.168.1.75">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label">Sound Port</label>
            <input type="text" name="sound_port"
                   class="form-control"
                   value="{{ old('sound_port', $theatre->sound_port ?? '') }}"
                   placeholder="e.g. 61408">
        </div>
    </div>
</div>

{{-- Installation Dates --}}
<div class="form-section">
    <div class="section-header">
        <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        <span>Installation Dates</span>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Initial Installation</label>
            <input type="date" name="initial_installation"
                   class="form-control"
                   value="{{ old('initial_installation', $theatre->initial_installation ?? '') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Latest Screen Replacement</label>
            <input type="date" name="new_screen_installed_at"
                   class="form-control"
                   value="{{ old('new_screen_installed_at', $theatre->new_screen_installed_at ?? '') }}">
        </div>
    </div>
</div>

{{-- Action Buttons --}}
<div class="button-group">
    <button type="submit" class="btn-save">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
            <polyline points="17 21 17 13 7 13 7 21"/>
            <polyline points="7 3 7 8 15 8"/>
        </svg>
        Save Data
    </button>
    <a href="{{ route('admin.theatres.index') }}" class="btn-cancel">
        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
        Cancel
    </a>
</div>

{{-- Bottom spacing for sticky buttons --}}
<div style="height: 100px;"></div>