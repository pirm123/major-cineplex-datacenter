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
        $items = $grouped->get($code, collect());

        // ถ้ามีค้นหา → ไม่เอาภาคที่ว่าง
             if ($q && $items->isEmpty()) {
            continue;
        }

        $groups[$code] = $items;
        }
        
        $pinnedIds = session()->get('pinned_branches', []);
        $pinnedBranches = CinemaBranch::withCount('theatres')
            ->whereIn('id', $pinnedIds)
            ->orderBy('name')
            ->get();
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
    
        public function togglePin(Request $request, CinemaBranch $branch)
    {
        $pins = session()->get('pinned_branches', []);

        if (in_array($branch->id, $pins)) {
        // ถ้าปักอยู่แล้ว → เอาออก
            $pins = array_values(array_diff($pins, [$branch->id]));
    }   
        else {
        // ถ้ายังไม่ปัก → เพิ่มเข้าไป
        $pins[] = $branch->id;
    }

        session()->put('pinned_branches', $pins);

        return back();
    }
    
}