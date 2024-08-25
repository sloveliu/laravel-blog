<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function admin()
    {
        $posts = Post::all();
        return view('posts.admin', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->fill($request->all());
        $post->save();
        return redirect('/posts');
    }

    // 透過 Post model，laravel 會自動去處理資料
    public function show(Post $post)
    {
        return view('posts.showByAdmin', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request,Post $post)
    {
        $post->fill($request->all());
        $post->save();
        return redirect('/posts/admin');
    }

    public function destroy(Post $post) {
        $post->delete();
        // return redirect('/posts/admin');
    }
}
