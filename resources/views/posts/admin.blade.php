@extends('layouts.frontend')

@section('page-title')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-uppercase">Blog Admin Panel</h4>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a>
                        </li>
                        <li class="active">Blog Admin Panel</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="col-2 clearfix toolbox">
                <a href="/posts/create" class="btn btn-primary pull-right">create post</a>
            </div>
            <ul class="list-group">
                @foreach ($posts as $key => $post)
                    <li class="list-group-item claerfix">
                        {{ $post->title }}
                        <span class="pull-right">
                            <a href="/posts/show/{{ $post->id }}" class="btn btn-default">View</a>
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