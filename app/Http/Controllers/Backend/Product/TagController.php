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
            return datatables()->of(ProductTag::latest()->get())->addColumn('action', function($data){
                $output = '<a title="Edit" edit_id="'.$data['id'].'" href="#" class="btn btn-sm btn-warning edit_brand"><i class="fas fa-edit text-white"></i></a>';
                return $output;
            })->make(true);
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
