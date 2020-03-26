<?php

use Illuminate\Database\Seeder;
use App\Image;
use App\Product;
class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Image::class,50) 
        -> make()
        -> each(function($image){
            $product = Product::inRandomOrder() -> first();

            $image -> product() -> associate($product);
            $image -> save();
        });
    }
}
