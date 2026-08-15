@extends('admin.layouts.app')
@section('title', 'Create User')
@section('main')
    <div
        class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white border border-slate-100 shadow-xl rounded-2xl max-w-2xl m-auto">

        {{-- Header --}}
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 rounded-t-2xl">
            <h6 class="text-xl font-bold text-slate-800">Create New User</h6>
            <p class="text-sm text-slate-500 mt-1">Add a new user and assign a role.</p>
        </div>

        <div class="p-6 md:p-8">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Name
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">

                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Password
                    </label>

                    <div class="relative">

                        <input type="password" name="password" id="password" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 pr-12 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">

                        {{-- Font Awesome Eye --}}
                        <button type="button" onclick="togglePassword('password', 'passwordEye')"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-500 hover:text-cyan-600 focus:outline-none"
                            aria-label="Show password">

                            <i id="passwordEye" class="fa-solid fa-eye text-base"></i>

                        </button>

                    </div>

                    @error('password')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Confirm Password
                    </label>

                    <div class="relative">

                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 pr-12 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">

                        {{-- Font Awesome Eye --}}
                        <button type="button" onclick="togglePassword('password_confirmation', 'confirmPasswordEye')"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-500 hover:text-cyan-600 focus:outline-none"
                            aria-label="Show confirm password">

                            <i id="confirmPasswordEye" class="fa-solid fa-eye text-base"></i>

                        </button>

                    </div>

                    @error('password_confirmation')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Role
                    </label>

                    <select name="role" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all bg-white">

                        <option value="">-- Select Role --</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach

                    </select>

                    @error('role')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Email Verification
                    </label>

                    <select name="email_verified" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all bg-white">

                        <option value="">-- Select Verification Status --</option>
                        <option value="0">Not Verified</option>
                        <option value="1">Verified</option>
                    </select>

                    @error('email_verified')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                {{-- Buttons --}}
                <div class="flex justify-between items-center">

                    {{-- Back Button --}}
                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition">

                        <i class="fa-solid fa-arrow-left"></i>
                        Back
                    </a>

                    {{-- Save Button --}}
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-cyan-600 rounded-xl hover:bg-cyan-700 shadow-md shadow-cyan-600/10">

                        <i class="fa-solid fa-check mr-1"></i>
                        Save User

                    </button>

                </div>

            </form>
        </div>
    </div>


    {{-- Password Show / Hide --}}
    <script>
        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {

                // Show password
                input.type = 'text';

                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');

            } else {

                // Hide password
                input.type = 'password';

                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');

            }
        }
    </script>

@endsection