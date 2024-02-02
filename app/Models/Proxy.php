<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\HistoryCheck;

class Proxy extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_port',
        'type',
        'country',
        'city',
        'status',
        'download_speed',
        'timeout',
        'real_ip',
        'history_check_id'
    ];

    public function history(): BelongsTo
    {
        return $this->belongsTo(HistoryCheck::class);
    }
}
