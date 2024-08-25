@extends('layouts.frontend')

@section('page-title')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-uppercase">Create Post</h4>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a>
                        </li>
                        <li class="active"><a href="/posts/admin">Blog Admin Panel</a>
                        </li>
                        <li class="active">Create Post</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <div class="page-content">
            <form action="/posts" method="post">
                @csrf
                <div class="form-group">
                    <label for="titleInput">Title</label>
                    <input type="text" class="form-control" name="title" id="titleInput">
                </div>
                <div class="form-group">
                    <label for="contentInput">Content</label>
                    <textarea id="contentInput" type="password" class="form-control" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
            </form>
        </div>
    </div>
@endsection
