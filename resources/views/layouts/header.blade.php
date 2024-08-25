{{-- 因為 index 及 about css 有一點不一樣，所以要做一些條件判斷 --}}
<header class="l-header @isset($overlay) l-header_overlay @endisset">

<div
    class="l-navbar l-navbar_expand js-navbar-sticky
  @isset($overlay) l-navbar_t-dark-trans @else l-navbar_t-light @endisset">
    <div class="container-fluid">
        <nav class="menuzord js-primary-navigation" role="navigation" aria-label="Primary Navigation">

            <!--logo start-->
            <a href="/" class="logo-brand">
                @isset($overlay)
                    <img class="retina" src="/assets/img/logo-dark.png" alt="Massive">
                @else
                    <img class="retina" src="/assets/img/logo.png" alt="Massive">
                @endisset
            </a>
            <!--logo end-->

            <!--mega menu start-->
            <ul class="menuzord-menu menuzord-right c-nav_s-standard">
              {{-- 直接在 php 寫 php 程式碼 --}}
              {{-- @php Illuminate\Support\Facades\Log::info(request()->path()); @endphp --}}
              {{-- global function call request() --}}
                <li class="@if(request()->is('/')) active @endif"><a href="/">Home</a></li>
                <li class="@if(request()->is('about')) active @endif"><a href="/about">About</a></li>
                <li class="@if(request()->is('posts')) active @endif"><a href="/posts">Blog</a></li>
                <li class="@if(request()->is('contact')) active @endif"><a href="/contact">Contact</a></li>
            </ul>
            <!--mega menu end-->

        </nav>
    </div>
</div>

</header>
