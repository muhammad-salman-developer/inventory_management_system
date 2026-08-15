<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'StockOra')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- Swiper CSS yahan theek hai (CSS hamesha head mein) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @stack('styles')
</head>

<body class="font-sans antialiased text-slate-900 bg-white">

    @include('web.layouts.components.header')

    <main class="pt-20">
        @yield('content')
    </main>

    @include('web.layouts.components.footer')

    {{-- Swiper JS yahan hona chahiye — body k END mein, </body> se pehle --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Ye stack yahan aana chahiye, Swiper JS k BAAD --}}
    @stack('scripts')

</body>
</html>