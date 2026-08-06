<?php

namespace App\Modules\Auth\Controllers;  // ← Fixed: was lowercase 'modules\auth'

use App\Http\Controllers\Controller;
use App\Modules\Auth\Requests\LoginRequest;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Show login form
    public function show()
    {

        return view('auth::login');
    }

    // Handle login form submission
    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated()); // ← Fixed: was 'this->'
        // dd('ServiceProvider booted ', $result);

        // dd("loggedin real", $result);
        if (!$result['success']) {
            return back()->withErrors([        // ← go back to login form with error
                'email' => $result['message'],
            ]);
        }
        if (Auth::check()) {    
        } else {
            dd("loggedin");
            echo "User is not logged in";
        }
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // Handle logout
    public function logout(Request $request)                   // ← Added: was missing but route used it
    {
        // dd("logout controller", $request);
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logged out successfully');
    }
}
