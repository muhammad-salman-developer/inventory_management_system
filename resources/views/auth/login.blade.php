<div class="min-h-screen bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('web/assets/images/logi-image.png') }}');">
    <div class="flex flex-col justify-center items-center min-h-screen pt-6 sm:pt-0 lg:items-start lg:pl-20">

        <x-guest-layout>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            {{-- <div class="flex justify-center mb-6">
                <img src="{{ asset('web/assets/images/Logos.png') }}" alt="Inventory Management System"
                    class="w-20 h-20 object-contain">
            </div> --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="block mt-1 w-full
                    border-slate-300
                    focus:border-0
                    focus:ring-0" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white" />

                    <x-text-input id="password" class="block mt-1 w-full  border-slate-300
                    focus:border-0
                    focus:ring-0" type="password" name="password" required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center ">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-white  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
                <!-- Register -->
                @if (Route::has('register'))
                    <div class="text-center mt-6">
                        <span class="text-sm text-white">
                            {{ __("Don't have an account?") }}
                        </span>

                        <a href="{{ route('register') }}"
                            class="ms-1 text-sm font-semibold text-emerald-900 hover:text-emerald-300 underline">
                            {{ __('Create Account') }}
                        </a>
                    </div>
                @endif
            </form>
        </x-guest-layout>

    </div>
</div>