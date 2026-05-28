<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleRequestLog extends Model
{
    protected $fillable = [
        'role_request_id',
        'admin_id',
        'comment'
    ];

    public function roleRequest()
    {
        return $this->belongsTo(RoleRequest::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
