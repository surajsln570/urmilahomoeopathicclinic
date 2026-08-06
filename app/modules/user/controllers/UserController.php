<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\User\Requests\StoreUserRequest;
use App\Modules\User\Requests\UpdateUserRequest;
use App\modules\user\services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function create(StoreUserRequest $request)
    {
        $result = $this->userService->store($request);
        return response()->json($result);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $result = $this->userService->update(
            $id,
            $request->validated()
        );
        return response()->json($result);
    }
    public function getUser()
    {
        $result = $this->userService->getAllUsers();
        return Inertia::render('users/Index', [
            'users' => User::latest()->get(),
        ]);
    }
    public function deleteUser(int $id)
    {
        $result = $this->userService->deleteUser($id);
        return redirect()->route('users')->with('success', 'User created Successfully');
    }
}
