<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
     protected function redirectTo()

{
    $user = Auth()->user();

    if ($user->roles->contains('name', 'admin')) {
        return route('admin.dashboard'); // /dashboard
    }

    if ($user->roles->contains('name', 'user')) {
        return route('user.dashboard'); // /user/dashboard
    }

    return '/'; // fallback
}




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
{
    // Validate input
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        $user = auth()->user();

        // If you're using Spatie Laravel Permission
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('staff')) {
            return redirect()->route('user.dashboard');
        }

        // fallback if role is not recognized
        auth()->logout();
        return redirect()->route('login')->with('error', 'Unauthorized role access');
    }

    return redirect()->route('login')->with('error', 'Email or password is incorrect');
}

}
