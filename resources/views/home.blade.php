@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 bg-blue-50">
    <!-- Título -->
    <h1 class="text-4xl font-bold mb-6 text-center text-black">Bem-vindo ao ApolloHub</h1>

    <!-- Sessão de Empresas Incubadas -->
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-6 text-center text-black">Empresas Incubadas</h2>
        @if ($companies->count())
            <!-- Estrutura do Swiper -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($companies as $company)
                        <div class="swiper-slide">
                            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 text-center">
                                <!-- Logo da Empresa -->
                                @if ($company->profile_picture)
                                    <div class="flex justify-center mb-4">
                                        <img src="{{ asset('storage/' . $company->profile_picture) }}" alt="{{ $company->name }}" class="w-24 h-24 rounded-full border-4 border-orange-500">
                                    </div>
                                @else
                                    <div class="flex justify-center mb-4">
                                        <img src="{{ asset('images/default-company.png') }}" alt="Logo Padrão" class="w-24 h-24 rounded-full border-4 border-orange-500">
                                    </div>
                                @endif

                                <!-- Nome da Empresa -->
                                <h2 class="text-lg font-semibold text-black">{{ $company->name }}</h2>

                                <!-- Descrição da Empresa -->
                                <p class="text-gray-600 text-sm mt-2">
                                    {{ $company->description ?? 'Nenhuma descrição disponível.' }}
                                </p>

                                <!-- Website da Empresa -->
                                @if ($company->website)
                                    <p class="text-center mt-4">
                                        <a href="{{ $company->website }}" target="_blank" class="text-blue-700 hover:underline font-medium">Visite o site</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Botões de Navegação -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <!-- Paginação -->
                <div class="swiper-pagination"></div>
            </div>
        @else
            <p class="text-center text-gray-500">Nenhuma empresa incubada disponível no momento.</p>
        @endif
    </div>

    <!-- Sessão de Eventos -->
    <div>
        <h2 class="text-2xl font-semibold mb-6 text-center text-black">Próximos Eventos</h2>
        @if (!empty($events) && count($events) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                        <!-- Nome do Evento -->
                        <h3 class="text-lg font-semibold text-black">{{ $event['name'] ?? 'Evento sem nome' }}</h3>

                        <!-- Data do Evento -->
                        <p class="text-gray-600 mt-2">
                            Data: {{ \Carbon\Carbon::parse($event['start_date'])->format('d/m/Y H:i') ?? 'Sem data' }}
                        </p>

                        <!-- Local do Evento -->
                        @if (isset($event['address']))
                            <p class="text-gray-500">
                                Local: {{ $event['address']['name'] ?? 'Nome do local não informado' }}
                                @if (isset($event['address']['city']) || isset($event['address']['state']))
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
                        @if (isset($event['url']) && $event['url'])
                            <p class="text-center mt-4">
                                <a href="{{ $event['url'] }}" target="_blank" class="text-blue-700 hover:underline font-medium">
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

