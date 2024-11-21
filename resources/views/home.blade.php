@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Bem-vindo ao Apollohub</h1>

    <!-- Sessão de Empresas -->
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-6">Empresas Incubadas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($companies as $company)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <!-- Logo da Empresa -->
                    @if($company->profile_picture)
                        <img src="{{ asset('storage/' . $company->profile_picture) }}" alt="{{ $company->name }}" class="h-20 mx-auto mb-4">
                    @else
                        <img src="{{ asset('images/default-logo.png') }}" alt="Logo padrão" class="h-20 mx-auto mb-4">
                    @endif

                    <!-- Nome e Descrição -->
                    <h3 class="text-xl font-semibold text-center">{{ $company->name }}</h3>
                    <p class="text-gray-600 text-sm text-center mt-2">{{ $company->description }}</p>

                    <!-- Website -->
                    @if($company->website)
                        <p class="text-center mt-4">
                            <a href="{{ $company->website }}" class="text-blue-500 hover:underline" target="_blank">Visitar Website</a>
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Sessão de Mentores -->
    <div>
        <h2 class="text-2xl font-semibold mb-6">Mentores</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($mentors as $mentor)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <!-- Foto do Mentor -->
                    @if($mentor->profile_picture)
                        <img src="{{ asset('storage/' . $mentor->profile_picture) }}" alt="{{ $mentor->name }}" class="h-20 mx-auto mb-4 rounded-full">
                    @else
                        <img src="{{ asset('images/default-mentor.png') }}" alt="Imagem padrão" class="h-20 mx-auto mb-4 rounded-full">
                    @endif

                    <!-- Nome e Descrição -->
                    <h3 class="text-xl font-semibold text-center">{{ $mentor->name }}</h3>
                    <p class="text-gray-600 text-sm text-center mt-2">{{ $mentor->description }}</p>

                    <!-- LinkedIn -->
                    @if($mentor->linkedin_url)
                        <p class="text-center mt-4">
                            <a href="{{ $mentor->linkedin_url }}" class="text-blue-500 hover:underline" target="_blank">Ver no LinkedIn</a>
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
