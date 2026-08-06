<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Requests\RegisterRequest;

class RegisterController extends Controller
{
    //
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function show()
    {
        return view('auth::register');
    }
    public function register(RegisterRequest $request)
    {
        // dd("Register Controller register");
        $user = $this->authService->register($request->validated());
        return view('auth::login', [
            'success' => true,
            'message' => 'user registered successfully',
            'user' => $user
        ]);
    }
}
