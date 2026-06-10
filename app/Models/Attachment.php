<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'file_name',
        'file_path',
        'file_type',
        'size'
    ];

    protected $casts = [
        'size' => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
