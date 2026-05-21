<?php

namespace App\Services;

use App\Models\RoleRequest;

class RoleRequestService
{
    public function create(array $data, int $userId): RoleRequest
    {
        $roleRequest = RoleRequest::create(array_merge($data,
        ['user_id' => $userId]));

        return $roleRequest;
    }

    public function approveRequest (RoleRequest $roleRequest): void
    {
        $roleRequest->update(['status' => 'approved']);
    }

    public function rejectRequest (RoleRequest $roleRequest):void
    {
        $roleRequest->update(['status' => 'rejected']);
    }
}
