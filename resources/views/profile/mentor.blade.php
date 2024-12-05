@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <!-- Título -->
    <h2 class="text-3xl font-bold mb-6 text-orange-500 text-center">Perfil do Mentor</h2>

    <!-- Layout do Formulário -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="flex flex-col md:flex-row items-start gap-6">
            <!-- Foto de Perfil -->
            <div class="flex flex-col items-center w-full md:w-1/3">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto de Perfil" 
                        class="w-32 h-32 rounded-full border-4 border-orange-500 shadow-md mb-4">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Foto de Perfil Padrão" 
                        class="w-32 h-32 rounded-full border-4 border-orange-500 shadow-md mb-4">
                @endif

                <!-- Campo para Alterar a Foto -->
                <label for="profile_picture" class="block text-blue-700 font-medium mb-2">Alterar Foto</label>
                <input type="file" name="profile_picture" id="profile_picture" 
                    class="w-full text-gray-600 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-2 focus:ring-orange-500">

                <!-- Termos de Mentoria e Consentimento -->
                <div class="mt-6">
                    <p class="text-gray-700 text-center">
                        Leia e concorde com os seguintes documentos:
                    </p>
                    <ul class="list-disc list-inside mt-2 text-center">
                        <li>
                            <a href="{{ asset('storage/Termo_Mentoria_Voluntaria_ApolloHub.pdf') }}" target="_blank" class="text-blue-500 hover:underline">
                                Termo de Mentoria Voluntária
                            </a>
                        </li>
                        <li>
                            <a href="{{ asset('storage/Termo_Consentimento_ApolloHub.pdf') }}" target="_blank" class="text-blue-500 hover:underline">
                                Termo de Consentimento
                            </a>
                        </li>
                    </ul>
                    <div class="flex items-center justify-center mt-4">
                        <input type="checkbox" name="accept_terms" id="accept_terms" class="w-5 h-5 text-orange-500 border-gray-300 rounded focus:ring-orange-500" required>
                        <label for="accept_terms" class="ml-2 text-gray-700">Eu concordo com os termos</label>
                    </div>
                </div>
            </div>

            <!-- Campos do Formulário -->
            <div class="flex-1">
                <!-- Nome -->
                <div class="mb-4">
                    <label for="name" class="block text-blue-700 font-medium mb-2">Nome</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" 
                        class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-blue-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" readonly
                        class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none">
                </div>

                <!-- Formação -->
                <div class="mb-4">
                    <label for="education" class="block text-blue-700 font-medium mb-2">Formação</label>
                    <input type="text" name="education" id="education" value="{{ $user->education }}" 
                        class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <!-- LinkedIn -->
                <div class="mb-4">
                    <label for="linkedin_url" class="block text-blue-700 font-medium mb-2">LinkedIn</label>
                    <input type="url" name="linkedin_url" id="linkedin_url" value="{{ $user->linkedin_url }}" 
                        placeholder="https://linkedin.com"
                        class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <label for="description" class="block text-blue-700 font-medium mb-2">Descrição</label>
                    <textarea name="description" id="description" rows="4" 
                        class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">{{ $user->description }}</textarea>
                </div>
            </div>
        </div>

        <!-- Botão Salvar -->
        <div class="flex justify-end mb-6">
            <button type="submit" 
                class="bg-blue-700 text-white px-6 py-2 rounded-md shadow hover:bg-blue-800 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Salvar Alterações
            </button>
        </div>
    </form>

    <!-- Botão Excluir Conta -->
    <form action="{{ route('profile.destroy') }}" method="POST" 
        onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação é irreversível.');">
        @csrf
        @method('DELETE')
        <div class="flex justify-end">
            <button type="submit" 
                class="bg-red-600 text-white px-6 py-2 rounded-md shadow hover:bg-red-700 focus:ring-2 focus:ring-red-400 focus:outline-none">
                Excluir Conta
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('linkedin_url').addEventListener('blur', function () {
        let linkedinField = this;
        if (linkedinField.value && !linkedinField.value.startsWith('http://') && !linkedinField.value.startsWith('https://')) {
            linkedinField.value = 'http://' + linkedinField.value;
        }
    });
</script>
@endsection
