<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
{
    // แสดงรายการผู้ใช้ทั้งหมด
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        })
        ->orderBy('id')
        ->get();

        return view('admin.users.index', compact('users', 'search'));
    }

    // อัปเดต role ผู้ใช้
    public function updateRole(Request $request, User $user)
    {
        // 🔒 ล็อค admin หลัก
        if ($user->email === 'admin@gmail.com') {
            return back()->with('error', 'ไม่สามารถแก้ไขสิทธิ์ของ Admin หลักได้');
        }

        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'อัปเดตสิทธิ์ผู้ใช้เรียบร้อยแล้ว');
    }

    // ลบผู้ใช้
    public function destroy(User $user)
    {
        // ❌ ห้ามลบตัวเอง
        if (Auth::id() === $user->id) {
            return back()->with('error', 'ไม่สามารถลบบัญชีของตัวเองได้');
        }

        // 🔒 ล็อค admin หลัก
        if ($user->email === 'admin@gmail.com') {
            return back()->with('error', 'ไม่สามารถลบบัญชี Admin หลักได้');
        }

        $user->delete();

        return back()->with('status', 'ลบผู้ใช้เรียบร้อยแล้ว');
    }
}