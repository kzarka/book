<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function login(Request $request)
    {
        $method = $request->method();
        if($method == 'GET') {
            return view('auth.login');
        }
        try {
            $remember = (bool) $request->get('remember', false);
            if (Sentinel::authenticate($request->all(), $remember)) {
                return redirect()->route('admin_dashboard');
            } else {
                $err = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        } catch (NotActivatedException $e) {
            $err = "Tài khoản của bạn chưa được kích hoạt";
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $err = "Tài khoản của bạn bị block trong vòng {$delay} sec";
        }
        return redirect()->back()
            ->withInput()
            ->with('err', $err);
    }

    public function logout()
    {
        $user = Sentinel::getUser();
        \Log::info($user);
        Sentinel::logout($user, true);
        return redirect()->route('home');
    }
}
