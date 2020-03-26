<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
    ]; 

    public function reviews(){
        return $this -> hasMany(Review::class);
    }
    public function images(){
        return $this -> hasMany(Image::class);
    }
    public function categories(){
        return $this -> belongsToMany(Category::class);
    }

}
