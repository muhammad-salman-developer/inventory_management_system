@extends('web.layouts.app')

@section('content')

    {{-- HERO SECTION --}}
    <section class="bg-slate-50 py-14 sm:py-16 md:py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 lg:gap-16 items-center">

                {{-- LEFT CONTENT --}}
                <div class="w-full max-w-2xl mx-auto lg:mx-0 text-center lg:text-left">

                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 mb-5 sm:mb-6 bg-emerald-50 border border-emerald-100 rounded-full">
                        <i class="fa-solid fa-boxes-stacked text-emerald-600 text-xs sm:text-sm"></i>

                        <span class="text-xs sm:text-sm font-semibold text-emerald-700">
                            Smart Inventory Management
                        </span>
                    </div>

                    {{-- Heading --}}
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight text-slate-900">
                        Manage Your Inventory

                        <span class="block text-emerald-600 mt-1 sm:mt-2">
                            Smarter & Faster
                        </span>
                    </h1>

                    {{-- Description --}}
                    <p class="mt-5 sm:mt-6 text-base sm:text-lg md:text-xl leading-7 sm:leading-8 text-slate-500 max-w-xl mx-auto lg:mx-0">
                        Keep track of your products, stock, purchases and sales
                        from one simple and powerful platform.
                    </p>

                    {{-- Button --}}
                    <div class="mt-7 sm:mt-8 flex justify-center lg:justify-start">
                        <a
                            href="#"
                            class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 sm:py-3.5 bg-emerald-600 text-white text-sm sm:text-base font-semibold rounded-lg hover:bg-emerald-700 transition duration-200"
                        >
                            Get Started

                            <i class="fa-solid fa-arrow-right text-xs sm:text-sm"></i>
                        </a>
                    </div>

                    {{-- Features --}}
                    <div class="mt-7 sm:mt-8 flex flex-col sm:flex-row flex-wrap justify-center lg:justify-start items-center gap-3 sm:gap-x-6 sm:gap-y-3 text-sm text-slate-500">

                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i>
                            <span>Easy to Use</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i>
                            <span>Real-Time Tracking</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i>
                            <span>Secure</span>
                        </div>

                    </div>

                </div>


                {{-- RIGHT SIDE SLIDER --}}
                <div class="relative w-full max-w-2xl mx-auto lg:max-w-none">

                    <div class="bg-white border border-slate-200 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl p-2 sm:p-3">

                        <div class="swiper heroSwiper rounded-lg sm:rounded-xl overflow-hidden">

                            <div class="swiper-wrapper">

                                {{-- Slide 1 --}}
                                <div class="swiper-slide">
                                    <img
                                        src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d"
                                        alt="Inventory Management"
                                        class="w-full h-[230px] xs:h-[260px] sm:h-[320px] md:h-[380px] lg:h-[420px] xl:h-[460px] object-cover"
                                    >
                                </div>

                                {{-- Slide 2 --}}
                                <div class="swiper-slide">
                                    <img
                                        src="https://images.unsplash.com/photo-1556761175-b413da4baf72"
                                        alt="Business Management"
                                        class="w-full h-[230px] xs:h-[260px] sm:h-[320px] md:h-[380px] lg:h-[420px] xl:h-[460px] object-cover"
                                    >
                                </div>

                                {{-- Slide 3 --}}
                                <div class="swiper-slide">
                                    <img
                                        src="https://images.unsplash.com/photo-1551288049-bebda4e38f71"
                                        alt="Business Analytics"
                                        class="w-full h-[230px] xs:h-[260px] sm:h-[320px] md:h-[380px] lg:h-[420px] xl:h-[460px] object-cover"
                                    >
                                </div>

                            </div>

                            {{-- Pagination --}}
                            <div class="swiper-pagination"></div>

                            {{-- Navigation --}}
                            {{-- <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div> --}}

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Section Heading -->
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">
                Powerful Features
            </span>

            <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                Everything You Need to Manage Your Inventory
            </h2>

            <p class="mt-4 text-gray-600 leading-relaxed">
                Manage your products, stock, purchases, sales and business
                performance from one simple and powerful system.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Product Management -->
            <div class="bg-white p-7 rounded-2xl border border-gray-100
                        shadow-sm hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 flex items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600 mb-5">
                    <i class="fa-solid fa-boxes-stacked text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-900">
                    Product Management
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Easily add, update and organize all your products
                    with categories, prices and stock information.
                </p>
            </div>

            <!-- Inventory Tracking -->
            <div class="bg-white p-7 rounded-2xl border border-gray-100
                        shadow-sm hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 flex items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600 mb-5">
                    <i class="fa-solid fa-chart-line text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-900">
                    Inventory Tracking
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Keep track of your stock levels and know exactly
                    what is available, low in stock or out of stock.
                </p>
            </div>

            <!-- Purchase Management -->
            <div class="bg-white p-7 rounded-2xl border border-gray-100
                        shadow-sm hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 flex items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600 mb-5">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-900">
                    Purchase Management
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Manage suppliers, purchases and purchase items while
                    automatically keeping your inventory updated.
                </p>
            </div>

            <!-- Sales Management -->
            <div class="bg-white p-7 rounded-2xl border border-gray-100
                        shadow-sm hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 flex items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600 mb-5">
                    <i class="fa-solid fa-cash-register text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-900">
                    Sales Management
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Record sales transactions and monitor your sales
                    activity while keeping stock quantities accurate.
                </p>
            </div>

            <!-- Reports & Analytics -->
            <div class="bg-white p-7 rounded-2xl border border-gray-100
                        shadow-sm hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 flex items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600 mb-5">
                    <i class="fa-solid fa-chart-pie text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-900">
                    Reports & Analytics
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Get useful insights into sales, purchases, stock
                    and overall business performance.
                </p>
            </div>

            <!-- User & Security -->
            <div class="bg-white p-7 rounded-2xl border border-gray-100
                        shadow-sm hover:shadow-lg transition duration-300">
                <div class="w-12 h-12 flex items-center justify-center
                            rounded-xl bg-emerald-100 text-emerald-600 mb-5">
                    <i class="fa-solid fa-shield-halved text-xl"></i>
                </div>

                <h3 class="text-xl font-semibold text-gray-900">
                    User & Security
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Manage users with roles and permissions to keep
                    your inventory system secure and organized.
                </p>
            </div>

        </div>
    </div>
