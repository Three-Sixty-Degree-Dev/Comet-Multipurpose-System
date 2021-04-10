<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
        return view('frontend.blog.blog-single', [
            'data' => $data
        ]);
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
}
