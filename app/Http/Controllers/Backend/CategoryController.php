<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::withCount('posts')->where('trash', false)->orderBy('id', 'desc')->get();
        $published = Category::where('trash', false)->get()->count();
        $trash = Category::where('trash', true)->get()->count();
        return view('backend.post.category.index', [
            'all_data' => $data,
            'published' => $published,
            'trash' => $trash,
        ]);
    }

    //category trash page
    public function categoryTrash(){
        $data = Category::where('trash', true)->orderBy('id', 'desc')->get();
        $published = Category::where('trash', false)->get()->count();
        $trash = Category::where('trash', true)->get()->count();
        return view('backend.post.category.trash', [
            'all_data' => $data,
            'published' => $published,
            'trash' => $trash,
        ]);
    }

    //category trash update
    public function categoryTrashUpdate($id){
        $data = Category::find($id);
        if($data->trash == false){
            $data->trash = true;
            $data->update();
            return redirect()->back()->with('warning', 'Trash updated successfully ):');
        }else {
            $data->trash = false;
            $data->update();
            return redirect()->back()->with('success', 'Trash data recover successfully ):');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => "required | unique:categories,name"
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('category.index')->with('success', 'Category added successfully ):');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_edit = Category::find($id);
        return [
            'id' => $category_edit->id,
            'name' => $category_edit->name,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category_update = Category::find($request->id);
        if($category_update != NULL){
            $this->validate($request, [
                'name' => "required | unique:categories,name,".$request->id,
            ]);

            $category_update->name = $request->name;
            $category_update->slug = Str::slug($request->name);
            $category_update->update();
            return redirect()->route('category.index')->with('success', 'Category updated successfully ):');
        }else{
            return redirect()->route('category.index')->with('error', 'Sorry! No data found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Category delete
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function categoryDelete(Request $request){
        $category_info = Category::find($request->id);
        if($category_info != NULL){
            $category_info->delete();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully ):');
        }else {
            return redirect()->route('category.index')->with('error', 'Sorry! No data found');
        }
    }

    /**
     * Category inactive
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function categoryUpdatedInactive($id){
        $customer_info = Category::find($id);
        if($customer_info != NULL){
            $customer_info->status = false;
            $customer_info->update();
        }else{
            return redirect()->route('customer.index')->with('error', 'Sorry!, no data available');
        }
    }

    /**
     * Category active
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function categoryUpdatedActive($id){
        $customer_info = Category::find($id);
        if($customer_info != NULL){
            $customer_info->status = true;
            $customer_info->update();
        }else{
            return redirect()->route('customer.index')->with('error', 'Sorry!, no data available');
        }
    }
}
