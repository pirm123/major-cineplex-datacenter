<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    // ← ต้องมี!
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // ถ้ายังไม่ได้ล็อกอิน
        if (!Auth::check()) {    // ← ไม่มี error แล้ว
            return redirect('/')
                ->with('error', 'กรุณาเข้าสู่ระบบก่อน');
        }

        // ดึง role ของผู้ใช้
        $userRole = Auth::user()->role;  // ← ไม่มี error แล้ว

        // ตรวจสิทธิ์
        if (!in_array($userRole, $roles)) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้');
        }

        return $next($request);
    }
}
