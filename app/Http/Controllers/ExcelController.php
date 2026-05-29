<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BranchesExport;
use App\Imports\BranchesImport;

class ExcelController extends Controller
{
    public function index()
    {
        return view('admin.excel');
    }

    public function export()
    {
        return Excel::download(new BranchesExport, 'branches.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:20480',
        ]);

        try {
            Excel::import(new BranchesImport, $request->file('file'));
            return back()->with('success', '✅ Import Excel สำเร็จ');
        } catch (\Throwable $e) {
            Log::error('Excel import error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->with('error', '❌ Import ล้มเหลว: ' . $e->getMessage());
        }
    }
}