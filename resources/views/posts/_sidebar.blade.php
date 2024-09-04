@php
    // 加上 \ 才會從專案最底層開始找，否則從當前目錄找
    $categories = \App\Category::all();
    // tag 有文章的才取出，posts 關聯定義在 Tag model。withCount 計算 posts 數量會自動生成 property: posts_count
    $tags = \App\Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
@endphp
<!--latest post widget-->
<div class="widget">
    <div class="heading-title-alt text-left heading-border-bottom">
        <h6 class="text-uppercase">latest post</h6>
    </div>
    <ul class="widget-latest-post">
        <li>
            <div class="thumb">
                <a href="#">
                    <img src="/assets/img/post/post-thumb.jpg" alt="" />
                </a>
            </div>
            <div class="w-desk">
                <a href="#">Old Father Getup</a>
                April 25, 2014
            </div>
        </li>
        <li>
            <div class="thumb">
                <a href="#">
                    <img src="/assets/img/post/post-thumb-2.jpg" alt="" />
                </a>
            </div>
            <div class="w-desk">
                <a href="#">Represent is the best way</a>
                March 28, 2014
            </div>
        </li>
        <li>
            <div class="thumb">
                <a href="#">
                    <img src="/assets/img/post/post-thumb-3.jpg" alt="" />
                </a>
            </div>
            <div class="w-desk">
                <a href="#">Alone with the music</a>
                May 05, 2014
            </div>
        </li>
    </ul>
</div>
<!--latest post widget-->

<!--category widget-->
<div class="widget">
    <div class="heading-title-alt text-left heading-border-bottom">
        <h6 class="text-uppercase">category</h6>
    </div>
    <ul class="widget-category">
        @foreach ($categories as $key => $category)
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
        <li>Jonathan on <a href="javascript:;">Vesti blulum quis dolor </a>
        </li>
        <li>Jane Doe on <a href="javascript:;">Nam sed arcu tellus</a>
        </li>
        <li>Margarita on <a href="javascript:;">Fringilla ut vel ipsum </a>
        </li>
        <li>Smith on <a href="javascript:;">Vesti blulum quis dolor sit</a>
        </li>
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
