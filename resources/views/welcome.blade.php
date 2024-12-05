<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - ApolloHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-700 text-white">

    <!-- Navbar -->
    <nav class="w-full py-4 px-8 bg-blue-900 shadow-md flex justify-between items-center">
        <a href="/" class="text-3xl font-bold text-orange-500">ApolloHUB</a>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Entrar</a>
                    <a href="{{ route('register') }}" class="ml-4 px-4 py-2 bg-white text-blue-700 rounded-md hover:bg-gray-200">Registrar-se</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Main content -->
    <main class="flex flex-col items-center justify-center text-center py-20 px-4">
        <h1 class="text-5xl font-extrabold mb-6 text-orange-500">Bem-vindo ao ApolloHUB</h1>
        <p class="text-lg mb-10 max-w-2xl">A plataforma que conecta empresas a mentores especializados para impulsionar inovação e crescimento.</p>
        <div class="flex flex-wrap justify-center gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-orange-500 text-white rounded-md text-lg font-medium hover:bg-orange-600">Ir para o Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-8 py-3 bg-orange-500 text-white rounded-md text-lg font-medium hover:bg-orange-600">Entrar</a>
                <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-blue-700 rounded-md text-lg font-medium hover:bg-gray-200">Registrar-se</a>
            @endauth
        </div>
    </main>

    <!-- Seção de Destaques -->
    <section class="py-16 bg-blue-800 text-gray-300">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-semibold mb-6 text-orange-500">Por que escolher o ApolloHUB?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex justify-center items-center w-16 h-16 bg-orange-500 rounded-full mx-auto mb-4">
                        <span class="text-xl font-bold text-white">1</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">Conexões Personalizadas</h3>
                    <p>Encontre mentores ideais para as necessidades da sua empresa.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center w-16 h-16 bg-orange-500 rounded-full mx-auto mb-4">
                        <span class="text-xl font-bold text-white">2</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">Crescimento Garantido</h3>
                    <p>Impulsione sua empresa com insights estratégicos.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center w-16 h-16 bg-orange-500 rounded-full mx-auto mb-4">
                        <span class="text-xl font-bold text-white">3</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">Foco em Resultados</h3>
                    <p>Apoio contínuo para alcançar objetivos tangíveis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 bg-blue-900 text-center text-sm text-gray-400">
        &copy; 2024 ApolloHUB. Todos os direitos reservados.
    </footer>

</body>
</html>
