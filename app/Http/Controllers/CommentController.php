<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(StoreComment $request)
    {
        $comment = new Comment();
        $comment->fill($request->all());
        if (Auth::check()) {
            $comment->user_id = Auth::id();
        }

        $comment->save();
        # redirect back
        return redirect()->back();
        // return redirect('/posts/' . $request->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     */

    public function update(StoreComment $request, Comment $comment)
    {
        $comment->fill($request->all());
        $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}
