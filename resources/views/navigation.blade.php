<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')
    <title>Task Manager</title>
</head>

<body class="text-gray-800 font-inter">
    <div class="notification-box flex flex-col items-center justify-center fixed w-full z-50 p-3">
        {{-- NOTIFICACIONES --}}
    </div>
    {{-- SIDEBAR --}}
    <div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
        <div class="flex flex-col justify-between h-full w-full">
            <p class="flex items-center pb-4 border-b border-b-gray-800">
                <img src="{{ auth()->user()->getImagePath(auth()->id()) }}" alt=""
                    class="w-8 h-8 rounded object-cover">
                <span class="text-lg font-bold text-white ml-3">{{ Auth::user()->name }}</span>
            </p>
            <ul class="mt-4">
                <li class="mb-1 group {{ request()->is('/') ? 'active' : '' }}">
                    <a href="/"
                        class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class="ri-home-2-line mr-3 text-lg"></i>
                        <span class="text-sm">Panel</span>
                    </a>
                </li>
                <li class="mb-1 group {{ request()->is('proyecto/*') ? 'active' : '' }}">
                    <p
                        class="cursor-pointer flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                        <i class="ri-todo-line mr-3 text-lg"></i>
                        <span class="text-sm">Proyectos</span>
                        <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
                    </p>
                    <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                        <li class="mb-4">
                            <a href="/proyecto/nuevo"
                                class="text-gray-300 text-sm flex items-center hover:text-gray-100 ">Nuevo
                                proyecto</a>
                        </li>
                        <hr class="mb-4 mr-8">
                        @include('projects.project-list')
                    </ul>
                </li>
                <li class="mb-1 group">
                    <a href="/user/profile"
                        class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class="ri-account-circle-line mr-3 text-lg"></i>
                        <span class="text-sm">Perfil</span>
                    </a>
                </li>
            </ul>

            <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class="ri-logout-box-r-line mr-3 text-lg"></i>
                        <span class="text-sm">Cerrar sesión</span>
                    </button>
                </form>
            </div>

        </div>

    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>

    {{-- MAIN --}}
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30 h-16">
            <button type="button" class="text-lg text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                @yield('navbar')
            </ul>
            <ul class="ml-auto flex items-center">
                @yield('action-menu')

            </ul>
        </div>
        <div class="h-[calc(100vh-64px)]">
            @yield('content')
        </div>
    </main>
    <!-- end: Main -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script>
        @if (session('error'))
            sendNotification("error", "{{ session('error') }}");
        @endif
        @if (session('ok'))
            sendNotification("ok", "{{ session('ok') }}");
        @endif
    </script>
    @vite('resources/js/app.js')
    @stack('custom-scripts')
</body>

</html>
