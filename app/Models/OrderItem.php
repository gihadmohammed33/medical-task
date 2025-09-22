<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
   protected $fillable = ['order_id','product_id','quantity','price'];


    public $timestamps = false; // keep false if your table has no created_at/updated_at

    /**
     * Relationship: Each order item belongs to an Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relationship: Each order item belongs to a Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
