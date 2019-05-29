<?php
namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

class CheckRoleAdmin
{

    /**
     * Xử lý yêu cầu đến
     *
     * @param \Illuminate\Http\Request $request         
     * @param \Closure $next            
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::getUser()->inRole('admin') || Sentinel::getUser()->inRole('mod')) {
            return $next($request);
        }
        return redirect()->route('home')->with('err', 'Bạn không có quyền truy cập');
    }
}