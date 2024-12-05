<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Título da Página -->
    <title>{{ config('app.name', 'ApolloHub') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('logo/icone.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
        <!-- Navbar -->
        <header class="bg-white dark:bg-gray-800 shadow flex items-center justify-between px-6 py-4" style="height: 80px;">
            <!-- Logo à esquerda -->
            <div class="flex items-center">
                <img src="{{ asset('logo/apollohub.jpg') }}" alt="ApolloHub Logo" class="h-8 w-auto" style="max-width: 50px;">
            </div>

            <!-- Texto de boas-vindas centralizado -->
            <div class="flex-grow text-center">
                @if(auth()->check())
                    <span class="text-xl font-semibold text-gray-900 dark:text-white">
                        Bem Vindo, {{ auth()->user()->name }}!
                    </span>
                @else
                    <span class="text-xl font-semibold text-gray-900 dark:text-white">
                        Bem Vindo ao ApolloHub!
                    </span>
                @endif
            </div>

            <!-- Links de navegação à direita -->
            <nav class="flex items-center space-x-8">
                @if(auth()->check())
                    @if (auth()->user()->user_type === 'empresa')
                        <a href="{{ route('dashboard.company') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Mentorias</a>
                        <a href="{{ route('profile.company') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Perfil</a>
                    @elseif (auth()->user()->user_type === 'mentor')
                        <a href="{{ route('dashboard.mentor') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Mentorias</a>
                        <a href="{{ route('profile.mentor') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Perfil</a>
                    @endif
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        Sair
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Entrar</a>
                    <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Registrar</a>
                @endif
            </nav>

            <!-- Logout Form (Hidden) -->
            @if(auth()->check())
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif
        </header>

        <!-- Page Heading -->
        @isset($header)
            <div class="bg-gray-100 dark:bg-gray-900 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <!-- Page Content -->
        <main class="py-8">
            @yield('content')
        </main>
    </div>

    <!-- Swiper.js JavaScript -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.swiper', {
                slidesPerView: 2, // Altere aqui para 2 slides por vez
                spaceBetween: 30, // Espaçamento entre os slides
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                loop: true, // Ativa o loop infinito
                autoplay: {
                    delay: 3000, // Troca automática a cada 3 segundos
                    disableOnInteraction: false,
                },
            });
        });
    </script>
</body>
</html>
