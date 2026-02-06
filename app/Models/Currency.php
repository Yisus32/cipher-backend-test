<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Currency extends Model
{
    protected $table = 'currencies';
    
    protected $fillable = [
        'name',
        'symbol',
        'code',
        'exchange_rate',
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
