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
                $output = '<a title="Edit" edit_id="'.$data['id'].'" href="#" class="btn btn-sm btn-warning edit_product_tag"><i class="fas fa-edit text-white"></i></a>';
                return $output;
            })->make(true);
        }

        return view('backend.product.tag.index');


    }

    /**
     * Product Tag Add by ajax
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

    /**
     * Product Tag edit by ajax
     */
    public function editProductTagByAjax($id){

        $data   =   ProductTag::findOrFail($id);
        return $data;

    }

    /**
     * Product Tag update by ajax
     */
    public function updateProductTagByAjax(Request $request, $id){

        $data = ProductTag::findOrFail($id);
        if($data){
            $this->validate($request, [
                'name' => 'required'
            ]);

            $data->name = $request->name;
            $data->slug = $this->getSlug($request->name);
            $data->update();

            return "Tag updated successfully :) ";
        }else {
            return "Data not found!";
        }

    }


}
