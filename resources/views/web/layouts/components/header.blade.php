<!-- Header -->
<header class="bg-white border-b border-slate-200 fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-20 flex items-center justify-between">

            <!-- Logo -->
            <a href="#" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-box text-white text-lg"></i>
                </div>

                <span class="text-xl font-bold text-slate-900">
                    StockOra
                </span>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="#" class="text-slate-700 hover:text-emerald-600 font-medium transition">
                    Home
                </a>

                <a href="#" class="text-slate-700 hover:text-emerald-600 font-medium transition">
                    About
                </a>

                <a href="#" class="text-slate-700 hover:text-emerald-600 font-medium transition">
                    Services
                </a>

                <a href="#" class="text-slate-700 hover:text-emerald-600 font-medium transition">
                    Contact
                </a>
            </nav>

            <!-- Desktop Buttons -->
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="px-5 py-2.5 border border-emerald-600 text-emerald-600 rounded-lg font-medium hover:bg-emerald-50 transition">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="px-5 py-2.5 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition">
                    Register
                </a>
            </div>

            <!-- Mobile Button -->
            <button id="menuButton" type="button"
                class="md:hidden w-10 h-10 flex items-center justify-center text-slate-700 hover:bg-slate-100 rounded-lg transition">
                <i id="menuIcon" class="fa-solid fa-bars text-2xl"></i>
            </button>

        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-200 py-5">

            <!-- Mobile Nav -->
            <div class="flex flex-col space-y-1">

                <a href="#"
                    class="px-4 py-3 text-slate-700 font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">
                    <i class="fa-solid fa-house w-5 mr-2"></i>
                    Home
                </a>

                <a href="#"
                    class="px-4 py-3 text-slate-700 font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">
                    <i class="fa-solid fa-circle-info w-5 mr-2"></i>
                    About
                </a>

                <a href="#"
                    class="px-4 py-3 text-slate-700 font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">
                    <i class="fa-solid fa-layer-group w-5 mr-2"></i>
                    Services
                </a>

                <a href="#"
                    class="px-4 py-3 text-slate-700 font-medium rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">
                    <i class="fa-solid fa-envelope w-5 mr-2"></i>
                    Contact
                </a>

            </div>

            <!-- Mobile Buttons -->
            <div class="flex flex-col gap-3 mt-5 pt-5 border-t border-slate-200">

                <a href="{{ route('login') }}"
                    class="w-full text-center px-5 py-3 border border-emerald-600 text-emerald-600 rounded-lg font-medium hover:bg-emerald-50 transition">
                    Login
                </a>

                <a href="#"
                    class="w-full text-center px-5 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition">
                    Register
                </a>

            </div>

        </div>
    </div>
</header>

<!-- Mobile Menu JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.getElementById('menuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');

        menuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');

            if (mobileMenu.classList.contains('hidden')) {
                menuIcon.classList.remove('fa-xmark');
                menuIcon.classList.add('fa-bars');
            } else {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-xmark');
            }
        });
    });
</script>