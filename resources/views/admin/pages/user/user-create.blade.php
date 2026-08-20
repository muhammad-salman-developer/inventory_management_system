@extends('admin.layouts.app')
@section('title', 'Create User')
@section('main')
    <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white border border-slate-100 shadow-md rounded-2xl max-w-3xl m-auto overflow-hidden">

        {{-- Header Section (Padding standard size mein kar di hai) --}}
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <h6 class="text-base font-semibold text-slate-800 m-0">Create New User</h6>
            <p class="text-xs text-slate-400 mt-0.5">Add a new user and assign a role.</p>
        </div>

        {{-- Form Body (Spacing compact kar ke p-5 space-y-4 kiya hai) --}}
        <div class="p-5 md:p-6">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Grid for Name & Email (Horizontal alignment for less vertical scroll) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Name --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Name
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                        @error('name')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Email
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                        @error('email')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Grid for Password & Confirm Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Password --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password" required
                                class="w-full border border-slate-300 rounded-xl px-4 py-2.5 pr-11 text-slate-800 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                            <button type="button" onclick="togglePassword('password', 'passwordEye')"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 hover:text-cyan-600 focus:outline-none"
                                aria-label="Show password">
                                <i id="passwordEye" class="fa-solid fa-eye text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full border border-slate-300 rounded-xl px-4 py-2.5 pr-11 text-slate-800 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all">
                            <button type="button" onclick="togglePassword('password_confirmation', 'confirmPasswordEye')"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 hover:text-cyan-600 focus:outline-none"
                                aria-label="Show confirm password">
                                <i id="confirmPasswordEye" class="fa-solid fa-eye text-sm"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Grid for Role & Email Verification -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Role --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Role
                        </label>
                        <select name="role" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all bg-white">
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Verification --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-slate-700">
                            Email Verification
                        </label>
                        <select name="email_verified" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 text-sm focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 outline-none transition-all bg-white">
                            <option value="">-- Select Status --</option>
                            <option value="0">Not Verified</option>
                            <option value="1">Verified</option>
                        </select>
                        @error('email_verified')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Action Footer Buttons (Perfectly synced styling) --}}
                <div class="flex justify-between items-center pt-3 border-t border-slate-100">
                    {{-- Back Button --}}
                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Back
                    </a>

                    {{-- Save Button --}}
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white !bg-cyan-600 hover:bg-cyan-700 rounded-xl transition-colors shadow-sm inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-check text-xs"></i>
                        Save User
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Password Show / Hide Script --}}
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
