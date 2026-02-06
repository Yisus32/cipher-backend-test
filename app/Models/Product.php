<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'tax_cost',
        'manufacturing_cost',
        'currency_id',
    ];
    
    public function currency(): HasOne  {
        return $this->hasOne(Currency::class);
    }

    public function prices(): HasMany {
        return $this->hasMany(PricesProduct::class)->with(['currency']);
    }
}
