{{-- 放頁面結構，從 views 去取用沒有的話沒關係 --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body>
    @include('layouts.preloader')
    <div class="wrapper">
        {{-- 傳變數到 header.blade.php --}}
        {{-- 有傳來 overlay 的話，就傳 overlay 過去，沒有就傳 null --}}
        @include('layouts.header', ['overlay' => isset($overlay) ? $overlay : null])

        @yield('hero')
        @yield('page-title')

        <section class="body-content">
            @yield('content')
        </section>

        @include('layouts.footer')
    </div>

    @include('layouts.js')
    @yield('script')
</body>

</html>
