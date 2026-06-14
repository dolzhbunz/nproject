<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'user_id',
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

}
