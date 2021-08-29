<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product\ProductTag;

class TagController extends Controller
{

    /**
     * grab all tag get by yajra table
     */
    public function allProductTagByAjax(){

        if( request()->ajax() ){
            return datatables()->of(ProductTag::where('trash', false)->latest()->get())->addColumn('action', function($data){
                $output = '<a title="Edit" edit_id="'.$data['id'].'" href="#" class="btn btn-sm btn-warning edit_product_tag"><i class="fas fa-edit text-white"></i></a>';
                return $output;
            })->make(true);
        }

        return view('backend.product.tag.index');


    }

    /**
     * grab all trash tag by yajra table
     */
    public function allTrashProductTagByAjax(){

        if( request()->ajax() ){
            return datatables()->of(ProductTag::where('trash', 1)->latest()->get())->addColumn('action', function($data){
                $output = '<form class="d-inline" method="POST" id="product_tag_delete_form" delete_id="'.$data['id'].'"><button title="Delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>';
                return $output;
            })->make(true);
        }

        return view('backend.product.tag.trash');

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

    /**
     * Product Tag status update
     */
    public function statusUpdateProductTag($id, $value){

        $data = ProductTag::findOrFail($id);

        if($value == 1){
            $data->status = 0;
        }else if($value == 0){
            $data->status = 1;
        }

        $data->update();
        return 'Tag status updated successfully :) ';

    }

    /**
     * Proudct Tag trash update
     */
    public function trashUpdateProductTag($id, $value){

        $data = ProductTag::findOrFail($id);

        if($value == 1){
            $data->trash = 0;
        }else if($value == 0){
            $data->trash = 1;
        }

        $data->update();
        return 'Tag trash updated successfully';

    }

    /**
     * Proudct tag delete
     */
    public function deleteProductTag($id){
        ProductTag::findOrFail($id)->delete();
        return 'Tag deleted successfully :) ';
    }

}
