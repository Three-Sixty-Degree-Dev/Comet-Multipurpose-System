<?php

namespace App\Models\Backend\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function parentCat(){
        return $this->hasMany('App\Models\Backend\Product\ProductCategory', 'parent');
    }

}
