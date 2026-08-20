@extends('admin.layouts.app')

@section('main')

    <div class="max-w-3xl mx-auto space-y-6">

        <h2 class="text-2xl font-bold mb-2">
            My Profile
        </h2>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        {{-- ===================== PROFILE IMAGE ===================== --}}
        <div class="bg-white rounded-lg shadow p-6">

            <div class="relative w-32 h-32 mx-auto">

                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/default-avatar.png') }}"
                    class="w-32 h-32 rounded-full object-cover border-4 border-gray-200">

                <label for="image"
                    class="absolute bottom-1 right-1 w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center cursor-pointer hover:bg-blue-700">
                    <i class="fa-solid fa-camera"></i>
                </label>
            </div>

            <form method="POST" action="{{ route('admin.profile.updateImage') }}" enctype="multipart/form-data"
                class="mt-4 text-center">
                @csrf

                <input type="file" id="image" name="image" accept="image/*" onchange="this.form.submit()" class="hidden">

                @error('image')
                    <span class="text-red-500 text-sm block mt-2">{{ $message }}</span>
                @enderror
            </form>

        </div>

        {{-- ===================== BASIC INFO ===================== --}}
        <div class="bg-white rounded-lg shadow p-6">

            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Name</label>

                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded-lg px-4 py-2">

                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Email</label>

                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border rounded-lg px-4 py-2">

                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Phone</label>

                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border rounded-lg px-4 py-2">

                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Address</label>

                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                        class="w-full border rounded-lg px-4 py-2">

                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                    Update Profile

                </button>

            </form>

        </div>

        {{-- ===================== PASSWORD CHANGE ===================== --}}
        <div class="bg-white rounded-lg shadow p-6">

            <h4 class="font-bold text-lg mb-4">Change Password</h4>

            <form method="POST" action="#">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Current Password</label>
                    <input type="password" name="current_password" class="w-full border rounded-lg px-4 py-2">
                    @error('current_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">New Password</label>
                    <input type="password" name="password" class="w-full border rounded-lg px-4 py-2">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded-lg px-4 py-2">
                </div>

                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-6 py-2 rounded-lg">

                    Update Password

                </button>

            </form>

        </div>

    </div>

@endsection