<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Observers\ProductObserver;


class AppServiceProvider extends ServiceProvider
{
 public function boot()
{
    Product::observe(ProductObserver::class);
}
}
