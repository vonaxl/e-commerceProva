<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Show all categories
Route::get('/categories', 'ProductController@allCategories');

// Show all products
Route::get('/products', 'ProductController@index');
// Search product
Route::get('/search/{params?}', 'ProductController@searchProducts')->where('params', '.*');
// Show a product
Route::get('/show/{product}', 'ProductController@show');
// Delete a product
Route::delete('/delete/{product}', 'ProductController@destroy');