</section>
<!-- How It Works Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Heading -->
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">
                How It Works
            </span>

            <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                Manage Your Inventory in 3 Simple Steps
            </h2>

            <p class="mt-4 text-gray-600 leading-relaxed">
                Keep your inventory organized and your business running
                smoothly with a simple and efficient workflow.
            </p>
        </div>

        <!-- Steps -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Step 1 -->
            <div class="relative text-center">

                <div class="mx-auto w-16 h-16 rounded-2xl
                            bg-emerald-100 text-emerald-600
                            flex items-center justify-center">
                    <i class="fa-solid fa-box-open text-2xl"></i>
                </div>

                <div class="mt-6">
                    <span class="text-sm font-semibold text-emerald-600">
                        STEP 01
                    </span>

                    <h3 class="mt-2 text-xl font-bold text-gray-900">
                        Add Your Products
                    </h3>

                    <p class="mt-3 text-gray-600 leading-relaxed">
                        Add products with their categories, prices,
                        stock quantities and other important details.
                    </p>
                </div>

                <!-- Connector -->
                <div class="hidden md:block absolute top-8 left-[65%]
                            w-[70%] border-t-2 border-dashed border-emerald-200">
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative text-center">

                <div class="mx-auto w-16 h-16 rounded-2xl
                            bg-emerald-100 text-emerald-600
                            flex items-center justify-center">
                    <i class="fa-solid fa-arrows-rotate text-2xl"></i>
                </div>

                <div class="mt-6">
                    <span class="text-sm font-semibold text-emerald-600">
                        STEP 02
                    </span>

                    <h3 class="mt-2 text-xl font-bold text-gray-900">
                        Manage Your Stock
                    </h3>

                    <p class="mt-3 text-gray-600 leading-relaxed">
                        Track purchases, sales and stock levels
                        while keeping your inventory up to date.
                    </p>
                </div>

                <!-- Connector -->
                <div class="hidden md:block absolute top-8 left-[65%]
                            w-[70%] border-t-2 border-dashed border-emerald-200">
                </div>
            </div>

            <!-- Step 3 -->
            <div class="text-center">

                <div class="mx-auto w-16 h-16 rounded-2xl
                            bg-emerald-100 text-emerald-600
                            flex items-center justify-center">
                    <i class="fa-solid fa-chart-column text-2xl"></i>
                </div>

                <div class="mt-6">
                    <span class="text-sm font-semibold text-emerald-600">
                        STEP 03
                    </span>

                    <h3 class="mt-2 text-xl font-bold text-gray-900">
                        Analyze & Grow
                    </h3>

                    <p class="mt-3 text-gray-600 leading-relaxed">
                        View reports and business insights to make
                        better decisions and improve your performance.
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- Dashboard Preview Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Heading -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">
                Powerful Dashboard
            </span>

            <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                Everything at a Glance
            </h2>

            <p class="mt-4 text-gray-600 leading-relaxed">
                Monitor your inventory, sales, purchases and business
                performance from one powerful dashboard.
            </p>
        </div>

        <!-- Dashboard Preview -->
        <div class="relative max-w-6xl mx-auto">

            <!-- Main Dashboard Card -->
            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-2xl overflow-hidden">

                <!-- Fake Browser Header -->
                <div class="flex items-center gap-2 px-5 py-4
                            border-b border-gray-200 bg-gray-50">

                    <span class="w-3 h-3 rounded-full bg-red-400"></span>
                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                    <span class="w-3 h-3 rounded-full bg-green-400"></span>

                    <div class="ml-4 flex-1 h-8 bg-white rounded-lg
                                border border-gray-200"></div>
                </div>

                <!-- Dashboard Content -->
                <div class="p-5 md:p-8">

                    <!-- Stats -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                        <div class="p-5 rounded-xl bg-emerald-50">
                            <p class="text-sm text-gray-500">
                                Total Products
                            </p>

                            <h3 class="mt-2 text-2xl font-bold text-gray-900">
                                1,248
                            </h3>
                        </div>

                        <div class="p-5 rounded-xl bg-blue-50">
                            <p class="text-sm text-gray-500">
                                Total Sales
                            </p>

                            <h3 class="mt-2 text-2xl font-bold text-gray-900">
                                $24,580
                            </h3>
                        </div>

                        <div class="p-5 rounded-xl bg-orange-50">
                            <p class="text-sm text-gray-500">
                                Purchases
                            </p>

                            <h3 class="mt-2 text-2xl font-bold text-gray-900">
                                $12,430
                            </h3>
                        </div>

                        <div class="p-5 rounded-xl bg-purple-50">
                            <p class="text-sm text-gray-500">
                                Low Stock
                            </p>

                            <h3 class="mt-2 text-2xl font-bold text-gray-900">
                                24
                            </h3>
                        </div>

                    </div>

                    <!-- Charts Area -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-5">

                        <!-- Sales Chart -->
                        <div class="lg:col-span-2 p-6 border border-gray-200
                                    rounded-xl">

                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        Sales Overview
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Monthly sales performance
                                    </p>
                                </div>

                                <span class="text-sm font-medium text-emerald-600">
                                    +18.4%
                                </span>
                            </div>

                            <!-- Chart Placeholder -->
                            <div class="h-52 flex items-end gap-3">

                                <div class="w-full bg-emerald-100 rounded-t-lg h-[35%]"></div>
                                <div class="w-full bg-emerald-200 rounded-t-lg h-[50%]"></div>
                                <div class="w-full bg-emerald-300 rounded-t-lg h-[42%]"></div>
                                <div class="w-full bg-emerald-400 rounded-t-lg h-[65%]"></div>
                                <div class="w-full bg-emerald-500 rounded-t-lg h-[55%]"></div>
                                <div class="w-full bg-emerald-600 rounded-t-lg h-[78%]"></div>
                                <div class="w-full bg-emerald-500 rounded-t-lg h-[88%]"></div>

                            </div>
                        </div>

                        <!-- Stock Status -->
                        <div class="p-6 border border-gray-200 rounded-xl">

                            <h3 class="font-semibold text-gray-900">
                                Stock Status
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Current inventory
                            </p>

                            <div class="mt-8 space-y-5">

                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600">
                                            In Stock
                                        </span>

                                        <span class="font-medium text-gray-900">
                                            78%
                                        </span>
                                    </div>

                                    <div class="h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 bg-emerald-500 rounded-full w-[78%]"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600">
                                            Low Stock
                                        </span>

                                        <span class="font-medium text-gray-900">
                                            16%
                                        </span>
                                    </div>

                                    <div class="h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 bg-orange-400 rounded-full w-[16%]"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600">
                                            Out of Stock
                                        </span>

                                        <span class="font-medium text-gray-900">
                                            6%
                                        </span>
                                    </div>

                                    <div class="h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 bg-red-400 rounded-full w-[6%]"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- Why Choose Us Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Heading -->
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">
                Why Choose Us
            </span>

            <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900">
                Built to Make Inventory Management Easier
            </h2>

            <p class="mt-4 text-gray-600 leading-relaxed">
                Spend less time managing your inventory and more time
                growing your business.
            </p>
        </div>

        <!-- Benefits -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Benefit 1 -->
            <div class="text-center p-6 rounded-2xl border border-gray-100
                        hover:shadow-lg transition duration-300">

                <div class="w-14 h-14 mx-auto flex items-center justify-center
                            rounded-full bg-emerald-100 text-emerald-600">

                    <i class="fa-solid fa-clock text-xl"></i>
                </div>

                <h3 class="mt-5 text-lg font-bold text-gray-900">
                    Save Time
                </h3>

                <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                    Simplify daily inventory tasks and manage everything
                    from one centralized system.
                </p>
            </div>

            <!-- Benefit 2 -->
            <div class="text-center p-6 rounded-2xl border border-gray-100
                        hover:shadow-lg transition duration-300">

                <div class="w-14 h-14 mx-auto flex items-center justify-center
                            rounded-full bg-emerald-100 text-emerald-600">

                    <i class="fa-solid fa-circle-check text-xl"></i>
                </div>

                <h3 class="mt-5 text-lg font-bold text-gray-900">
                    Reduce Errors
                </h3>

                <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                    Keep stock quantities and transactions accurate
                    with organized inventory management.
                </p>
            </div>

            <!-- Benefit 3 -->
            <div class="text-center p-6 rounded-2xl border border-gray-100
                        hover:shadow-lg transition duration-300">

                <div class="w-14 h-14 mx-auto flex items-center justify-center
                            rounded-full bg-emerald-100 text-emerald-600">

                    <i class="fa-solid fa-chart-line text-xl"></i>
                </div>

                <h3 class="mt-5 text-lg font-bold text-gray-900">
                    Better Decisions
                </h3>

                <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                    Use real-time data and reports to understand your
                    business performance.
                </p>
            </div>

            <!-- Benefit 4 -->
            <div class="text-center p-6 rounded-2xl border border-gray-100
                        hover:shadow-lg transition duration-300">

                <div class="w-14 h-14 mx-auto flex items-center justify-center
                            rounded-full bg-emerald-100 text-emerald-600">

                    <i class="fa-solid fa-shield-halved text-xl"></i>
                </div>

                <h3 class="mt-5 text-lg font-bold text-gray-900">
                    Secure & Reliable
                </h3>

                <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                    Protect your business data with secure authentication,
                    roles and permission management.
                </p>
            </div>

        </div>
    </div>
