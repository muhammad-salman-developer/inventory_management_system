@extends('admin.layouts.app')
@section('title', 'Manage Users')
@section('main')
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border max-w-4xl m-auto">

        <div class="p-6 pb-4 mb-0 bg-white rounded-t-2xl flex items-center justify-between border-b border-slate-100">
            <h6 class="text-base font-semibold text-slate-800 m-0">Users Table</h6>

            @can('create-user')
                <a href="{{ route('users.create') }}"
                    class="text-white !bg-cyan-600 hover:bg-cyan-700 font-medium rounded-lg text-sm px-4 py-2.5 text-center leading-5 inline-flex items-center gap-1.5 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Add User
                </a>
            @endcan
        </div>

        {{-- Success Alert --}}
        <div id="successAlert"
            class="{{ session('success') ? '' : 'hidden' }} auto-fade-alert p-4 mb-4 mx-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 transition-opacity duration-500 ease-out opacity-100"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>

        {{-- Error Alert --}}
        @if (session('error'))
            <div class="p-4 mb-4 mx-6 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th
                                class="px-6 py-3 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-wider whitespace-nowrap text-slate-400 opacity-70">
                                id</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-wider whitespace-nowrap text-slate-400 opacity-70">
                                name</th>
                            <th
                                class="px-6 py-3 font-bold text-left capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-wider whitespace-nowrap text-slate-400 opacity-70">
                                email</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-wider whitespace-nowrap text-slate-400 opacity-70">
                                role</th>
                            <th
                                class="px-6 py-3 font-bold text-center capitalize align-middle bg-transparent border-b border-gray-200 shadow-none text-lg border-b-solid tracking-wider whitespace-nowrap text-slate-400 opacity-70">
                                action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ $user->id }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ $user->name }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-sm">
                                    {{ $user->email }}
                                </td>
                                <td class="p-2 text-center align-middle border-b whitespace-nowrap">
                                    @forelse ($user->roles as $role)
                                        @if ($role->name == 'admin')
                                            <span class="px-3 py-1 text-xs font-semibold text-purple-800 bg-purple-100 rounded-full">
                                                Admin
                                            </span>
                                        @elseif ($role->name == 'manager')
                                            <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                                Manager
                                            </span>
                                        @elseif ($role->name == 'staff')
                                            <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                Staff
                                            </span>
                                        @endif
                                    @empty
                                        <span class="px-3 py-1 text-xs font-semibold text-slate-500 bg-slate-100 rounded-full">
                                            No Role
                                        </span>
                                    @endforelse
                                </td>
                                <td class="p-2 align-middle border-b whitespace-nowrap">
                                    <div class="flex justify-center gap-2">
                                        @can('edit-user')
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="font-medium text-white !bg-blue-600 hover:bg-blue-700 py-1 px-3 rounded">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('delete-user')
                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Kya aap is user ko delete karna chahte hain?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="font-medium text-white !bg-red-600 hover:bg-red-700 py-1 px-3 rounded">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="p-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6 px-6 pb-2">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection