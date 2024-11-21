<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Atualizar Senha
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Certifique-se de que sua conta está usando uma senha longa e aleatória para se manter seguro.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha Atual</label>
            <input type="password" name="current_password" id="current_password" class="form-control mt-1 block w-full" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nova Senha</label>
            <input type="password" name="password" id="password" class="form-control mt-1 block w-full" required>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar Nova Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mt-1 block w-full" required>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Atualizar Senha</x-primary-button>
        </div>
    </form>
</section>