</section>
<!-- Reports & Analytics Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <div>
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">
                    Reports & Analytics
                </span>

                <h2 class="mt-3 text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                    Make Smarter Decisions With Powerful Reports
                </h2>

                <p class="mt-5 text-gray-600 leading-relaxed">
                    Get a clear view of your business performance with
                    detailed reports for sales, purchases, inventory and
                    overall business activity.
                </p>

                <!-- Report Features -->
                <div class="mt-8 space-y-5">

                    <!-- Item 1 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Sales Reports
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Track your sales performance and revenue
                                over different time periods.
                            </p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Inventory Reports
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Monitor stock levels and identify low-stock
                                and out-of-stock products.
                            </p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Purchase Reports
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Keep track of purchases, suppliers and
                                purchasing costs.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Button -->
                <div class="mt-8">
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 px-6 py-3
                               bg-emerald-600 text-white font-semibold
                               rounded-lg hover:bg-emerald-700
                               transition duration-300"
                    >
                        Explore Dashboard

                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Right Analytics Card -->
            <div class="relative">

                <div class="bg-white rounded-2xl border border-gray-200
                            shadow-xl p-6">

                    <!-- Card Header -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900">
                                Business Overview
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Monthly performance
                            </p>
                        </div>

                        <div class="w-10 h-10 rounded-lg
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center">
                            <i class="fa-solid fa-chart-column"></i>
                        </div>
                    </div>

                    <!-- Revenue -->
                    <div class="mt-8">
                        <p class="text-sm text-gray-500">
                            Total Revenue
                        </p>

                        <div class="flex items-end gap-3 mt-1">
                            <h2 class="text-3xl font-bold text-gray-900">
                                $48,250
                            </h2>

                            <span class="text-sm font-medium text-emerald-600 mb-1">
                                +12.5%
                            </span>
                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="mt-8 h-48 flex items-end gap-2">

                        <div class="w-full bg-emerald-100 rounded-t-md h-[35%]"></div>
                        <div class="w-full bg-emerald-200 rounded-t-md h-[48%]"></div>
                        <div class="w-full bg-emerald-300 rounded-t-md h-[42%]"></div>
                        <div class="w-full bg-emerald-400 rounded-t-md h-[65%]"></div>
                        <div class="w-full bg-emerald-500 rounded-t-md h-[58%]"></div>
                        <div class="w-full bg-emerald-600 rounded-t-md h-[80%]"></div>
                        <div class="w-full bg-emerald-500 rounded-t-md h-[70%]"></div>
                        <div class="w-full bg-emerald-400 rounded-t-md h-[88%]"></div>
                        <div class="w-full bg-emerald-300 rounded-t-md h-[76%]"></div>
                        <div class="w-full bg-emerald-200 rounded-t-md h-[92%]"></div>
                        <div class="w-full bg-emerald-100 rounded-t-md h-[82%]"></div>
                        <div class="w-full bg-emerald-500 rounded-t-md h-[95%]"></div>

                    </div>

                    <!-- Bottom Stats -->
                    <div class="grid grid-cols-2 gap-4 mt-8">

                        <div class="p-4 rounded-xl bg-gray-50">
                            <p class="text-sm text-gray-500">
                                Total Sales
                            </p>

                            <p class="mt-1 text-xl font-bold text-gray-900">
                                1,284
                            </p>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50">
                            <p class="text-sm text-gray-500">
                                Products
                            </p>

                            <p class="mt-1 text-xl font-bold text-gray-900">
                                2,540
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
<!-- CTA Section -->
<section class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="relative overflow-hidden rounded-3xl bg-emerald-600 px-8 py-16
                    md:px-16 text-center">

            <!-- Decorative Circles -->
            <div class="absolute -top-20 -right-20 w-64 h-64
                        rounded-full bg-white/10"></div>

            <div class="absolute -bottom-24 -left-20 w-72 h-72
                        rounded-full bg-white/10"></div>

            <!-- Content -->
            <div class="relative z-10 max-w-3xl mx-auto">

                <span class="inline-block px-4 py-2 rounded-full
                             bg-white/15 text-white text-sm font-semibold">
                    Get Started Today
                </span>

                <h2 class="mt-6 text-3xl md:text-5xl font-bold text-white">
                    Take Control of Your Inventory
                </h2>

                <p class="mt-5 text-emerald-50 text-lg leading-relaxed">
                    Manage products, track stock, monitor sales and
                    understand your business performance — all from
                    one powerful platform.
                </p>

                <!-- Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row
                            items-center justify-center gap-4">

                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2
                               px-7 py-3.5 bg-white text-emerald-700
                               font-semibold rounded-lg
                               hover:bg-gray-100 transition duration-300"
                    >
                        Create Account

                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>

                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center justify-center
                               px-7 py-3.5 border border-white/40
                               text-white font-semibold rounded-lg
                               hover:bg-white/10 transition duration-300"
                    >
                        Login
                    </a>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const heroSwiperEl = document.querySelector('.heroSwiper');

        if (heroSwiperEl) {

            new Swiper(heroSwiperEl, {
                loop: true,

                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },

                pagination: {
                    el: '.heroSwiper .swiper-pagination',
                    clickable: true,
                },

                navigation: {
                    nextEl: '.heroSwiper .swiper-button-next',
                    prevEl: '.heroSwiper .swiper-button-prev',
                },

                effect: 'slide',

                breakpoints: {
                    0: {
                        slidesPerView: 1,
                    },

                    640: {
                        slidesPerView: 1,
                    },

                    1024: {
                        slidesPerView: 1,
                    },
                },
            });

        }

    });
</script>
@endpush