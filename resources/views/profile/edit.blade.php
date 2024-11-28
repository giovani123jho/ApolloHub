@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Editar Perfil</h2>
    
    <!-- Formulário de atualização de informações do perfil -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- Campo Nome -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nome</label>
            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Campo Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Campo Foto de Perfil -->
        <div class="mb-4">
            <label for="profile_picture" class="block text-gray-700">Foto de Perfil</label>
            <input type="file" name="profile_picture" id="profile_picture" class="w-full border-gray-300 rounded-md shadow-sm">
            @if(auth()->user()->profile_picture)
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Foto de Perfil" class="w-20 h-20 rounded-full mt-2">
            @endif
        </div>

        <!-- Campo Formação -->
        <div class="mb-4">
            <label for="education" class="block text-gray-700">Formação</label>
            <input type="text" name="education" id="education" value="{{ auth()->user()->education }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Campo LinkedIn -->
        <div class="mb-4">
            <label for="linkedin_url" class="block text-gray-700">LinkedIn</label>
            <input type="url" name="linkedin_url" id="linkedin_url" value="{{ auth()->user()->linkedin_url }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Campo WhatsApp -->
        <div class="mb-4">
            <label for="whatsapp_number" class="block text-gray-700">Número do WhatsApp</label>
            <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ auth()->user()->whatsapp_number }}" class="w-full border-gray-300 rounded-md shadow-sm">
            <p class="text-gray-500 text-sm">Informe o número no formato internacional (Ex.: +5511999999999).</p>
        </div>

        <!-- Botão Salvar -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Salvar Alterações
            </button>
        </div>
    </form>

    <!-- Formulário de atualização de senha -->
    <div class="mt-10">
        <h3 class="text-xl font-semibold mb-4">Alterar Senha</h3>
        <form action="{{ route('profile.updatePassword') }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- Campo Senha Atual -->
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700">Senha Atual</label>
                <input type="password" name="current_password" id="current_password" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Campo Nova Senha -->
            <div class="mb-4">
                <label for="new_password" class="block text-gray-700">Nova Senha</label>
                <input type="password" name="new_password" id="new_password" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Campo Confirmar Nova Senha -->
            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-gray-700">Confirmar Nova Senha</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Botão Atualizar Senha -->
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Atualizar Senha
                </button>
            </div>
        </form>
    </div>

    <!-- Formulário de Deletar Conta -->
    <div class="mt-10">
        <h3 class="text-xl font-semibold mb-4 text-red-600">Deletar Conta</h3>
        <p class="text-gray-600 mb-4">Atenção: esta ação é irreversível. Ao deletar sua conta, todos os dados associados serão removidos permanentemente.</p>
        
        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar sua conta? Esta ação não poderá ser desfeita.')">
            @csrf
            @method('DELETE')

            <!-- Botão Deletar Conta -->
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                Deletar Conta
            </button>
        </form>
    </div>
</div>
@endsection
