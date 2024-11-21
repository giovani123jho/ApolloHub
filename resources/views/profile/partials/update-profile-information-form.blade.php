<section class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            Informações do Perfil
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Atualize as informações de perfil e o endereço de e-mail da sua conta.
        </p>
    </header>

    <form method="post" action="{{ route('profile.updateAdditional') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Nome -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- E-mail -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Foto de Perfil -->
        <div>
            <label for="profile_picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto de Perfil</label>
            <input type="file" name="profile_picture" id="profile_picture" class="mt-1 block w-full text-gray-900 dark:text-gray-300 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto de Perfil" class="w-24 h-24 mt-4 rounded-full object-cover">
            @endif
        </div>

        <!-- Formação -->
        <div>
            <label for="education" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Formação</label>
            <input type="text" name="education" id="education" value="{{ old('education', $user->education) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- LinkedIn -->
        <div>
            <label for="linkedin_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn</label>
            <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Botão de Salvar -->
        <div class="flex items-center justify-end">
            <x-primary-button class="ml-3">
                Salvar Informações Adicionais
            </x-primary-button>
        </div>

        <!-- Mensagem de Sucesso -->
        @if (session('success'))
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400">
                {{ session('success') }}
            </p>
        @endif
    </form>
</section>
