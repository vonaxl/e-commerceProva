<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 10) 
        -> create()
        -> each(function($category){
            $products = Product::inRandomOrder() -> take(rand(1,3)) -> get();
            $category -> products() -> attach($products);
        });
    }
}
