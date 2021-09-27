<?php

namespace App\Http\Controllers;

use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\ProductCategory;
use App\Models\Backend\Product\ProductTag;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Product::where('trash', false)->where('status', true)->latest()->get();
        return view('backend.product.index', [
            'all_data' => $all_data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_cats   =   ProductCategory::where("status", true)->where('trash', false)->where('parent', null)->get();
        $all_tags   =   ProductTag::where("status", true)->where('trash', false)->get();
        $all_brnd   =   Brand::where("status", true)->where('trash', false)->get();
        return view('backend.product.create', [
            'all_cats'      => $all_cats,
            'all_tags'      => $all_tags,
            'all_brnd'      => $all_brnd,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        // ]);

        // Variable product size
        $size = [];
        $i = 0;
        if(isset($request->sizename)){
            foreach($request->sizename as $p_sise){
                array_push($size, [
                    'size'          => $p_sise,
                    'price'         => $request->sizeprice[$i],
                    'sale_price'    => $request->sizesaleprice[$i],
                ]);

                $i++;
            }
        }

        $size_data = json_encode($size);

        // Variable product color
        $color  = [];
        $j  = 0;
        if(isset($request->colorname)){
            foreach($request->colorname as $p_color){
                array_push($color, [
                    'color'         => $p_color,
                    'price'         => $request->colorprice[$j],
                    'sale_price'    => $request->colorsaleprice[$j]
                ]);

                $j++;
            }
        }
      $color_data = json_encode($color);


        
        Product::create([
            'name'          => $request->name,
            'slug'          => $this->getSlug($request->name),
            'regular_price' => $request->price,
            'sale_price'    => $request->sale_price,
            'stock'         => $request->quantity,
            'desc'          => $request->desc,
            'srt_desc'      => $request->short_desc,
            'size'          => $size_data,
            'color'         => $color_data,
        ]);

        return redirect()->back()->with('success', 'Product added successfully ): ');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Product  $product
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $data = App\Models\Product::find($id);
    //     return view('view.show', [
    //         'data' => $data
    //     ]);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Product  $product
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $data = App\Models\Product::find($id);
    //     return view('view.edit', [
    //         'data' => $data
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Product  $product
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     $data = App\Models\Product::find($id);

    //     if($data){
    //         $this->validate($request, [
    //             'name' => 'required',
    //         ]);

    //         $data->name = $request->name;
    //         $data->update();

    //         return redirect()->back()->with('success', 'Data added successfully ): ');
    //     }else {
    //         return redirect()->back()->with('error', 'Sorry, Not found data! ');
    //     }
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Product  $product
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Request $request)
    // {
    //     $data = App\Models\Product::find($request->id);
    //     if($data){

    //         $data->delete();

    //          return redirect()->back()->with('success', 'Data deleted successfully ): ');
    //     }else {
    //         return redirect()->back()->with('error', 'Sorry, Not found data! ');
    //     }
    // }


    // /**
    // *
    // *   Status update method
    // */
    // public function statusUpdate(Request $request){
    //     $data = Product::find($request->id);
    //     if($data){
    //         $data->status = status;
    //         $data->update;

    //         return redirect()->back()->with('success', 'Status updated successfully ): ');
    //     }else {
    //         return redirect()->back()->with('error', 'Sorry, Not found data! ');
    //     }
    // }


    // /**
    // *
    // *   Trash list page method
    // */
    // public function trashList(){
    //     $all_data = Product::where('trash', true)->latest()->get();

    //     return view('view.trash-list', [
    //         'all_data' => $all_data
    //     ]);
    // }


    // /**
    // *
    // *   Trash update method
    // */
    // public function statusUpdate(Request $request){
    //     $data = Product::find($request->id);
    //     if($data){
    //         $data->status = trash;
    //         $data->update;

    //         return redirect()->back()->with('success', 'Trash updated successfully ): ');
    //     }else {
    //         return redirect()->back()->with('error', 'Sorry, Not found data! ');
    //     }
    // }

}
