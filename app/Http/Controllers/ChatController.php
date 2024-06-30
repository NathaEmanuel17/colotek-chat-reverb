<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function dashboard()
    {
        $currentUserId = auth()->user()->id;
        $users = $this->userService->getAllUsersExceptCurrent($currentUserId);
        return view('dashboard', compact('users'));
    }

    public function chat($id)
    {
        $currentUserId = auth()->user()->id;
        $users = $this->userService->getAllUsersExceptCurrent($currentUserId);
        return view('chat', compact('id', 'users'));
    }
}
