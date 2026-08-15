<div
    class="min-h-screen bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('web/assets/images/logi-image.png') }}');"
>
    <div class="flex flex-col justify-center items-center min-h-screen pt-6 sm:pt-0 lg:items-start lg:pl-20">

        <x-guest-layout>

          <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label
            for="name"
            :value="__('Name')"
            class="text-white"
        />

        <x-text-input
            id="name"
            class="block mt-1 w-full border-slate-300 focus:border-0 focus:ring-0"
            type="text"
            name="name"
            :value="old('name')"
            required
            autofocus
            autocomplete="name"
        />

        <x-input-error
            :messages="$errors->get('name')"
            class="mt-2"
        />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label
            for="email"
            :value="__('Email')"
            class="text-white"
        />

        <x-text-input
            id="email"
            class="block mt-1 w-full border-slate-300 focus:border-0 focus:ring-0"
            type="email"
            name="email"
            :value="old('email')"
            required
            autocomplete="username"
        />

        <x-input-error
            :messages="$errors->get('email')"
            class="mt-2"
        />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label
            for="password"
            :value="__('Password')"
            class="text-white"
        />

        <x-text-input
            id="password"
            class="block mt-1 w-full border-slate-300 focus:border-0 focus:ring-0"
            type="password"
            name="password"
            required
            autocomplete="new-password"
        />

        <x-input-error
            :messages="$errors->get('password')"
            class="mt-2"
        />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label
            for="password_confirmation"
            :value="__('Confirm Password')"
            class="text-white"
        />

        <x-text-input
            id="password_confirmation"
            class="block mt-1 w-full border-slate-300 focus:border-0 focus:ring-0"
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password"
        />

        <x-input-error
            :messages="$errors->get('password_confirmation')"
            class="mt-2"
        />
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-end mt-6">
        <a
            class="underline text-sm text-white hover:text-emerald-300 focus:outline-none focus:ring-0"
            href="{{ route('login') }}"
        >
            {{ __('Already have an account?') }}
        </a>

        <x-primary-button class="ms-4">
            {{ __('Create Account') }}
        </x-primary-button>
    </div>

</form>

        </x-guest-layout>

    </div>
</div>