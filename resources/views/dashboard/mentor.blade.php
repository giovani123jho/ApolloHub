@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-black text-center">Mentorias Solicitadas</h1>

    @if($mentorships->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($mentorships as $mentorship)
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                    <!-- Mensagem principal -->
                    @if($mentorship->status === 'aceita')
                        <div class="bg-green-100 p-4 rounded-lg mb-4 text-green-700 font-semibold text-sm">
                            Pronto! Agora é só chamar no WhatsApp para alinhar os detalhes e dar início à sua mentoria.
                        </div>
                    @endif

                    <!-- Informações da Empresa -->
                    <h2 class="text-lg font-bold text-black mb-2">{{ $mentorship->company->name }}</h2>
                    <p class="text-gray-600 text-sm">
                        <strong>E-mail:</strong> {{ $mentorship->company->email }}
                    </p>
                    <p class="text-gray-600 text-sm">
                        <strong>WhatsApp:</strong> 
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $mentorship->company->whatsapp_number) }}" target="_blank" class="text-blue-500 hover:underline">
                            {{ $mentorship->company->whatsapp_number }}
                        </a>
                    </p>

                    <!-- Status da Mentoria -->
                    <p class="text-gray-800 mt-4">
                        <strong>Status:</strong> 
                        <span class="{{ $mentorship->status === 'aceita' ? 'text-green-600' : ($mentorship->status === 'pendente' ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ ucfirst($mentorship->status) }}
                        </span>
                    </p>

                    <!-- Detalhes da Mentoria -->
                    @if($mentorship->detail)
                        <div class="mt-4">
                            <h3 class="text-lg font-bold">Detalhes da Mentoria:</h3>
                            <p class="text-gray-600"><strong>Conteúdo:</strong> {{ $mentorship->detail->content }}</p>
                            <p class="text-gray-600"><strong>Data:</strong> {{ $mentorship->detail->mentoring_date }}</p>
                            <p class="text-gray-600"><strong>Link:</strong> 
                                <a href="{{ $mentorship->detail->meeting_link }}" target="_blank" class="text-blue-500 hover:underline">
                                    Acessar Reunião
                                </a>
                            </p>
                        </div>
                    @else
                        <p class="text-gray-500 mt-4">Detalhes ainda não preenchidos.</p>
                    @endif

                    <!-- Botão para Editar Detalhes -->
                    @if($mentorship->status === 'aceita')
                        <div class="mt-4">
                            <a href="{{ route('mentorship.edit.details', $mentorship->id) }}" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 shadow">
                               Editar Detalhes
                            </a>
                        </div>
                    @endif

                    <!-- Ações -->
                    <div class="mt-6 flex flex-wrap gap-2">
                        @if($mentorship->status === 'pendente')
                            <form action="{{ route('mentorship.accept', $mentorship->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 shadow">
                                    Aceitar
                                </button>
                            </form>
                            <form action="{{ route('mentorship.reject', $mentorship->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 shadow">
                                    Recusar
                                </button>
                            </form>
                        @else
                            <p class="text-gray-500 italic">Ação já tomada.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500">Nenhuma mentoria solicitada no momento.</p>
    @endif
</div>
@endsection
