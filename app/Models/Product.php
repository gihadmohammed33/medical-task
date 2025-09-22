<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes; // ✅ Correct import

class Product extends Model
{
use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'stock', // 👈 add this if you're tracking stock levels
    ];

    /**
     * Relationship: Product belongs to a Category
     */
    public function category()
{
    return $this->belongsTo(Category::class);
}


    /**
     * Relationship: Product has many OrderItems
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Accessor: Get the full URL of the product image
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }
        return 'https://via.placeholder.com/300';
    }
    
}
