<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'p_i',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products(){
        return $this -> hasMany(Product::class);
    }
}
