<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::where('trash', false)->orderBy('id', 'desc')->get();
        $published = Post::where('trash', false)->get()->count();
        $trash = Post::where('trash', true)->get()->count();
        return view('backend.post.index', [
            'all_data' => $data,
            'published' => $published,
            'trash' => $trash,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postTrashShow()
    {
        $data = Post::where('trash', true)->orderBy('id', 'desc')->get();
        $published = Post::where('trash', false)->get()->count();
        $trash = Post::where('trash', true)->get()->count();
        return view('backend.post.trash', [
            'all_data' => $data,
            'published' => $published,
            'trash' => $trash,
        ]);
    }

    //post trash update
    public function postTrashUpdate($id){
        $trash_data = Post::find($id);
        if($trash_data->trash == false){
            $trash_data->trash = true;
            $trash_data->update();
            return redirect()->back()->with('warning','Trash updated successfully ):');
        }else {
            $trash_data->trash = false;
            $trash_data->update();
            return redirect()->back()->with('success','Trash data recover successfully ):');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_cats = Category::all();
        $all_tags = Tag::all();
        return view('backend.post.create', [
            'all_cats' => $all_cats,
            'all_tags' => $all_tags,
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
        $this->validate($request, [
            'title' => "required | unique:posts,title",
            'content' => "required"
        ]);

        //post image
        $image_unique_name = '';
        if($request->hasFile('post_image')){
            $image = $request->file('post_image');
            $image_unique_name = md5(time().rand()) .'.'. $image->getClientOriginalExtension();
            $extension = pathinfo($image_unique_name, PATHINFO_EXTENSION);
            $valid_extesion = array('jpg', 'jpeg', 'png', 'gif');
            if(in_array($extension, $valid_extesion)){
                $image->move(public_path('media/posts/'), $image_unique_name);
            }else {
                return redirect()->back()->with('error', 'Invalid file format!');
            }
        }

        //post gallery image
        $gallery_image_u_n = [];
        $gallery_image = $request->hasFile('post_gallery_image');
        if($gallery_image != NULL){
            $g_image = $request->file('post_gallery_image');
            foreach ($g_image as $image){
                $gallery_image_unique_name = md5(time().rand()) .'.'. $image->getClientOriginalExtension();
                $extension = pathinfo($gallery_image_unique_name, PATHINFO_EXTENSION);
                $valid_extesion = array('jpg', 'jpeg', 'png', 'gif');
                if(in_array($extension, $valid_extesion)){
                    array_push($gallery_image_u_n, $gallery_image_unique_name);
                    $image->move(public_path('media/posts/'), $gallery_image_unique_name);
                }else {
                    return redirect()->back()->with('error', 'Invalid file format!');
                }
            }
        }

        $post_featured = [
            'post_type' => $request->post_type,
            'post_image' => $image_unique_name,
            'post_gallery' => $gallery_image_u_n,
            'post_audio' => $request->post_audio,
            'post_video' => $request->post_video,
        ];



        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'featured' => json_encode($post_featured),
            'content' => $request->content,
        ]);
        return redirect()->back()->with('success', 'Post added successfully ):');
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

    // Display the specified post
    public function singlePostView($id){
        $single_post = Post::find($id);

        $post_fet = json_decode($single_post->featured);

        return [
            'title' => $single_post->title,
            'slug' => $single_post->slug,
            'status' => $single_post->status,
            'content' => $single_post->content,
            'post_image' => $post_fet->post_image,
            'post_gallery' => $post_fet->post_gallery,
            'post_audio' => $post_fet->post_audio,
            'post_video' => $post_fet->post_video,
        ];
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
            $tag_update->slug = Str::slug($request->name);
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
     * post delete
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request){
        $post_info = Post::find($request->id);
        if($post_info != NULL){
            $post_jsn = json_decode($post_info->featured);

            //post image
            if(file_exists('media/posts/'.$post_jsn->post_image) AND !empty($post_jsn->post_image)){
                unlink('media/posts/'.$post_jsn->post_image);
            }
            //post gallery image
            foreach ($post_jsn->post_gallery as $gallery){
                if(file_exists('media/posts/'.$gallery) AND !empty($gallery)){
                    unlink('media/posts/'.$gallery);
                }
            }

            $post_info->delete();
            return redirect()->route('index')->with('success', 'Post deleted successfully ):');
        }else {
            return redirect()->route('index')->with('error', 'Sorry! No data found');
        }
    }

    /**
     * post inactive
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdatedInactive($id){
        $post_info = Post::find($id);
        if($post_info != NULL){
            $post_info->status = false;
            $post_info->update();
        }else{
            return redirect()->route('index')->with('error', 'Sorry!, no data available');
        }
    }

    /**
     * Post active
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdatedActive($id){
        $post_info = Post::find($id);
        if($post_info != NULL){
            $post_info->status = true;
            $post_info->update();
        }else{
            return redirect()->route('index')->with('error', 'Sorry!, no data available');
        }
    }
}
