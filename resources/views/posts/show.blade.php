@extends('layouts.frontend')

@section('page-title')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-uppercase">Blog Single</h4>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a>
                        </li>
                        <li class="active"><a href="/posts">Blog</a>
                        </li>
                        <li class="active">Blog Single</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!--classic image post-->
                    <div class="blog-classic">
                        <div class="blog-post">
                            <div class="full-width">
                                @if (!$post->thumbnail)
                                    <img src="/assets/img/post/p12.jpg" alt="" />
                                @else
                                    <img src="{{ $post->thumbnail }}" alt="thumbnail">
                                @endif
                            </div>
                            <h4 class="text-uppercase"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h4>
                            <ul class="post-meta">
                                <li>
                                    <i class="fa fa-user"></i>posted by <a href="#">{{ $post->user->name }}</a>
                                </li>
                                @if ($post->category)
                                    <li>
                                        <i class="fa fa-folder-open"></i> <a href="/posts/category/{{ $post->category_id }}">{{ $post->category->name }}</a>
                                    </li>
                                @endif
                                <li>
                                    <i class="fa fa-comments"></i> <a href="#">{{ $post->comments->count() }}
                                        Comments</a>
                                </li>
                            </ul>
                            <p>{{ $post->content }}</p>
                            <div class="inline-block">
                                @if ($post->tags->count() > 0)
                                    <div class="widget-tags">
                                        <h6 class="text-uppercase">Tags </h6>
                                        @foreach ($post->tags as $tag)
                                            <a href="/posts/tag/{{ $tag->id }}">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="pagination-row">
                                    <div class="pagination-post">
                                        <div class="prev-post">
                                            <a href="@if ($prevPostId) /posts/{{ $prevPostId }} @else # @endif">
                                                <div class="arrow">
                                                    <i class="fa fa-angle-double-left"></i>
                                                </div>
                                                <div class="pagination-txt">
                                                    <span>Previous Post</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="post-list-link">
                                            <a href="/posts">
                                                <i class="fa fa-home"></i>
                                            </a>
                                        </div>
                                        <div class="next-post">
                                            <a href="@if ($nextPostId) /posts/{{ $nextPostId }} @else # @endif">
                                                <div class="arrow">
                                                    <i class="fa fa-angle-double-right"></i>
                                                </div>
                                                <div class="pagination-txt">
                                                    <span>Next Post</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--comments discussion section start-->
                                <div class="heading-title-alt text-left heading-border-bottom">
                                    <h4 class="text-uppercase">{{ $post->comments->count() }} Comments</h4>
                                </div>
                                <ul class="media-list comments-list m-bot-50 clearlist">
                                    @foreach ($post->comments as $comment)
                                        <li class="media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object comment-avatar" src="/assets/img/post/a1.png" alt="" width="50" height="50">
                                            </a>
                                            <div class="media-body">
                                                <div class="comment-info">
                                                    <div class="comment-author">
                                                        <a href="#">{{ $comment->name }}</a>
                                                        @if ($comment->user && $comment->user->id == Auth::id())
                                                            <button class="btn btn-default" onclick="toggleCommentEdit(event)">edit</button>
                                                            <button class="btn btn-danger" data-action="/comments/{{ $comment->id }}" onclick="deleteComment(event)">delete</button>
                                                        @endif
                                                    </div>
                                                    {{-- 格式參考 https://www.php.net/manual/en/function.date.php --}}
                                                    {{-- {{ $comment->created_at->format('Y F d, G:i') . 'at ' . $comment->created_at->format('G:i') }} --}}
                                                    {{ $comment->created_at->format('Y F d G:i') }}
                                                    <a href="#"><i class="fa fa-comment-o"></i>Reply</a>
                                                </div>
                                                <div class="comment-body">
                                                    <p class="comment-content">{{ $comment->comment }}</p>
                                                    <form action="/comments/{{ $comment->id }}" method="post">
                                                        <input type="hidden" name="post_id" value="{{ $comment->post->id }}">
                                                        <input type="hidden" name="name" value="{{ $comment->name }}">
                                                        <input type="text" name="comment" value="{{ $comment->comment }}">
                                                        <button class="comment-update">update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <!--comments discussion section end-->
                                <!--comments  section start-->
                                <div class="heading-title-alt text-left heading-border-bottom">
                                    <h4 class="text-uppercase">Leave a Comments</h4>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="post" action="/comments" id="form" role="form" class="blog-comments">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <!-- Name -->
                                            @if (Auth::check())
                                                <input type="text" name="name" id="name" class=" form-control" placeholder="Name *" maxlength="100" value="{{ Auth::user()->name }}" required>
                                            @else
                                                <input type="text" name="name" id="name" class=" form-control" placeholder="Name *" maxlength="100" required>
                                            @endif
                                        </div>
                                        <!-- Comment -->
                                        <div class="form-group col-md-12">
                                            <textarea name="comment" id="text" class=" form-control" rows="6" placeholder="Comment" maxlength="400" required></textarea>
                                        </div>
                                        <!-- Send Button -->
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-small btn-dark-solid ">
                                                Send comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!--comments  section end-->
                            </div>
                        </div>
                        <!--classic image post-->
                    </div>
                    <div class="col-md-4">
                        @include('posts._sidebar')
                    </div>
                </div>
            </div>
        </div>
    @endsection
