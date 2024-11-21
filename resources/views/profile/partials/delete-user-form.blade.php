<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Excluir Conta
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Ao excluir sua conta, todos os dados serão permanentemente apagados. Essa ação não pode ser desfeita.
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
        @csrf
        @method('delete')

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha</label>
            <input type="password" name="password" id="password" class="form-control mt-1 block w-full" placeholder="Digite sua senha para confirmar" required>
        </div>

        <div class="flex items-center gap-4">
            <x-danger-button>Excluir Conta</x-danger-button>
        </div>
    </form>
</section>
