<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create(['name'=>'Panadol','price'=>25,'stock'=>100,'description'=>'Pain relief']);
        Product::create(['name'=>'Vitamin C','price'=>50,'stock'=>80,'description'=>'Immune booster']);
    }
}
