@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Perfil do Mentor</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Nome -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nome</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Foto de Perfil -->
        <div class="mb-4">
            <label for="profile_picture" class="block text-gray-700">Foto de Perfil</label>
            <input type="file" name="profile_picture" id="profile_picture" class="w-full border-gray-300 rounded-md shadow-sm">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto de Perfil" class="w-20 h-20 rounded-full mt-2">
            @endif
        </div>

        <!-- Formação -->
        <div class="mb-4">
            <label for="education" class="block text-gray-700">Formação</label>
            <input type="text" name="education" id="education" value="{{ $user->education }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- LinkedIn -->
        <div class="mb-4">
            <label for="linkedin_url" class="block text-gray-700">LinkedIn</label>
            <input type="url" name="linkedin_url" id="linkedin_url" value="{{ $user->linkedin_url }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Descrição -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Descrição</label>
            <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm">{{ $user->description }}</textarea>
        </div>

        <!-- Botão Salvar -->
        <div class="flex justify-end mb-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Salvar Alterações
            </button>
        </div>
    </form>

    <!-- Botão Excluir Conta -->
    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação é irreversível.');">
        @csrf
        @method('DELETE')
        <div class="flex justify-end">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                Excluir Conta
            </button>
        </div>
    </form>
</div>
@endsection
    