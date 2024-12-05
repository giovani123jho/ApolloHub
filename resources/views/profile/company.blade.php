@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <!-- Título -->
    <h2 class="text-4xl font-bold mb-6 text-orange-500 text-center">Editar Perfil da Empresa</h2>

    <!-- Exibição de Erros -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.company.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Seção de Imagem -->
            <div class="flex flex-col items-center">
                <div class="mb-4">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Logo da Empresa"
                            class="w-40 h-40 rounded-full border-4 border-orange-500 shadow-md mb-4">
                    @else
                        <img src="{{ asset('images/default-company-logo.png') }}" alt="Logo da Empresa Padrão"
                            class="w-40 h-40 rounded-full border-4 border-orange-500 shadow-md mb-4">
                    @endif
                </div>
                <label for="profile_picture" class="block text-blue-700 font-medium">Alterar Logo</label>
                <input type="file" name="profile_picture" id="profile_picture"
                    class="mt-2 text-gray-600 border border-gray-300 rounded-md shadow-sm p-2 w-full focus:ring-2 focus:ring-orange-500 focus:outline-none">
            </div>

            <!-- Informações da Empresa -->
            <div class="col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome da Empresa -->
                    <div class="mb-4">
                        <label for="name" class="block text-blue-700 font-medium">Nome da Empresa</label>
                        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                            class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-blue-700 font-medium">Email</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" readonly
                            class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none">
                    </div>

                    <!-- Número de WhatsApp -->
                    <div class="mb-4">
                        <label for="whatsapp_number" class="block text-blue-700 font-medium">WhatsApp</label>
                        <input type="text" name="whatsapp_number" id="whatsapp_number"
                            value="{{ auth()->user()->whatsapp_number }}"
                            placeholder="Digite o número com DDD (ex: +55 11 99999-9999)"
                            class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                    </div>

                    <!-- Website -->
                    <div class="mb-4">
                        <label for="website" class="block text-blue-700 font-medium">Website</label>
                        <input type="url" name="website" id="website" value="{{ auth()->user()->website }}"
                            placeholder="https://example.com"
                            class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                    </div>
                </div>

                <!-- Descrição -->
                <div class="mb-4">
                    <label for="description" class="block text-blue-700 font-medium">Descrição</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">{{ auth()->user()->description }}</textarea>
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6">
            <button type="submit"
                class="bg-blue-700 text-white px-6 py-3 rounded-md shadow hover:bg-blue-800 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Salvar Alterações
            </button>
        </div>
    </form>

    <!-- Botão Excluir Conta -->
    <form action="{{ route('profile.company.destroy') }}" method="POST"
        onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não poderá ser desfeita.');" class="mt-6">
        @csrf
        @method('DELETE')
        <div class="flex justify-end">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-3 rounded-md shadow hover:bg-red-700 focus:ring-2 focus:ring-red-400 focus:outline-none">
                Excluir Conta
            </button>
        </div>
    </form>
</div>

<!-- Adiciona o protocolo automaticamente caso o usuário esqueça -->
<script>
    document.getElementById('website').addEventListener('blur', function () {
        let websiteField = this;
        if (websiteField.value && !websiteField.value.startsWith('http://') && !websiteField.value.startsWith('https://')) {
            websiteField.value = 'http://' + websiteField.value;
        }
    });
</script>
@endsection

