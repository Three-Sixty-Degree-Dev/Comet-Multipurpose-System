<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // check ajax request by yjra datatable
        if( request() -> ajax() ){

            return datatables()->of(ProductCategory::where('trash', false)->latest()->get())->addColumn('action', function($data){
                $output = '<a title="Edit" edit_id="'.$data['id'].'" href="#" class="btn btn-sm btn-warning edit_brand"><i class="fas fa-edit text-white"></i></a>';
                return $output;
            })->rawColumns(['action'])->make(true);


        }


        return view('backend.product.category.index');

    }


    /**
     * Display a category trash list
     */
    public function categoryTrashList(){

        // check ajax request by yjra datatable
        if( request() -> ajax() ){

            return datatables()->of(ProductCategory::where('trash', true)->latest()->get())->addColumn('action', function($data){
                $output = '<form style="display: inline;" action="#" method="POST" id="category_delete_form"><input type="hidden" name="id" id="delete_product_category" value="'.$data['id'].'"><button type="submit" class="btn btn-sm ml-1 btn-danger" ><i class="fa fa-trash"></i></button></form>';
                return $output;
            })->rawColumns(['action'])->make(true);

        }

        return view('backend.product.category.trash');

    }


    /**
     * Fetch category all data by ajax
     */
    public function allProductCategoryByAjax(){

        $catego = ProductCategory::where('status', true)->orderBy('name', 'ASC')->get();
        $level1 = ProductCategory::where('status', true)->where('level', 1)->where('parent', null)->orderBy('name', 'ASC')->get();
        $level2 = ProductCategory::where('status', true)->where('level', 2)->orderBy('name', 'ASC')->get();
        $level3 = ProductCategory::where('status', true)->where('level', 3)->orderBy('name', 'ASC')->get();
        $level4 = ProductCategory::where('status', true)->where('level', 4)->orderBy('name', 'ASC')->get();
        $level5 = ProductCategory::where('status', true)->where('level', 5)->orderBy('name', 'ASC')->get();

        return [
            'catego' => $catego,
            'level1' => $level1,
            'level2' => $level2,
            'level3' => $level3,
            'level4' => $level4,
            'level5' => $level5,
        ];

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('view.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
        ]);

        $level_check = 0;
        if($request->parent_id){
            $level = ProductCategory::find($request->parent_id);
            $level_check = $level->level;
        }

        // check level
        if($level_check <= 4){

            // file upload
            $unique_image_name = $this->imageUpload($request, 'image', 'media/products/category/');

            if(empty($request->parent_id)){
                ProductCategory::create([
                    'name'          => $request->name,
                    'slug'          => $this->getSlug($request->name),
                    'icon'          => $request->icon,
                    'image'         => $unique_image_name
                ]);
            }else {
                $parent = ProductCategory::find($request->parent_id);

                ProductCategory::create([
                    'name'          => $request->name,
                    'slug'          => $this->getSlug($request->name),
                    'icon'          => $request->icon,
                    'image'         => $unique_image_name,
                    'level'         => ($parent->level+1),
                    'parent'        => $parent->id,
                ]);
            }

            return 'Data added successfully';

        }else {

            return  "Level up! level limit 5, don't try to level 5 up.";

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \Brand  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = Brand::find($id);
        // return view('view.show', [
        //     'data' => $data
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Brand  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $data = Brand::find($id);
        return $data;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Brand  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }


    /**
     * Brand update
     */
    public function brandUpdate(Request $request){
        $data = Brand::find($request->id);

        if($data){
            $this->validate($request, [
                'name' => 'required',
            ]);



            try {

                // file upload
                $unique_logo_file = '';
                if($request->hasFile('logo')){
                    $img = $request->file('logo');
                    $unique_logo_file = md5(time().rand()).'.'.$img->getClientOriginalExtension();
                    $img->move(public_path('media/products/brands/'), $unique_logo_file);
                    if(file_exists('media/products/brands/'.$data->logo) && !empty($data->logo)){
                        unlink('media/products/brands/'.$data->logo);
                    }
                }else {
                    $unique_logo_file = $data->logo;
                }

                $data->name = $request->name;
                $data->slug = $this->getSlug($request->name);
                $data->logo = $unique_logo_file;
                $data->update();

                return  'Data updated successfully ):';
            } catch (\Throwable $th) {
                return  'Data not update successfully';
            }


        }else {
            return 'Sorry, Not found data! ';
        }

    }


    /**
     * Category Delete by yajra table
     */
    public function categoryDelete(Request $request){
        $delete_id = $request->id;
        $data = ProductCategory::find($delete_id);

        try {

            if($data){
                $result = $data->delete();
                if($result){

                    if(file_exists('media/products/category/'.$data->image)){
                        unlink('media/products/category/'.$data->image);
                    }
                    return 'Category deleted ): ';
                }

            }

        } catch (\Throwable $th) {
            return 'Category deleted failed badly!';
        }
    }

    /**
     * Category delete by wordpress structure
     */
    public function productCategoryDeleteByAjax($id){

        $data = ProductCategory::find($id);

        try {

            if($data){

                if($data->parent == null || $data->parent == 0){


                    $child_cat = $data->parentCat;

                    foreach($child_cat as $ch){
                        $parent_child         = ProductCategory::find($ch->id);
                        $parent_child->level  = 1;
                        $parent_child->parent = null;
                        $parent_child->update();

                        $child = $parent_child->parentCat;
                        foreach($child as $cl){
                            $this->findChild($cl->id);
                        }
                    }



                    $result = $data->delete();
                    if($result){

                        if(file_exists('media/products/category/'.$data->image)){
                            unlink('media/products/category/'.$data->image);
                        }
                        return 'Category deleted ): ';
                    }


                }else if($data->parent != null || $data->parent != 0) {


                    $child_cat = $data->parentCat;

                    foreach($child_cat as $ch){
                        $parent_child         = ProductCategory::find($ch->id);
                        $parent_child->level  = ($parent_child->level - 1);
                        $parent_child->parent = $data->parent;
                        $parent_child->update();

                        $child = $parent_child->parentCat;
                        foreach($child as $cl){
                            $this->findChild($cl->id);
                        }
                    }



                    $result = $data->delete();
                    if($result){

                        if(file_exists('media/products/category/'.$data->image)){
                            unlink('media/products/category/'.$data->image);
                        }
                        return 'Category deleted ): ';
                    }

                }



            }

        } catch (\Throwable $th) {
            return 'Category deleted failed badly!';
        }

    }

    /**
     * Find the category delete child
     */
    public function findChild($id){
        $child = ProductCategory::where('id', $id)->get();

        foreach($child as $ch){
            $ch->level = $ch->level - 1;
            $ch->update();
        }
    }

    /**
     * Category edit by wp structure
     */
    public function productCategoryEditByAjax($id){

        $catego = ProductCategory::where('status', true)->where('id', $id)->first();
        $level1 = ProductCategory::where('status', true)->where('level', 1)->where('parent', null)->orderBy('name', 'ASC')->get();
        $level2 = ProductCategory::where('status', true)->where('level', 2)->orderBy('name', 'ASC')->get();
        $level3 = ProductCategory::where('status', true)->where('level', 3)->orderBy('name', 'ASC')->get();
        $level4 = ProductCategory::where('status', true)->where('level', 4)->orderBy('name', 'ASC')->get();
        $level5 = ProductCategory::where('status', true)->where('level', 5)->orderBy('name', 'ASC')->get();

        return [
            'catego' => $catego,
            'level1' => $level1,
            'level2' => $level2,
            'level3' => $level3,
            'level4' => $level4,
            'level5' => $level5,
        ];
    }

    /**
     * Category update by wp structure
     */
    public function productCategoryUpdateByAjax(Request $request){

        $data = ProductCategory::where('id', $request->id)->first();

        if($data){
            $this->validate($request, [
                'name' => 'required',
            ]);

            // file upload
            $unique_image_name = $this->updateImageUpload($request, 'image', 'media/products/category/', $data->image);

            $icon_name = '';
            if(empty($request->icon) && $request->icon == null){
               $icon_name = $data->icon;
            }else {
                $icon_name = $request->icon;
            }


            // not change parent id, then direct update
            if($request->parent_id == $data->parent){

                $data->name          = $request->name;
                $data->slug          = $this->getSlug($request->name);
                $data->icon          = $icon_name;
                $data->image         = $unique_image_name;
                $data->update();

                return "Category Updated successfully ):";

            }else {


                // parent id not found
                if($request->parent_id == null || $request->parent_id == 0){

                    $child_cat = $data->parentCat;

                    foreach($child_cat as $ch){
                        $parent_child         = ProductCategory::find($ch->id);
                        $parent_child->level  = ($parent_child->level - 1);
                        $parent_child->parent = $data->parent;
                        $parent_child->update();

                        $child = $parent_child->parentCat;
                        foreach($child as $cl){
                            $this->findChild($cl->id);
                        }
                    }


                    $data->name          = $request->name;
                    $data->slug          = $this->getSlug($request->name);
                    $data->icon          = $icon_name;
                    $data->parent        = null;
                    $data->level         = 1;
                    $data->image         = $unique_image_name;
                    $data->update();

                    return "Category Updated successfully ):";

                }else {

                     // parent id has found
                    $child_cat = $data->parentCat;

                    foreach($child_cat as $ch){
                        $parent_child         = ProductCategory::find($ch->id);
                        $parent_child->level  = ($parent_child->level - 1);
                        $parent_child->parent = $data->parent;
                        $parent_child->update();

                        $child = $parent_child->parentCat;
                        foreach($child as $cl){
                            $this->findChild($cl->id);
                        }
                    }

                    $category = ProductCategory::where('id', $request->parent_id)->first();


                    $data->name          = $request->name;
                    $data->slug          = $this->getSlug($request->name);
                    $data->icon          = $icon_name;
                    $data->parent        = $request->parent_id;
                    $data->level         = ($category->level+1);
                    $data->image         = $unique_image_name;
                    $data->update();

                    return "Category Updated successfully ):";

                }




            }


            // $this->validate($request, [
            //     'name' => 'required',
            // ]);

            // $level_check = 0;
            // if($request->parent_id){
            //     $level = ProductCategory::find($request->parent_id);
            //     $level_check = $level->level;
            // }

            // // check level
            // if($level_check <= 4){

            //     // file upload
            //     $unique_image_name = '';
            //     $unique_image_name = $this->imageUpload($request, 'image', 'media/products/category/');

            //     if(empty($request->parent_id)){
            //         ProductCategory::create([
            //             'name'          => $request->name,
            //             'slug'          => $this->getSlug($request->name),
            //             'icon'          => $request->icon,
            //             'image'         => $unique_image_name
            //         ]);
            //     }else {
            //         $parent = ProductCategory::find($request->parent_id);

            //         ProductCategory::create([
            //             'name'          => $request->name,
            //             'slug'          => $this->getSlug($request->name),
            //             'icon'          => $request->icon,
            //             'image'         => $unique_image_name,
            //             'level'         => ($parent->level+1),
            //             'parent'        => $parent->id,
            //         ]);
            //     }

            //     return 'Data added successfully';

            // }else {

            //     return  "Level up! level limit 5, don't try to level 5 up.";

            // }

        }

    }



    /**
    *
    *   Status update method
    */
    public function categoryStatusUpdated($id, $val){

        $data = ProductCategory::find($id);

        if($val == 1){
            $data->status = false;
            $data->update();
            return 'Category Inactive Succcessfully ): ';
        }else {
            $data->status = true;
            $data->update();
            return  'Category Active Succcessfully ): ';
        }

    }


    /**
    *
    *   Trash update method
    */
    public function categoryTrashUpdated($id, $val){
        $data = ProductCategory::find($id);

        if($val == 1){
            $data->trash = false;
            $data->update();
            return 'Category Remove Trash Succcessfully ): ';
        }else {
            $data->trash = true;
            $data->update();
            return  'Category Trash Succcessfully ): ';
        }

    }


    // /**
    // *
    // *   Trash list page method
    // */
    // public function trashList(){
    //     $all_data = Brand::where('trash', true)->latest()->get();

    //     return view('view.trash-list', [
    //         'all_data' => $all_data
    //     ]);
    // }


    // /**
    // *
    // *   Trash update method
    // */
    // public function brandTrashUpdate(Request $request){
    //     $data = Brand::find($request->id);
    //     if($data){
    //         $data->status = $request->trash;
    //         $data->update;

    //         return redirect()->back()->with('success', 'Trash updated successfully ): ');
    //     }else {
    //         return redirect()->back()->with('error', 'Sorry, Not found data! ');
    //     }
    // }
}
