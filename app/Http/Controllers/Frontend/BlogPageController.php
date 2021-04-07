<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    //show blog page
    public function showBlogPage(){
        $all_data = Post::where('status', true)->get();
        return view('frontend.blog.blog', [
            'all_data' => $all_data
        ]);
    }
}
