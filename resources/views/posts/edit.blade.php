@extends('layouts.frontend')

@section('page-title')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-uppercase">Edit Post</h4>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a>
                        </li>
                        <li class="active"><a href="/posts/admin">Blog Admin Panel</a>
                        </li>
                        <li class="active">Edit Post</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <div class="page-content">
            {{-- html form 不支援 put --}}
            <form action="/posts/{{ $post->id }}" method="post">
                @csrf
                {{-- 所以透過 laravel 的 _method 來達到 put 的效果 --}}
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="titleInput">Title</label>
                    <input type="text" class="form-control" name="title" id="titleInput" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="contentInput">Content</label>
                    <textarea id="contentInput" type="password" class="form-control" name="content" row="8" cols="80">{{ $post->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
            </form>
        </div>
    </div>
@endsection