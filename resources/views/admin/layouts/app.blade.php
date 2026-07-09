<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon.png') }}" />
    <title>@yield('title')</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('admin/assets/js/font-awesome.js') }}" crossorigin="anonymous"></script> --}}
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    
    <!-- Popper -->
    {{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Main Styling -->
    <link href="{{ asset('admin/assets/css/argon-dashboard-tailwind.css') }}" rel="stylesheet" />
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    {{-- <div class="absolute w-full  dark:hidden min-h-75"></div> --}}
    <!-- sidenav  -->
    @include('admin.layouts.components.sidebar')

    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->

        @include('admin.layouts.components.header')
        <!-- end Navbar -->
        @yield('main')
    </main>
    <script src="{{ asset('admin/assets/js/main.js') }}" </script>
</body>
<!-- plugin for charts  -->
<script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}" async></script>
<!-- plugin for scrollbar  -->
<script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<!-- main script file  -->
<script src="{{ asset('admin/assets/js/argon-dashboard-tailwind.js') }}" async></script>

</html>