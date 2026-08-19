<nav
  class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
  navbar-main navbar-scroll="false">
  <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
    <nav>
      <!-- breadcrumb -->
      <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
        <li class="text-sm leading-normal">
          <a class=" opacity-50" href="javascript:;">Pages</a>
        </li>
        <li
          class="text-sm pl-2 capitalize leading-normal  before:float-left before:pr-2 before:text-white before:content-['/']"
          aria-current="page">Dashboard</li>
      </ol>
      <h6 class="mb-0 font-bold capitalize">Dashboard</h6>
    </nav>

    <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
      <div class="flex items-center md:ml-auto md:pr-4">
        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
          <span
            class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
            <i class="fas fa-search"></i>
          </span>
          <input type="text"
            class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
            placeholder="Type here..." />
        </div>
      </div>
      <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
        <!-- online builder btn  -->
        <!-- <li class="flex items-center">
                <a class="inline-block px-8 py-2 mb-0 mr-4 text-xs font-bold text-center text-blue-500 uppercase align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro hover:-translate-y-px active:shadow-xs hover:border-blue-500 active:bg-blue-500 active:hover:text-blue-500 hover:text-blue-500 tracking-tight-rem hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
              </li> -->
        <div x-data="{ open: false }" class="relative inline-block">

          <!-- User Button -->
          <button @mouseenter="open = true" @mouseleave="open = false" class="flex items-center gap-2.5 font-semibold">

            <img
              src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.png') }}"
              class="w-9 h-9 rounded-full object-cover border-2 border-gray-200">

            {{ Auth::user()->name }}

            <i class="fa-solid fa-chevron-down text-xs"></i>
          </button>

          <!-- Dropdown -->
          <div x-show="open" @mouseenter="open = true" @mouseleave="open = false" x-transition
            class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border z-50">

            <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100">
              <i class="fa-solid fa-user mr-2"></i>
              Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50">
                <i class="fa-solid fa-right-from-bracket mr-2"></i>
                Logout
              </button>
            </form>

          </div>

        </div>
        {{-- <li class="flex items-center px-4">
          <a href="javascript:;" class="p-0 text-sm  transition-all ease-nav-brand">
            <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
            <!-- fixed-plugin-button-nav  -->
          </a>
        </li> --}}

        <!-- notifications -->
        <li class="relative flex items-center ms-3 group">
          <p class="hidden transform-dropdown-show"></p>
          <a href="javascript:;" class="block p-0 text-sm relative transition-all ease-nav-brand" aria-expanded="false">
            <i class="cursor-pointer fa fa-bell"></i>

            @if(auth()->user()->unreadNotifications->count() > 0)
              <span
                class="absolute -top-1 -right-1 bg-red-500 text-white  text-xs rounded-full w-4 h-4 flex items-center justify-center">
                {{ auth()->user()->unreadNotifications->count() }}
              </span>
            @endif
          </a>

          <ul class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent dark:shadow-dark-xl dark:bg-slate-850 bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer
              group-hover:opacity-100 group-hover:pointer-events-auto">

            @forelse(auth()->user()->unreadNotifications as $notification)
              <li class="relative mb-2">
                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                  @csrf
                  <button type="submit"
                    class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full text-left whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors">
                    <div class="flex py-1">
                      <div
                        class="inline-flex items-center justify-center my-auto mr-4 text-sm text-white transition-all duration-200 ease-nav-brand bg-gradient-to-tl from-red-600 to-red-400 h-9 w-9 rounded-xl">
                        <i class="fa fa-exclamation-triangle"></i>
                      </div>
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-1 text-sm font-normal leading-normal text-slate-700 dark:text-white">
                          {{ $notification->data['message'] }}
                        </h6>
                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                          <i class="mr-1 fa fa-clock"></i>
                          {{ $notification->created_at->diffForHumans() }}
                        </p>
                      </div>
                    </div>
                  </button>
                </form>
              </li>
            @empty
              <li class="relative mb-2 px-4 py-2 text-center text-slate-400 text-xs">
                There is no notification to show.
              </li>
            @endforelse
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>