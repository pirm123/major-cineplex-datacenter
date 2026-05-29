<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CinemaBranch;
use App\Models\Theatre;
use Illuminate\Http\Request;

class TheatreAdminController extends Controller
{
    public function index(Request $request)
    {
        $branches = CinemaBranch::orderBy('name')->get();

        $query = Theatre::with('branch');

        if ($request->branch_id) {
            $query->where('branch_id', $request->branch_id);
        }

        if ($request->filled('search')) {
            $s = trim($request->search);
            $sLike = str_replace(' ', '%', $s);

            $query->where(function ($q) use ($sLike) {

        // ✅ 1️⃣ ค้นจากชื่อโรงภาพยนตร์ / สาขา (Major Cineplex Ratchayothin)
            $q->whereHas('branch', function ($b) use ($sLike) {
            $b->where('name', 'like', "%{$sLike}%");
        });

        // 2️⃣ รอง: ชื่อโรง / เลขโรง
            $q->orWhere('theatre_name', 'like', "%{$sLike}%")
            ->orWhere('theatre_number', 'like', "%{$sLike}%");

        // 3️⃣ รองลงมา: ประเภท / ฟอร์แมต
            $q->orWhere('Type_name', 'like', "%{$sLike}%")
             ->orWhere('special_format', 'like', "%{$sLike}%");
            });
        }


        $theatres = $query
            ->orderBy('branch_id')
            ->orderBy('theatre_number')
            ->get();

        return view('admin.theatres.index', compact('theatres', 'branches'));
    }

    public function create()
    {
        $branches = CinemaBranch::orderBy('name')->get();
        return view('admin.theatres.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'branch_id'      => 'required|exists:cinema_branches,id',
            'theatre_number' => 'nullable|integer|min:1',
            'theatre_name'   => 'nullable|string|max:255',
            'Type_name'      => 'nullable|string|max:100',
            'special_format' => 'nullable|string|max:100',
            'lamp_type'      => 'nullable|string|max:100',
            'seat_count'     => 'required|integer|min:0',

            'screen_width'   => 'nullable|numeric',
            'screen_height'  => 'nullable|numeric',
            'throw_distance' => 'nullable|numeric',

            'server_make'    => 'nullable|string|max:100',
            'server_model'   => 'nullable|string|max:100',
            'server_serial'  => 'nullable|string|max:100',

            'projector_make'   => 'nullable|string|max:100',
            'projector_model'  => 'nullable|string|max:100',
            'projector_serial' => 'nullable|string|max:100',
            'projector_ip'     => 'nullable|string|max:100',

            'sound_make'  => 'nullable|string|max:100',
            'sound_model' => 'nullable|string|max:100',
            'sound_ip'    => 'nullable|string|max:100',
            'sound_port'  => 'nullable|string|max:50',

            'three_d_type' => 'nullable|string|max:100',
            'backup_35mm'  => 'nullable|string|max:10',

            'initial_installation'    => 'nullable|date',
            'new_screen_installed_at' => 'nullable|date',
            'client_ip' => 'nullable|string|max:50',
        ]);

        Theatre::create($data);

        return redirect()->route('admin.theatres.index', [
            'branch_id' => $request->branch_id,
            'search'    => $request->search,
        ])->with('success', 'เพิ่มโรงเรียบร้อยแล้ว');
    }

    public function edit(Theatre $theatre)
    {
        $branches = CinemaBranch::orderBy('name')->get();
        return view('admin.theatres.edit', compact('theatre', 'branches'));
    }

    public function update(Request $request, Theatre $theatre)
    {
        $data = $request->validate([
            'branch_id'      => 'required|exists:cinema_branches,id',
            'theatre_number' => 'required|integer|min:1',
            'theatre_name'   => 'nullable|string|max:255',
            'Type_name'      => 'nullable|string|max:100',
            'special_format' => 'nullable|string|max:100',
            'lamp_type'      => 'nullable|string|max:100',
            'seat_count'     => 'required|integer|min:0',

            'screen_width'   => 'nullable|numeric',
            'screen_height'  => 'nullable|numeric',
            'throw_distance' => 'nullable|numeric',

            'server_make'    => 'nullable|string|max:100',
            'server_model'   => 'nullable|string|max:100',
            'server_serial'  => 'nullable|string|max:100',

            'projector_make'   => 'nullable|string|max:100',
            'projector_model'  => 'nullable|string|max:100',
            'projector_serial' => 'nullable|string|max:100',
            'projector_ip'     => 'nullable|string|max:100',

            'sound_make'  => 'nullable|string|max:100',
            'sound_model' => 'nullable|string|max:100',
            'sound_ip'    => 'nullable|string|max:100',
            'sound_port'  => 'nullable|string|max:50',

            'three_d_type' => 'nullable|string|max:100',
            'backup_35mm'  => 'nullable|string|max:10',

            'initial_installation'    => 'nullable|date',
            'new_screen_installed_at' => 'nullable|date',
            'client_ip' => 'nullable|string|max:50',
        ]);

        $theatre->update($data);

        return redirect()->route('admin.theatres.index', [
            'branch_id' => $theatre->branch_id,
            'search'    => $request->search,
        ])->with('success', 'แก้ไขโรงเรียบร้อยแล้ว');
    }

    public function destroy(Theatre $theatre)
    {
        $branchId = $theatre->branch_id;
        $theatre->delete();

        return redirect()->route('admin.theatres.index', [
            'branch_id' => $branchId,
        ])->with('success', 'ลบโรงเรียบร้อยแล้ว');
    }
}
