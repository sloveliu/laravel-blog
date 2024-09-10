@php
    // 加上 \ 才會從專案最底層開始找，否則從當前目錄找
    $categories = \App\Category::all();
    // tag 有文章的才取出，posts 關聯定義在 Tag model。withCount 計算 posts 數量會自動生成 property: posts_count
    $tags = \App\Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
    $latestPosts = \App\Post::orderBy('created_at', 'desc')->take(5)->get();
    $latestComments = \App\Comment::orderBy('created_at', 'desc')->take(5)->get();
@endphp
<!--latest post widget-->
<div class="widget">
    <div class="heading-title-alt text-left heading-border-bottom">
        <h6 class="text-uppercase">latest post</h6>
    </div>
    <ul class="widget-latest-post">
        @foreach ($latestPosts as $key => $post)
            <li>
                <div class="thumb">
                    <a href="/posts/{{ $post->id }}">
                        @if ($post->thumbnail)
                            <img src="{{ $post->thumbnail }}" alt="thumbnail" />
                        @else
                            <img src="/assets/img/post/post-thumb.jpg" alt="thumbnail" />
                        @endif
                    </a>
                </div>
                <div class="w-desk">
                    <a href="#">{{ $post->title }}</a>
                    {{ $post->created_at->format('Y F d G:i') }}
                </div>
            </li>
        @endforeach
    </ul>
</div>
<!--latest post widget-->

<!--category widget-->
<div class="widget">
    <div class="heading-title-alt text-left heading-border-bottom">
        <h6 class="text-uppercase">category</h6>
    </div>
    <ul class="widget-category">
        @foreach ($categories as $category)
            <li>
                <a href="/posts/category/{{ $category->id }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
<!--category widget-->

<!--comments widget-->
<div class="widget">
    <div class="heading-title-alt text-left heading-border-bottom">
        <h6 class="text-uppercase">Latest comments </h6>
    </div>
    <ul class="widget-comments">
        @foreach ($latestComments as $comment)
            <li>{{ $comment->name }} on <a href="/posts/{{ $comment->post->id }}">{{ $comment->post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>
<!--comments widget-->

<!--tags widget-->
<div class="widget">
    <div class="heading-title-alt text-left heading-border-bottom">
        <h6 class="text-uppercase">tag cloud</h6>
    </div>
    @if ($tags->count() > 0)
        <div class="widget-tags">
            @foreach ($tags as $tag)
                <a href="/posts/tag/{{ $tag->id }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    @endif
</div>
<!--tags widget-->
