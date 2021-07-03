<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Comment::latest()->get();
        return view('view.index', [
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    /**
     * Blog post comments store
     */
    public function postCommentStore(Request $request){
        Comment::create([
            'post_id'   =>  $request->post_id,
            'user_id'   =>  Auth::user()->id,
            'text'      =>  $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully ): ');
    }

    /**
     * Blog post reply comments store
     */
    public function postCommentReplyStore(Request $request){
        Comment::create([
            'post_id'      =>  $request->post_id,
            'user_id'      =>  Auth::user()->id,
            'comment_id'   =>  $request->comment_id,
            'text'         =>  $request->reply_comment,
        ]);

        return redirect()->back()->with('success', 'Comment reply added successfully ): ');
    }
}
