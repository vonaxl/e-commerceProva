<?php

use Illuminate\Database\Seeder;
use App\Review;
use App\Product;
use App\User;
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Review::class, 50)
        ->make()
        ->each(function($review,$product){
            $product = Product::inRandomOrder() -> first();
            $user = User::inRandomOrder() ->first();
            
            $review -> product() -> associate($product);
            $review -> user() -> associate($user);
            $review -> save();
        });
    }
}
