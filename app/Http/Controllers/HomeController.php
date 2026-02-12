<?php

namespace App\Http\Controllers;

use App\Models\CinemaBranch;
use App\Models\Theatre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // =========================
        // 1) รับค่าค้นหา
        // =========================
        $q = trim($request->get('q'));

        // =========================
        // 2) จำนวนสาขา / โรงทั้งหมด
        // =========================
        $branchCount = CinemaBranch::count();
        $theatreCount = Theatre::count();

        // =========================
        // 3) ดึงสาขาพร้อมจำนวนโรง + ค้นหา
        // =========================
        $branches = CinemaBranch::withCount('theatres')
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->orderBy('region_code')
            ->orderBy('name')
            ->get();

        // =========================
        // 4) ลำดับภาค (ใช้ code)
        // =========================
        $regionOrder = [
            'bkk', // กรุงเทพฯ และปริมณฑล
            'c',   // ภาคกลาง
            'n',   // ภาคเหนือ
            'ne',  // ภาคตะวันออกเฉียงเหนือ
            'e',   // ภาคตะวันออก
            'w',   // ภาคตะวันตก
            's',   // ภาคใต้
        ];

        // =========================
        // 5) จัดกลุ่มสาขาตาม region_code
        // =========================
        $grouped = $branches->groupBy(function ($branch) {
            return $branch->region_code ?? 'other';
        });

        // =========================
        // 6) สร้าง groups ให้ครบทุกภาค
        // =========================
        $groups = collect();
        foreach ($regionOrder as $code) {
            $groups[$code] = $grouped->get($code, collect());
        }

        // =========================
        // 7) ส่งข้อมูลไปยัง View
        // =========================
        return view('home', compact(
            'groups',
            'branchCount',
            'theatreCount',
            'q'
        ));
    }
}