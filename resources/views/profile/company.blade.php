@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Editar Perfil da Empresa</h2>
    
    <!-- Formulário de atualização de informações da empresa -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- Nome da Empresa -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nome da Empresa</label>
            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Número de WhatsApp -->
        <div class="mb-4">
            <label for="whatsapp_number" class="block text-gray-700">WhatsApp</label>
            <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ auth()->user()->whatsapp_number }}" 
                placeholder="Digite o número com DDD (ex: +55 11 99999-9999)"
                class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Logo da Empresa -->
        <div class="mb-4">
            <label for="profile_picture" class="block text-gray-700">Logo da Empresa</label>
            <input type="file" name="profile_picture" id="profile_picture" class="w-full border-gray-300 rounded-md shadow-sm">
            @if(auth()->user()->profile_picture)
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Logo da Empresa" class="w-20 h-20 mt-2">
            @endif
        </div>

        <!-- Descrição da Empresa -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Descrição</label>
            <textarea name="description" id="description" class="w-full border-gray-300 rounded-md shadow-sm">{{ auth()->user()->description }}</textarea>
        </div>

        <!-- Website da Empresa -->
        <div class="mb-4">
            <label for="website" class="block text-gray-700">Website</label>
            <input type="url" name="website" id="website" value="{{ auth()->user()->website }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Botão de salvar -->
        <div class="text-right">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600">
                Salvar Dados
            </button>
        </div>
    </form>

    <!-- Formulário de exclusão de conta -->
    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não poderá ser desfeita.')" class="mt-6">
        @csrf
        @method('DELETE')

        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md shadow-sm hover:bg-red-600">
            Excluir Conta
        </button>
    </form>
</div>
@endsection
