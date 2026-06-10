<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessRoleRequest;
use App\Models\RoleRequest;
use App\Models\RoleRequestLog;
use App\Services\RoleRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRequestController extends Controller
{
    protected RoleRequestService $service;
    public function __construct(RoleRequestService $service)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $query = RoleRequest::with('user');

        if ($status === 'pending') {
            $query->where('status', 'pending');
        } elseif ($status === 'approved') {
            $query->where('status', 'approved');
        } elseif ($status === 'rejected') {
            $query->where('status', 'rejected');
        }

        $requests = $query->latest()->paginate(15);
        return view('admin.requests.index', compact('requests', 'status'));
    }

    public function show(RoleRequest $roleRequest)
    {
        $roleRequest->load(['user', 'logs.admin']);

        return view('admin.requests.show', compact('roleRequest'));
    }

    public function approve(ProcessRoleRequest $request, RoleRequest $roleRequest)
    {
        $validated = $request->validated();

        // 1. Меняем роль пользователя
        $user = $roleRequest->user; // <-- ИСПРАВЛЕНО: было $roleRequest->validated() - это ошибка
        $oldRole = $user->role;
        $user->role = $roleRequest->requested_role;
        $user->save();

        // 2. Обновляем статус заявки через сервис
        $this->service->approveRequest($roleRequest);

        // 3. Создаём лог (опционально)
        RoleRequestLog::create([
            'role_request_id' => $roleRequest->id,
            'admin_id' => Auth::id(),
            'comment' => $validated['comment'] ?? 'Заявка одобрена'
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Заявка одобрена, роль пользователя изменена.');
    }

    public function reject(ProcessRoleRequest $request, RoleRequest $roleRequest)
    {
        $validated = $request->validated();

        // Обновляем статус заявки
        $this->service->rejectRequest($roleRequest);

        // Создаём лог с комментарием
        RoleRequestLog::create([
            'role_request_id' => $roleRequest->id,
            'admin_id' => Auth::id(),
            'comment' => $validated['comment'] ?? 'Заявка отклонена без комментария'
        ]);

        return redirect()->route('admin.dashboard')->with('info', 'Заявка отклонена.');
    }
}
