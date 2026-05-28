<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $hasPendingRequest = $user->requests()
            ->where('status', 'pending')
            ->exists();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $latestRequest = $user->requests()
            ->orderBy('created_at', 'desc')
            ->first();

        return view('dashboard', compact('user', 'hasPendingRequest', 'latestRequest'));
    }
}
