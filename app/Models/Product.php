<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_category_id',
        'name', 
        'slug', 
        'images', 
        'description', 
        'price',
        'specs',
        'is_active',
        'is_selected',
        'is_promotion',
        'is_preorder',
        'in_stock',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function sub_category(): BelongsTo{
        return $this->belongsTo(SubCategory::class);
    }

    public function orderItems(): HasMany{
        return $this->hasMany(OrderItem::class);
    }
}
