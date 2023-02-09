<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductProperty extends Pivot
{
    protected $casts = [
        'position' => 'integer',
    ];

    protected $hidden = [
        'product_id',
        'property_id',
    ];
}
