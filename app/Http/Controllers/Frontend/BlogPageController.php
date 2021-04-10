<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
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
}
