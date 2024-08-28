@extends('layouts.app')

@section('page-title')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-uppercase">Blog Admin Panel</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Blog Admin Panel</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="mb-3 text-right">
                <a href="/posts/create" class="btn btn-primary">create post</a>
            </div>
            <ul class="list-group">
                @foreach ($posts as $key => $post)
                    <li class="list-group-item claerfix">
                        <div class="float-left">
                            <div class="title">{{ $post->title }}</div>
                            {{-- 因在 Post.php 有定義 $this->belongsTo('App\User'); 所以可以用 post 取得 user 表的名稱 --}}
                            <small class="author">{{ $post->user->name }}</small>
                        </div>
                        <span class="float-right">
                            <a href="/posts/show/{{ $post->id }}" class="btn btn-secondary">View</a>
                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="deletePost({{ $post->id }})">Delete</button>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{-- delete 方法 1 透過 form --}}
    {{-- <form id="deleteForm" action="/posts/id" method="post">
        <input type="hidden" name="_method" value="delete">
        @csrf
    </form> --}}
@endsection
