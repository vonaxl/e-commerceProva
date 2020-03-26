<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        //  PRODUCTS 1 - M REVIEWS
        Schema::table('reviews', function (Blueprint $table) {
            $table -> bigInteger('product_id') -> unsigned() -> index();
            $table -> foreign('product_id', 'reviews_products_id')
                   -> references('id')
                   -> on('products');
         });
        //  PRODUCTS 1 - M IMAGES
        Schema::table('images', function (Blueprint $table) {
            $table -> bigInteger('product_id') -> unsigned() -> index();
            $table -> foreign('product_id', 'images_products_id')
                   -> references('id')
                   -> on('products');
         });
        //  USERS 1 - M REVIEWS
        Schema::table('reviews', function (Blueprint $table) {
            $table -> bigInteger('user_id') -> unsigned() -> index();
            $table -> foreign('user_id', 'reviews_users_id')
                   -> references('id')
                   -> on('users');
         });


        //  MOLTI A MOLTI
        Schema::table('category_product', function (Blueprint $table) {
            $table -> bigInteger("category_id")->unsigned()->index();
            $table -> foreign("category_id","category_product_category_id")
            ->references("id")
            ->on("categories");

            $table -> bigInteger("product_id")->unsigned()->index();
            $table -> foreign("product_id","category_product_product_id")
            ->references("id")
            ->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        //  PRODUCTS 1 - M REVIEWS
        Schema::table('reviews', function (Blueprint $table) {
            $table -> dropForeign('reviews_products_id');
            $table -> dropColumn('product_id');
        });
        //  PRODUCTS 1 - M IMAGES
        Schema::table('images', function (Blueprint $table) {
            $table -> dropForeign('images_products_id');
            $table -> dropColumn('product_id');
        });
        //  USERS 1 - M REVIEWS
        Schema::table('reviews', function (Blueprint $table) {
            $table -> dropForeign('reviews_users_id');
            $table -> dropColumn('user_id');
        });

        // M - M

        Schema::table('category_product', function (Blueprint $table) {
            $table->dropForeign("category_product_category_id");
            $table->dropColumn("category_id");

            $table->dropForeign("category_product_product_id");
            $table->dropColumn("product_id");
        });
    }
}
