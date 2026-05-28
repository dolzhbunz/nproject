<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function show(User $user)
    {
        $requests = $user->requests()
            ->with('logs.admin')
            ->latest()
            ->paginate(10);

        $stats = [
            'total_requests' => $user->requests()->count(),
            'approved_requests' => $user->requests()->where('status', 'approved')->count(),
            'rejected_requests' => $user->requests()->where('status', 'rejected')->count(),
            'pending_requests' => $user->requests()->where('status', 'pending')->count(),
        ];

        return view('admin.users.show', compact('user', 'requests', 'stats'));
    }


}
