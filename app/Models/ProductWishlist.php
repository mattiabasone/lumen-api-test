<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductWishlist extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'wishlist_id',
    ];

    protected $casts = [
        'product_id' => 'int',
        'wishlist_id' => 'int'
    ];
}
