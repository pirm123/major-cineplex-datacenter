<?php

namespace App\Http\Controllers;

use App\Models\CinemaBranch;
use App\Models\Theatre;
use Illuminate\Http\Request;

class TheatreController extends Controller
{
    /**
     * แสดงรายการโรงของสาขา (กรอง + pagination)
     * URL: /branches/{branch}/theatres
     */
    public function index(Request $request, $branchId)
    {
        $branch = CinemaBranch::findOrFail($branchId);

        $query = $branch->theatres()
            ->orderBy('theatre_number');

        // filter ประเภทโรง
        if ($request->filled('type')) {
            $query->where('Type_name', $request->type);
        }

        // filter ที่นั่งขั้นต่ำ
        if ($request->filled('seat_min')) {
            $query->where('seat_count', '>=', $request->seat_min);
        }

        $theatres = Theatre::where('branch_id', $branchId)
        ->orderBy('theatre_number')
        ->get();

        $theatres = $query
            ->paginate(20)
            ->withQueryString();

        return view('theatres.index', compact('branch', 'theatres'));
    }

    /**
     * แสดงรายละเอียดโรง (แก้ error 500 ตรงนี้)
     * URL: /branches/{branch}/theatres/{theatre}
     */
    public function show($branchId, $theatreId)
    {
        $branch = CinemaBranch::findOrFail($branchId);

        $theatre = Theatre::where('branch_id', $branchId)
            ->where('id', $theatreId)
            ->firstOrFail();

        return view('theatres.show', compact('branch', 'theatre'));
    }
}
