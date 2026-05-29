

<?php $__env->startSection('title', 'Import / Export Excel'); ?>

<?php $__env->startSection('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600;700&display=swap');

    * { font-family: 'Prompt', sans-serif; }

    body {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        min-height: 100vh;
    }

    /* ── Page Header ─────────────────────────────── */
    .page-header {
        background: rgba(255,255,255,0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at 20% 50%, rgba(255,195,18,0.08) 0%, transparent 60%);
        pointer-events: none;
    }
    .page-title {
        font-size: 2rem; font-weight: 700;
        background: linear-gradient(135deg, #ff6b6b 0%, #ffd93d 50%, #4ecdc4 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        margin: 0;
    }
    .page-subtitle {
        color: rgba(168,178,209,0.7); font-size: 0.9rem; margin-top: 0.35rem;
    }

    /* ── Grid ────────────────────────────────────── */
    .excel-grid {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 1.5rem; margin-bottom: 1.5rem;
    }
    @media (max-width: 768px) {
        .excel-grid { grid-template-columns: 1fr; }
        .page-title { font-size: 1.5rem; }
    }

    /* ── Cards ───────────────────────────────────── */
    .action-card {
        border-radius: 24px; padding: 2rem;
        position: relative; overflow: hidden;
        transition: all 0.35s ease;
    }

    /* EXPORT – cyan tint */
    .export-card {
        background: rgba(255,255,255,0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(78,205,196,0.2);
    }
    .export-card::before {
        content: '';
        position: absolute; top: -60px; right: -60px;
        width: 220px; height: 220px;
        background: radial-gradient(circle, rgba(78,205,196,0.14) 0%, transparent 70%);
        pointer-events: none;
    }
    .export-card:hover {
        border-color: rgba(78,205,196,0.45);
        box-shadow: 0 8px 32px rgba(78,205,196,0.12);
    }

    /* IMPORT – warm rose/purple */
    .import-card {
        background: rgba(255,255,255,0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,107,107,0.25);
    }
    .import-card::before {
        content: '';
        position: absolute; top: -60px; right: -60px;
        width: 240px; height: 240px;
        background: radial-gradient(circle, rgba(255,107,107,0.16) 0%, rgba(200,80,200,0.08) 50%, transparent 70%);
        pointer-events: none;
    }
    .import-card::after {
        content: '';
        position: absolute; bottom: -40px; left: -40px;
        width: 160px; height: 160px;
        background: radial-gradient(circle, rgba(255,200,50,0.07) 0%, transparent 70%);
        pointer-events: none;
    }
    .import-card:hover {
        border-color: rgba(255,107,107,0.5);
        box-shadow: 0 8px 32px rgba(255,107,107,0.15);
    }

    /* ── Icon ────────────────────────────────────── */
    .card-icon-wrap {
        width: 60px; height: 60px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.4rem; position: relative; z-index: 1;
    }
    .export-card .card-icon-wrap {
        background: rgba(78,205,196,0.12);
        border: 1px solid rgba(78,205,196,0.3);
        box-shadow: 0 0 18px rgba(78,205,196,0.15);
    }
    .import-card .card-icon-wrap {
        background: rgba(255,107,107,0.12);
        border: 1px solid rgba(255,107,107,0.3);
        box-shadow: 0 0 18px rgba(255,107,107,0.15);
    }
    .card-icon-wrap svg { width: 28px; height: 28px; }

    /* ── Text ────────────────────────────────────── */
    .card-title {
        font-size: 1.3rem; font-weight: 700;
        margin-bottom: 0.4rem; position: relative; z-index: 1;
    }
    .export-card .card-title { color: #4ecdc4; }
    .import-card .card-title {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff85d0 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .card-desc {
        font-size: 0.88rem; line-height: 1.7;
        margin-bottom: 1.75rem; position: relative; z-index: 1;
    }
    .export-card .card-desc { color: rgba(168,210,209,0.65); }
    .import-card .card-desc { color: rgba(210,168,180,0.65); }

    .card-divider {
        height: 1px; margin-bottom: 1.75rem; position: relative; z-index: 1;
    }
    .export-card .card-divider { background: linear-gradient(90deg, transparent, rgba(78,205,196,0.25), transparent); }
    .import-card .card-divider { background: linear-gradient(90deg, transparent, rgba(255,107,107,0.25), transparent); }

    /* ── Buttons ─────────────────────────────────── */
    .btn-export, .btn-import {
        display: inline-flex; align-items: center; justify-content: center; gap: 0.65rem;
        width: 100%; padding: 0.85rem 1.5rem;
        border-radius: 50px; font-weight: 600; font-size: 0.95rem;
        cursor: pointer; transition: all 0.3s; border: none;
        text-decoration: none; position: relative; z-index: 1;
        overflow: hidden;
    }

    .btn-export {
        background: linear-gradient(135deg, #4ecdc4 0%, #38b2ac 100%);
        color: #0f2027;
        box-shadow: 0 4px 20px rgba(78,205,196,0.35);
    }
    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(78,205,196,0.5);
        color: #0f2027;
    }

    .btn-import {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee82c0 50%, #c084fc 100%);
        color: #fff;
        box-shadow: 0 4px 20px rgba(255,107,107,0.35);
    }
    .btn-import:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(255,107,107,0.5);
        color: #fff;
        background: linear-gradient(135deg, #ff8fab 0%, #f472c0 50%, #a855f7 100%);
    }
    .btn-import:disabled {
        opacity: 0.35; cursor: not-allowed; transform: none; box-shadow: none;
    }
    .btn-export:active, .btn-import:active { transform: translateY(0); }

    /* ── Upload Zone ─────────────────────────────── */
    .upload-zone {
        border: 2px dashed rgba(255,107,107,0.3);
        border-radius: 16px; padding: 1.75rem 1rem;
        text-align: center; cursor: pointer; transition: all 0.3s;
        position: relative; margin-bottom: 1.25rem;
        background: rgba(255,107,107,0.03); z-index: 1;
    }
    .upload-zone:hover, .upload-zone.drag-over {
        border-color: rgba(200,80,200,0.55);
        background: rgba(200,80,200,0.06);
        box-shadow: 0 0 20px rgba(255,107,107,0.1);
    }
    .upload-zone input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .upload-icon {
        width: 38px; height: 38px; margin: 0 auto 0.7rem;
        color: rgba(255,107,107,0.45); transition: all 0.3s;
    }
    .upload-zone:hover .upload-icon { color: #ee82c0; transform: translateY(-4px); }
    .upload-text { color: rgba(210,168,180,0.65); font-size: 0.87rem; line-height: 1.6; }
    .upload-text strong { color: #ff8fab; }

    /* ── File Selected ───────────────────────────── */
    .file-selected {
        display: none; align-items: center; gap: 0.75rem;
        background: rgba(255,107,107,0.07);
        border: 1px solid rgba(255,107,107,0.2);
        border-radius: 12px; padding: 0.75rem 1rem;
        margin-bottom: 1.25rem; position: relative; z-index: 1;
    }
    .file-selected .file-name {
        color: #ff8fab; font-size: 0.9rem; font-weight: 500;
        flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }

    /* ── Info Note ───────────────────────────────── */
    .info-note {
        border-radius: 14px; padding: 1rem 1.25rem;
        font-size: 0.83rem; line-height: 1.7;
        margin-top: 1.25rem; position: relative; z-index: 1;
    }
    .export-card .info-note {
        background: rgba(78,205,196,0.06);
        border: 1px solid rgba(78,205,196,0.18);
        color: rgba(100,210,205,0.7);
    }
    .export-card .info-note strong { color: #4ecdc4; }
    .import-card .info-note {
        background: rgba(255,107,107,0.06);
        border: 1px solid rgba(255,107,107,0.18);
        color: rgba(220,160,180,0.7);
    }
    .import-card .info-note strong { color: #ff8fab; }

    /* ── Alert ───────────────────────────────────── */
    .alert-success-custom {
        background: rgba(78,205,196,0.1);
        border: 1px solid rgba(78,205,196,0.3);
        border-left: 3px solid #4ecdc4;
        color: #4ecdc4; border-radius: 16px;
        padding: 1rem 1.5rem; margin-bottom: 1.5rem;
        display: flex; align-items: center; gap: 0.75rem; font-size: 0.95rem;
    }

    /* ── Spinner ─────────────────────────────────── */
    .spinner {
        display: none; width: 17px; height: 17px;
        border: 2px solid rgba(255,255,255,0.25);
        border-top-color: currentColor; border-radius: 50%;
        animation: spin 0.7s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>

<div class="container py-4">

    
    <div class="page-header">
        <h1 class="page-title">Import / Export Excel</h1>
        <p class="page-subtitle">จัดการข้อมูลสาขาและโรงภาพยนตร์ผ่านไฟล์ Excel</p>
    </div>

    <?php if(session('success')): ?>
    <div class="alert-success-custom">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <div class="excel-grid">

        
        <div class="action-card export-card">
            <div class="card-icon-wrap">
                <svg fill="none" stroke="#4ecdc4" stroke-width="1.6" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                    <line x1="3" y1="9" x2="21" y2="9"/>
                    <line x1="3" y1="15" x2="21" y2="15"/>
                    <line x1="9" y1="9" x2="9" y2="21"/>
                    <path d="M14 17l2 2 2-2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="16" y1="13" x2="16" y2="19" stroke-linecap="round"/>
                </svg>
            </div>

            <div class="card-title">Export Excel</div>
            <p class="card-desc">
                ดาวน์โหลดข้อมูลสาขาและโรงภาพยนตร์ทั้งหมดออกเป็นไฟล์ .xlsx
                พร้อม 2 Sheet แยก Branches และ Theatres
            </p>
            <div class="card-divider"></div>

            <a href="<?php echo e(route('admin.excel.export')); ?>" class="btn-export" id="exportBtn"
               onclick="handleExportClick(this)">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                <span>Download Excel</span>
                <span class="spinner" id="exportSpinner"></span>
            </a>

            <div class="info-note">
                <strong>หมายเหตุ:</strong> ไฟล์จะมีหัวตาราง 2 ภาษา (EN / TH) พร้อม formatting สีและ column width ที่เหมาะสม
            </div>
        </div>

        
        <div class="action-card import-card">
            <div class="card-icon-wrap">
                <svg fill="none" stroke="#ff8fab" stroke-width="1.6" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                    <line x1="3" y1="9" x2="21" y2="9"/>
                    <line x1="3" y1="15" x2="21" y2="15"/>
                    <line x1="9" y1="9" x2="9" y2="21"/>
                    <path d="M14 15l2-2 2 2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="16" y1="13" x2="16" y2="19" stroke-linecap="round"/>
                </svg>
            </div>

            <div class="card-title">Import Excel</div>
            <p class="card-desc">
                อัปโหลดไฟล์ .xlsx เพื่อนำเข้าข้อมูลเข้าสู่ระบบ
                รองรับไฟล์ที่ Export จากระบบนี้เท่านั้น
            </p>
            <div class="card-divider"></div>

            <form action="<?php echo e(route('admin.excel.import')); ?>" method="POST"
                  enctype="multipart/form-data" id="importForm">
                <?php echo csrf_field(); ?>

                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="file" id="fileInput" accept=".xlsx,.xls"
                           required onchange="handleFileSelect(this)">
                    <svg class="upload-icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M4 16v1a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-1"/>
                        <polyline points="16 6 12 2 8 6"/>
                        <line x1="12" y1="2" x2="12" y2="15"/>
                    </svg>
                    <div class="upload-text">
                        <strong>คลิกเพื่อเลือกไฟล์</strong> หรือลากไฟล์มาวางที่นี่<br>
                        รองรับ .xlsx / .xls เท่านั้น
                    </div>
                </div>

                <div class="file-selected" id="fileSelected">
                    <svg width="18" height="18" fill="none" stroke="#ff8fab" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                    <span class="file-name" id="fileName">—</span>
                    <svg width="16" height="16" fill="none" stroke="rgba(255,139,171,0.6)" stroke-width="2"
                         viewBox="0 0 24 24" style="cursor:pointer;flex-shrink:0" onclick="clearFile()">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </div>

                <button type="submit" class="btn-import" id="importBtn" disabled>
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <span>Upload &amp; Import</span>
                    <span class="spinner" id="importSpinner"></span>
                </button>
            </form>

            <div class="info-note">
                <strong>คำเตือน:</strong> ข้อมูลที่นำเข้าจะ <strong>เพิ่ม</strong> เข้าไปในระบบ
                กรุณาตรวจสอบไฟล์ก่อน Import และสำรองข้อมูลไว้เสมอ
            </div>
        </div>

    </div>
</div>

<script>
    function handleFileSelect(input) {
        const file = input.files[0];
        if (!file) return;
        document.getElementById('fileName').textContent = file.name;
        document.getElementById('fileSelected').style.display = 'flex';
        document.getElementById('uploadZone').style.display = 'none';
        document.getElementById('importBtn').disabled = false;
    }
    function clearFile() {
        document.getElementById('fileInput').value = '';
        document.getElementById('fileSelected').style.display = 'none';
        document.getElementById('uploadZone').style.display = 'block';
        document.getElementById('importBtn').disabled = true;
    }
    const zone = document.getElementById('uploadZone');
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault(); zone.classList.remove('drag-over');
        if (e.dataTransfer.files.length) {
            document.getElementById('fileInput').files = e.dataTransfer.files;
            handleFileSelect(document.getElementById('fileInput'));
        }
    });
    function handleImportClick(btn) {
        btn.disabled = true;
        btn.querySelector('span:nth-child(2)').textContent = 'กำลังนำเข้า...';
        document.getElementById('importSpinner').style.display = 'inline-block';
    }
    function handleExportClick(btn) {
        document.getElementById('exportSpinner').style.display = 'inline-block';
        btn.querySelector('span:nth-child(2)').textContent = 'กำลังสร้างไฟล์...';
        setTimeout(() => {
            document.getElementById('exportSpinner').style.display = 'none';
            btn.querySelector('span:nth-child(2)').textContent = 'Download Excel';
        }, 3000);
    }
</script>

<script>
const form = document.getElementById('importForm');
const btn = document.getElementById('importBtn');
const spinner = document.getElementById('importSpinner');

form.addEventListener('submit', () => {
  spinner.classList.add('show');
  btn.disabled = true;

  // กันค้าง: ถ้าเกิด error/redirect หน้าโหลดใหม่ spinner จะถูกซ่อน
  setTimeout(() => {
    spinner.classList.remove('show');
    btn.disabled = false;
  }, 15000);
});

window.addEventListener('pageshow', () => {
  spinner.classList.remove('show');
  btn.disabled = false;
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/excel.blade.php ENDPATH**/ ?>