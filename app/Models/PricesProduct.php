<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PricesProduct extends Model
{
    protected $table = 'prices_products';

    protected $fillable = [
        'product_id',
        'currency_id',
        'price'
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
