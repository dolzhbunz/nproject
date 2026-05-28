<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function dashboard()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Доступ запрещен. Только для администраторов.');
        }

        $pendingRequests = RoleRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        $stats = [
            'pending_requests' => RoleRequest::where('status', 'pending')->count(),
            'total_users' => User::count()
        ];

        return view('admin.dashboard', compact('stats', 'pendingRequests'));
    }

}
