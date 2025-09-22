<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = ['full_name','phone','address','total'];


    /**
     * Relationship: Order belongs to a User (customer)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Order has many items
     */
     public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
