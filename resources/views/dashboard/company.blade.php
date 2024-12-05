@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Mentores</h1>

    <!-- Formulário de Busca -->
    <form method="GET" action="{{ route('dashboard.company') }}" class="mb-6">
        <div class="flex items-center space-x-2">
            <input 
                type="text" 
                name="search" 
                placeholder="Pesquisar por nome ou formação..." 
                value="{{ $search }}" 
                class="w-full p-2 border border-gray-300 rounded-md shadow-sm"
            >
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600"
            >
                Buscar
            </button>
        </div>
    </form>

    <!-- Mentores Disponíveis -->
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
                    <p class="text-gray-600 text-center mt-2">
                        <strong>Formação:</strong> {{ $mentor->education ?? 'Não informada' }}
                    </p>

                    <!-- Descrição do Mentor -->
                    <p class="text-gray-600 text-center mt-2">{{ $mentor->description ?? 'Descrição não informada' }}</p>

                    <!-- LinkedIn do Mentor -->
                    @if($mentor->linkedin_url)
                        <p class="text-center mt-4">
                            <a href="{{ $mentor->linkedin_url }}" target="_blank" class="text-blue-500 hover:underline">Perfil no LinkedIn</a>
                        </p>
                    @else
                        <p class="text-center text-gray-400 mt-4">LinkedIn não informado</p>
                    @endif

                    <!-- Botão para Solicitar Mentoria -->
                    <form action="{{ route('mentorship.request', $mentor->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Solicitar Mentoria
                        </button>
                    </form>
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

    <!-- Mentorias Solicitadas -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold mb-6">Mentorias Solicitadas</h2>

        @if($mentorships->count())
            <div class="space-y-4">
                @foreach($mentorships as $mentorship)
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h3 class="text-lg font-semibold">Mentor: {{ $mentorship->mentor->name }}</h3>
                        <p class="text-gray-600 mt-2">Status: 
                            <span class="font-bold">
                                @if($mentorship->status === 'pendente')
                                    Pendente
                                @elseif($mentorship->status === 'aceita')
                                    Aceita
                                @elseif($mentorship->status === 'recusada')
                                    Recusada
                                @endif
                            </span>
                        </p>
                        <p class="text-gray-600 mt-2">Solicitada em: 
                            {{ \Carbon\Carbon::parse($mentorship->created_at)->format('d/m/Y H:i') }}
                        </p>

                        <!-- Detalhes da Mentoria -->
                        @if($mentorship->detail)
                            <div class="mt-4">
                                <h4 class="text-lg font-bold">Detalhes da Mentoria:</h4>
                                <p class="text-gray-600"><strong>Conteúdo:</strong> {{ $mentorship->detail->content }}</p>
                                <p class="text-gray-600"><strong>Data:</strong> {{ $mentorship->detail->mentoring_date }}</p>
                                <p class="text-gray-600"><strong>Link:</strong> 
                                    <a href="{{ $mentorship->detail->meeting_link }}" target="_blank" class="text-blue-500 hover:underline">
                                        Acessar Reunião
                                    </a>
                                </p>
                            </div>
                        @else
                            <p class="text-gray-500 mt-4">Os detalhes da mentoria ainda não foram preenchidos pelo mentor.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Nenhuma mentoria solicitada ainda.</p>
        @endif
    </div>
</div>
@endsection
