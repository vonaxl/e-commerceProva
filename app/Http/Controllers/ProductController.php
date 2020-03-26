<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Admin;

use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
	public function index(){
		return Product::all();;
	}

	public function show(Product $product){
		return $product;
	}

	public function destroy(Product $product){
		$product -> images() -> delete();   
		$product -> reviews() -> delete();
		$product -> categories() -> detach();
		$product -> delete();
	}

	public function searchProducts(Request $request){

		$params = [];
		
		if($request->navSearch) $params[] = ['name', 'LIKE', "%$request->navSearch%"];
		if($request->price) $params[] = ['price', '<=', "$request->price"];
		
		if($request->category){
			$id = $request->category;
			$products = Product::with('categories', 'reviews', 'images') -> where($params) -> whereHas('categories', function (Builder $query) use ($id) {
					$query->where('category_id', '=', $id);
			})->get();
		} else $products = Product::with('categories', 'reviews', 'images') -> where($params) -> get();
		
		return response() -> json(compact('products'));
	}

	public function allCategories(){
		return Category::all();
	}
}
