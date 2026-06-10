<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Models\RoleRequest;
use App\Services\RoleRequestService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class RoleRequestController extends Controller
{
    protected RoleRequestService $service;
    public function __construct(RoleRequestService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        $hasPending = RoleRequest::pending()->forUser(Auth::id())->exists();
        return view('role_requests.create', compact('hasPending'));
    }

    public function store(StoreRoleRequest $request)
    {
        $user = Auth::user();

        $this->service->create($request->validated(),$user->id);
        return redirect()->route('dashboard')->with('success', 'Заявка принята');
    }

    public function process(ProcessRoleRequest $request, RoleRequest $roleRequest)
    {

    }
}
