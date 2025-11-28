<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reported_type',
        'reported_id',
        'reason',
        'ip_address',
        'is_handled'
    ];

    protected $casts = [
        'is_handled' => 'boolean',
    ];
}
