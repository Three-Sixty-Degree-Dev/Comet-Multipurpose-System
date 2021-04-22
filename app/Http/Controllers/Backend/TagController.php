<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tag::withCount('posts')->where('trash', false)->orderBy('id', 'desc')->get();
        $published = Tag::where('trash', false)->get()->count();
        $trash = Tag::where('trash', true)->get()->count();
        return view('backend.post.tag.index', [
            'all_data' => $data,
            'published' => $published,
            'trash' => $trash,
        ]);
    }

    //tag trash page
    public function tagTrash(){
        $data = Tag::where('trash', true)->orderBy('id', 'desc')->get();
        $published = Tag::where('trash', false)->get()->count();
        $trash = Tag::where('trash', true)->get()->count();
        return view('backend.post.tag.trash', [
            'all_data' => $data,
            'published' => $published,
            'trash' => $trash,
        ]);
    }

    //tag trash update
    public function tagTrashUpdate($id){
        $tag_data = Tag::find($id);
        if($tag_data->trash == false){
            $tag_data->trash = true;
            $tag_data->update();
            return redirect()->back()->with('warning', 'Trash updated successfully ):');
        }else {
            $tag_data->trash = false;
            $tag_data->update();
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
            'name' => "required | unique:tags,name"
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => $this->getSlug($request->name),
        ]);
        return redirect()->route('tag.index')->with('success', 'Tag added successfully ):');
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
        $tag_edit = Tag::find($id);
        return [
            'id' => $tag_edit->id,
            'name' => $tag_edit->name,
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
        $tag_update = Tag::find($request->id);
        if($tag_update != NULL){
            $this->validate($request, [
                'name' => "required | unique:tags,name,".$request->id,
            ]);

            $tag_update->name = $request->name;
            $tag_update->slug = $this->getSlug($request->name);
            $tag_update->update();
            return redirect()->route('tag.index')->with('success', 'Tag updated successfully ):');
        }else{
            return redirect()->route('tag.index')->with('error', 'Sorry! No data found');
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
     * Tag delete
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tagDelete(Request $request){
        $tag_info = Tag::find($request->id);
        if($tag_info != NULL){
            $tag_info->delete();
            return redirect()->route('tag.index')->with('success', 'Tag deleted successfully ):');
        }else {
            return redirect()->route('tag.index')->with('error', 'Sorry! No data found');
        }
    }

    /**
     * Tag inactive
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tagUpdatedInactive($id){
        $tag_info = Tag::find($id);
        if($tag_info != NULL){
            $tag_info->status = false;
            $tag_info->update();
        }else{
            return redirect()->route('tag.index')->with('error', 'Sorry!, no data available');
        }
    }

    /**
     * Tag active
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tagUpdatedActive($id){
        $tag_info = Tag::find($id);
        if($tag_info != NULL){
            $tag_info->status = true;
            $tag_info->update();
        }else{
            return redirect()->route('tag.index')->with('error', 'Sorry!, no data available');
        }
    }
}
