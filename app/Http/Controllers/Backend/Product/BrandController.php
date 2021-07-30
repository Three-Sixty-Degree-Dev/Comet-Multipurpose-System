<?php

namespace App\Http\Controllers\Backend\Product;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Brand;

class BrandController extends Controller
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

            return datatables()->of(Brand::where('trash', false)->latest()->get())->addColumn('action', function($data){
                $output = '<a title="Edit" edit_id="'.$data.'" href="#" class="btn btn-sm btn-warning edit_brand"><i class="fas fa-edit text-white"></i></a>';
                return $output;
            })->rawColumns(['action'])->make(true);

        }


        return view('backend.product.brand.index');

    }


    /**
     * Display a brand trash list
     */
    public function brandTrashList(){

        // check ajax request by yjra datatable
        if( request() -> ajax() ){

            return datatables()->of(Brand::where('trash', true)->latest()->get())->addColumn('action', function($data){
                $output = '<form style="display: inline;" action="#" method="POST" id="brand_delete_form"><input type="hidden" name="id" id="delete_brand" value="'.$data['id'].'"><button type="submit" class="btn btn-sm ml-1 btn-danger" ><i class="fa fa-trash"></i></button></form>';
                return $output;
            })->rawColumns(['action'])->make(true);

        }

        return view('backend.product.brand.trash');

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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'logo' => 'required',
        ]);

        // file upload
        $unique_logo_file = '';
        if($request->hasFile('logo')){
            $img = $request->file('logo');
            $unique_logo_file = md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img->move(public_path('media/products/brands/'), $unique_logo_file);
        }

        Brand::create([
            'name'      => $request->name,
            'slug'      => $this->getSlug($request->name),
            'logo'      => $unique_logo_file
        ]);

        return response()->json([
            'success' => 'Data added successfully'
        ]);

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
    public function edit($id)
    {
        // $data = Brand::find($id);
        // return view('view.edit', [
        //     'data' => $data
        // ]);
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

        // $data = Brand::find($id);

        // if($data){
        //     $this->validate($request, [
        //         'name' => 'required',
        //     ]);

        //     $data->name = $request->name;
        //     $data->update();

        //     return redirect()->back()->with('success', 'Data added successfully ): ');
        // }else {
        //     return redirect()->back()->with('error', 'Sorry, Not found data! ');
        // }
    }


    /**
     * Brand Delete
     */
    public function brandDelete(Request $request){
        $delete_id = $request->id;
        $data = Brand::find($delete_id);

        try {

            if($data){
                $result = $data->delete();
                if($result){

                    if(file_exists('media/products/brands/'.$data->logo)){
                        unlink('media/products/brands/'.$data->logo);
                    }

                }

            }

        } catch (\Throwable $th) {
            return 'Brand deleted failed badly!';
        }
    }


    /**
    *
    *   Status update method
    */
    public function brandStatusUpdated($id, $val){
        $data = Brand::find($id);

        if($val == 1){
            $data->status = false;
            $data->update();
            return 'Brand Inactive Succcessfully ): ';
        }else {
            $data->status = true;
            $data->update();
            return  'Brand Active Succcessfully ): ';
        }

    }


    /**
    *
    *   Trash update method
    */
    public function brandTrashUpdated($id, $val){
        $data = Brand::find($id);

        if($val == 1){
            $data->trash = false;
            $data->update();
            return 'Brand Remove Trash Succcessfully ): ';
        }else {
            $data->trash = true;
            $data->update();
            return  'Brand Trash Succcessfully ): ';
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
