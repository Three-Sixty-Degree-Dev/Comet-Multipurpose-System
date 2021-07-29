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

            // return datatables() -> of(Brand::latest()->get()) -> addColumn('action'. function($data){

            //     $output = '<a title="Edit" edit_id="" href="" class="btn btn-sm btn-warning edit_cats"><i class="fas fa-edit text-white"></i></a>';
            //     $output .= '<a title="Trash" class="btn btn-sm btn-danger" href=""><i class="fa fa-trash"></i></a>';

            //     return $output;

            // }) -> rawColumns(['action']) -> make(true);

            return datatables()->of(Brand::latest()->get())->addColumn('action', function($data){
                $output = '<a title="Edit" edit_id="" href="" class="btn btn-sm btn-warning edit_cats"><i class="fas fa-edit text-white"></i></a>';
                $output .= '<a title="Trash" class="btn btn-sm ml-1 btn-danger" href=""><i class="fa fa-trash"></i></a>';
                return $output;
            })->rawColumns(['action'])->make(true);
        }


        return view('backend.product.brand.index');

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
        if($request->hasFile('logo')){
            $img = $request->file('logo');
            $unique_logo_file = md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img->move(public_path('media/brand/'), $unique_logo_file);
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
     * Remove the specified resource from storage.
     *
     * @param  \Brand  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $data = Brand::find($request->id);
        // if($data){

        //     $data->delete();

        //      return redirect()->back()->with('success', 'Data deleted successfully ): ');
        // }else {
        //     return redirect()->back()->with('error', 'Sorry, Not found data! ');
        // }
    }


    // /**
    // *
    // *   Status update method
    // */
    // public function brandStatusUpdate(Request $request){
    //     $data = Brand::find($request->id);
    //     if($data){
    //         $data->status = $request->status;
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
