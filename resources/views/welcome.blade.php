<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - ApolloHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">

    <div class="min-h-screen flex flex-col justify-center items-center">
        <!-- Navbar -->
        <nav class="w-full py-6 flex justify-between items-center px-8 bg-white shadow-md dark:bg-gray-800">
            <a href="/" class="text-2xl font-bold">ApolloHUB</a>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-blue-500 hover:underline">Entrar</a>
                        <a href="{{ route('register') }}" class="ml-4 px-4 py-2 text-white bg-blue-500 rounded-md">Registrar-se</a>
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Main content -->
        <main class="flex flex-col items-center justify-center text-center py-20">
            <h1 class="text-5xl font-bold mb-4">Bem-vindo ao ApolloHUB</h1>
            <p class="text-lg mb-8">Conecte-se com mentores e impulsione o sucesso da sua empresa</p>
            <div class="flex space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-blue-500 text-white rounded-md">Ir para o Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-500 text-white rounded-md">Entrar</a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-300 text-gray-900 rounded-md">Registrar-se</a>
                @endauth
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-8 text-sm text-gray-500 dark:text-gray-400">
            &copy; 2024 ApolloHUB. Todos os direitos reservados.
        </footer>
    </div>

</body>
</html>