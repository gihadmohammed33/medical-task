<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    use HasFactory;
        public $timestamps = false;   // 👈 prevent Laravel from using created_at/updated_at


    protected $fillable = [
        'product_id', 'action', 'changes', 'changed_by'
    ];

    // Add this cast
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
