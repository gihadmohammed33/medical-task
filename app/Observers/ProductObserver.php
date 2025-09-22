<?php
namespace App\Observers;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function created(Product $product)
    {
        ProductLog::create([
            'product_id' => $product->id,
            'action' => 'created',
            'changed_by' => Auth::id() ?? 1,
            'changes' => json_encode($product->getAttributes()),
        ]);
    }

    public function updated(Product $product)
    {
        ProductLog::create([
            'product_id' => $product->id,
            'action' => 'updated',
            'changed_by' => Auth::id() ?? 1,
            'changes' => json_encode($product->getChanges()),
        ]);
    }

    public function deleted(Product $product)
    {
        ProductLog::create([
            'product_id' => $product->id,
            'action' => 'deleted',
            'changed_by' => Auth::id() ?? 1,
            'changes' => null,
        ]);
    }
}
