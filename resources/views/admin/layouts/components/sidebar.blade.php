<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700"
            href="{{ route('dashboard') }}">
            <img src="{{ asset('admin/assets/img/logo.jpeg') }}"
                class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8"
                alt="main_logo" />
            <img src="./assets/img/logo-ct.png"
                class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                alt="main_logo" />
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Stockora</span>
        </a>
    </div>

    <hr
        class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

    <div class="items-center block w-auto max-h-screen h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">

            {{-- Dashboard: sab logged-in users ke liye --}}
            <li class="mt-4 w-full">
                <a class="{{ request()->routeIs('dashboard') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                    href="{{ route('dashboard') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-gauge-high"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                </a>
            </li>

            {{-- Category --}}
            @can('view-category')
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('categories.index') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('categories.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-layer-group"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Category</span>
                    </a>
                </li>
            @endcan

            {{-- Product --}}
            @can('view-product')
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('products.index') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('products.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-box"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Product</span>
                    </a>
                </li>
            @endcan

            {{-- Supplier --}}
            @can('view-supplier')
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('suppliers.index') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('suppliers.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-truck"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Supplier</span>
                    </a>
                </li>
            @endcan

            {{-- Purchase --}}
            @can('view-purchase')
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('purchases.index') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('purchases.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-cart-plus"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Purchase</span>
                    </a>
                </li>
            @endcan

            {{-- Customer --}}
            @canany(['create-customer', 'edit-customer'])
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('customers.index') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('customers.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-users"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Customer</span>
                    </a>
                </li>
            @endcanany

            {{-- Stock --}}
            @canany(['view-stocks', 'adjust-stock'])
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('stocks.index') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('stocks.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-warehouse"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Stock</span>
                    </a>
                </li>
            @endcanany

            {{-- Sale --}}
            @canany(['create-sale', 'view-own-sales'])
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('sales.index') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('sales.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-cart-shopping"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Sale</span>
                    </a>
                </li>
            @endcanany

            {{-- Reports --}}
            @can('view-reports')
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('reports.index') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('reports.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-chart-column"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Reports</span>
                    </a>
                </li>
            @endcan

            {{-- Manage Users: sirf Admin --}}
            @can('view-user')
                <li class="mt-4 w-full">
                    <a class="{{ request()->routeIs('users.*') ? 'py-2.7 bg-blue-500/13' : 'dark:text-white dark:opacity-80' }} text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('users.index') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-cyan-600 fa-solid fa-user-gear"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Manage Users</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</aside>