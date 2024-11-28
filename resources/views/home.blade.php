@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <!-- Título -->
    <h1 class="text-2xl font-bold mb-6 text-center">Bem-vindo ao ApolloHub</h1>

    <!-- Sessão de Empresas -->
    <div class="mb-12">
        <h2 class="text-xl font-semibold mb-6 text-center">Empresas Incubadas</h2>
        @if($companies->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($companies as $company)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                        <!-- Logo da Empresa -->
                        @if($company->profile_picture)
                            <img src="{{ asset('storage/' . $company->profile_picture) }}" alt="{{ $company->name }}" class="w-20 h-20 mx-auto mb-4 object-cover border border-gray-300">
                        @else
                            <img src="{{ asset('images/default-company.png') }}" alt="Logo Padrão" class="w-20 h-20 mx-auto mb-4 object-cover border border-gray-300">
                        @endif

                        <!-- Nome da Empresa -->
                        <h2 class="text-lg font-semibold text-center">{{ $company->name }}</h2>

                        <!-- Descrição da Empresa -->
                        <p class="text-gray-600 text-sm text-justify mt-2">
                            {{ $company->description ?? 'Nenhuma descrição disponível.' }}
                        </p>

                        <!-- Website da Empresa -->
                        @if($company->website)
                            <p class="text-center mt-4">
                                <a href="{{ $company->website }}" target="_blank" class="text-blue-500 hover:underline">Visite o site</a>
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Nenhuma empresa incubada disponível no momento.</p>
        @endif
    </div>

    <!-- Sessão de Eventos -->
    <div>
        <h2 class="text-xl font-semibold mb-6 text-center">Próximos Eventos</h2>
        @if(!empty($events) && count($events) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                        <!-- Nome do Evento -->
                        <h3 class="text-lg font-semibold">{{ $event['name'] ?? 'Evento sem nome' }}</h3>

                        <!-- Data do Evento -->
                        <p class="text-gray-600 mt-2">
                            Data: {{ \Carbon\Carbon::parse($event['start_date'])->format('d/m/Y H:i') ?? 'Sem data' }}
                        </p>

                        <!-- Local do Evento -->
                        @if(isset($event['address']))
                            <p class="text-gray-500">
                                Local: {{ $event['address']['name'] ?? 'Nome do local não informado' }}
                                @if(isset($event['address']['city']) || isset($event['address']['state']))
                                    - {{ $event['address']['city'] ?? '' }} / {{ $event['address']['state'] ?? '' }}
                                @endif
                            </p>
                            <p class="text-gray-500">
                                {{ $event['address']['address'] ?? '' }}
                                {{ $event['address']['neighborhood'] ?? '' }},
                                {{ $event['address']['zip_code'] ?? '' }}
                            </p>
                        @else
                            <p class="text-gray-500">Local não informado</p>
                        @endif

                        <!-- Link para o Evento no Sympla -->
                        @if(isset($event['url']) && $event['url'])
                            <p class="text-center mt-4">
                                <a href="{{ $event['url'] }}" target="_blank" class="text-blue-500 hover:underline">
                                    Acesse o evento no Sympla
                                </a>
                            </p>
                        @else
                            <p class="text-center text-gray-500">Inscrição não disponível</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Nenhum evento disponível no momento.</p>
        @endif
    </div>
</div>
@endsection
