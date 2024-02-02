<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Proxy;

class HistoryCheck extends Model
{
    protected $table = 'history_checks';

    protected $fillable = [
        'total_proxies_checked',
        'working_proxies',
    ];

    public function proxies(): HasMany
    {
        return $this->hasMany(Proxy::class);
    }

}