<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    //show blog page
    public function showBlogPage(){
        $all_data = Post::where('status', true)->where('trash', false)->orderBy('id', 'desc')->paginate(5);
        return view('frontend.blog.blog', [
            'all_data' => $all_data
        ]);
    }

    //single blog page
    public function singleBlogPage($slug){
        $data = Post::where('slug', $slug)->first();
        //single blog post view count
        $this->viewCount($data->id);
        return view('frontend.blog.blog-single', [
            'data' => $data
        ]);
    }

    //single blog post view count
    private function viewCount($post_id){
        $single_post = Post::find($post_id);
        $old_views = $single_post->views;
        $single_post->views = $old_views + 1;
        $single_post->update();
    }

    //blog category wise search
    public function blogCategoryWiseSearch($slug){
        $data = Category::where('slug', $slug)->first();
        return view('frontend.blog.blog-category-wise-search', [
            'all_data' => $data
        ]);
    }

    //blog tag wise search
    public function blogTagWiseSearch($slug){
        $data = Tag::where('slug', $slug)->first();
        return view('frontend.blog.blog-tag-wise-search', [
            'all_data' => $data
        ]);
    }

    //blog search
    public function blogSearch(Request $request){
        $search = $request->search;
        $data = Post::where('title', 'like', '%'.$search.'%')->orWhere('content', 'like', '%'.$search.'%')->get();
        return view('frontend.blog.search', [
            'all_data' => $data
        ]);
    }

    //single user blog search
    public function singleUserBlog($id){
        $user = User::find($id);
        $data = Post::where('user_id', $user->id)->where('status', true)->where('trash', false)->orderBy('id', 'desc')->paginate(5);
        return view('frontend.blog.single-user-create-blog', [
            'all_data' => $data
        ]);
    }
}
