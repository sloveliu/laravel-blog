<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogPost;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function indexWithCategory(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function indexWithTag(Tag $tag)
    {
        $posts = $tag->posts;
        return view('posts.index', ['posts' => $posts]);
    }

    public function admin()
    {
        $posts = Post::all();
        return view('posts.admin', ['posts' => $posts]);
    }

    public function create()
    {
        $post = new Post;
        $categories = Category::all();
        return view('posts.create', ['post' => $post, 'categories' => $categories]);
    }

    // 方法一、直接寫 validate 的規則
    // public function store(Request $request) {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //     ]);
    // 方法二、透過 StoreBlogPost 來驗證資料，完成再執行 store 方法
    public function store(StoreBlogPost $request)
    {
        $post = new Post;
        $post->fill($request->all());
        // 取得用戶 id 一起寫進 db
        $post->user_id = Auth::id();
        $post->save();

        // 這樣寫如果 tags 是空的會有問題
        // $tags = explode(',', $request->tags);
        $tags = explode(',', $request->input('tags', ''));
        $this->addTagsToPost($tags, $post);

        return redirect('/posts/admin');
    }

    // 透過 Post model，laravel 會自動去處理資料
    public function show(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.show', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    public function showByAdmin(Post $post)
    {
        return view('posts.showByAdmin', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(StoreBlogPost $request, Post $post)
    {
        $post->fill($request->all());
        $post->save();

        // 更新時先解除與 tag 的關聯，之後再加回新的 tag 關聯
        $post->tags()->detach();

        // 這樣寫如果 tags 是空的會有問題
        // $tags = explode(',', $request->tags);
        $tags = explode(',', $request->input('tags', ''));
        $this->addTagsToPost($tags, $post);

        return redirect('/posts/admin');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        // return redirect('/posts/admin');
    }

    private function addTagsToPost($tags, $post)
    {
        foreach ($tags as $tag) {
            // firstOrCreate 沒有資料就建立
            $model = Tag::firstOrCreate(['name' => $tag]);
            // post 找到 tags attach 建立關係
            $post->tags()->attach($model->id);
        }
    }
}
