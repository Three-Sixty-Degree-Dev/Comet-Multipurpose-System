<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product\ProductTag;

class TagController extends Controller
{

    /**
     * all tag get by yajra table
     */
    public function allProductTagByAjax(){

        if( request()->ajax() ){
            return datatables()->of(ProductTag::latest()->get())->make(true);
        }

        return view('backend.product.tag.index');


    }

    /**
     * Product Add by ajax
     */
    public function addProductTagByAjax(Request $request){

        $this->validate($request, [
            'name' => 'required'
        ]);

        ProductTag::create([
            'name' => $request->name,
            'slug' => $this->getSlug($request->name)
        ]);

        return 'Tag added successfully :) ';

    }


}
