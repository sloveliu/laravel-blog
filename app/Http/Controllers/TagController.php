<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        // 自動回 http status 200
    }
}
