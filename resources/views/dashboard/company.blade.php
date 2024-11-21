@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Dashboard da Empresa</h1>

    @if($mentors->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($mentors as $mentor)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <!-- Foto do Mentor -->
                    @if($mentor->profile_picture)
                        <img src="{{ asset('storage/' . $mentor->profile_picture) }}" alt="Foto de {{ $mentor->name }}" class="w-20 h-20 rounded-full object-cover mb-4 mx-auto">
                    @else
                        <img src="{{ asset('path/to/default-image.jpg') }}" alt="Foto de Perfil Padrão" class="w-20 h-20 rounded-full object-cover mb-4 mx-auto">
                    @endif

                    <!-- Nome do Mentor -->
                    <h2 class="text-lg font-semibold text-center">{{ $mentor->name }}</h2>

                    <!-- Formação do Mentor -->
                    <p class="text-gray-600 text-center mt-2">{{ $mentor->education ?? 'Formação não informada' }}</p>

                    <!-- Descrição do Mentor -->
                    <p class="text-gray-800 mt-4 text-sm text-justify break-words max-h-24 overflow-hidden">
                        {{ $mentor->description ?? 'Nenhuma descrição disponível.' }}
                    </p>

                    <!-- LinkedIn do Mentor -->
                    @if($mentor->linkedin_url)
                        <p class="text-center mt-4">
                            <a href="{{ $mentor->linkedin_url }}" target="_blank" class="text-blue-500 hover:underline">Perfil no LinkedIn</a>
                        </p>
                    @else
                        <p class="text-center text-gray-400 mt-4">LinkedIn não informado</p>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Paginação -->
        <div class="mt-6">
            {{ $mentors->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Nenhum mentor disponível no momento.</p>
    @endif
</div>
@endsection
