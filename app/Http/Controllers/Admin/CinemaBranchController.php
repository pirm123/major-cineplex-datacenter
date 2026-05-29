<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CinemaBranch;
use Illuminate\Http\Request;

class CinemaBranchController extends Controller
{
    private array $regions = [
        'Bangkok Metropolitan Area',
        'Central Region',
        'Northern Region',
        'Northeastern Region',
        'Eastern Region',
        'Western Region',
        'Southern Region',
    ];

    public function index(Request $request)
    {
    $query = CinemaBranch::query();

    // 🔍 ค้นหาชื่อสาขา หรือ IP
    if ($request->filled('search')) {
        $s = $request->search;

        $query->where(function ($q) use ($s) {
            $q->where('name', 'like', "%{$s}%")
              ->orWhere('branch_ip', 'like', "%{$s}%");
        });
    }

    $branches = $query
        ->orderBy('name')
        ->get();

    return view('admin.branches.index', compact('branches'));
}


    public function create()
    {
        $regions = $this->regions;
        return view('admin.branches.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
        'name'           => 'required|string|max:255',
        'address'        => 'required|string',
        'branch_ip'      => 'nullable|string|max:50',
        'tms_ip'         => 'nullable|string|max:21', 
        'total_theatres' => 'required|integer|min:0',
        'region'         => 'required|string|max:50',
        'tms_app_ip'     => 'nullable|string|max:50',
        
    ]);

        CinemaBranch::create($data);


        return redirect()
            ->route('admin.branches.index')
            ->with('success', 'เพิ่มสาขาเรียบร้อยแล้ว');
    }

    public function edit(CinemaBranch $branch)
    {
        $regions = $this->regions;
        return view('admin.branches.edit', compact('branch', 'regions'));
    }

    public function update(Request $request, CinemaBranch $branch)
    {
        $data = $request->validate([
        'name'           => 'required|string|max:255',
        'address'        => 'nullable|string',
        'branch_ip'      => 'nullable|string|max:50',
        'tms_ip'         => 'nullable|string|max:21', 
        'total_theatres' => 'nullable|integer|min:0',
        'region'         => 'nullable|string|max:50',
        'tms_app_ip'     => 'nullable|string|max:50',
        ]);

        $branch->update($data);


        return redirect()
            ->route('admin.branches.index')
            ->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function destroy(CinemaBranch $branch)
    {
        $branch->delete();

        return redirect()
            ->route('admin.branches.index')
            ->with('success', 'ลบสาขาเรียบร้อยแล้ว');
    }
}
