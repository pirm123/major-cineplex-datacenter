<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ถ้ามี query parameter ?lang= ให้เก็บลง session
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            
            // ตรวจสอบว่าเป็นภาษาที่รองรับ
            if (in_array($locale, ['th', 'en'])) {
                Session::put('locale', $locale);
            }
        }

        // ดึงภาษาจาก session หรือใช้ค่าเริ่มต้น
        $locale = Session::get('locale', config('app.locale', 'th'));
        
        // ตั้งค่าภาษา
        App::setLocale($locale);

        return $next($request);
    }
}