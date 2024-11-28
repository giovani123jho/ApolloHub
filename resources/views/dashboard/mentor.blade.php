@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Mentorias Solicitadas</h1>

    @if($mentorships->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($mentorships as $mentorship)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <!-- Mensagem principal -->
                    @if($mentorship->status === 'aceita')
                        <p class="text-green-600 font-semibold mb-4">
                            Pronto! Agora é só chamar no WhatsApp para alinhar os detalhes e dar início a sua mentoria.
                        </p>
                    @endif

                    <!-- Informações da Empresa -->
                    <h2 class="text-lg font-semibold">{{ $mentorship->company->name }}</h2>
                    <p class="text-gray-600 text-sm mt-2">
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
                        <span class="text-blue-500">{{ ucfirst($mentorship->status) }}</span>
                    </p>

                    <!-- Ações -->
                    <div class="mt-4">
                        @if($mentorship->status === 'pendente')
                            <form action="{{ route('mentorship.accept', $mentorship->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                    Aceitar
                                </button>
                            </form>
                            <form action="{{ route('mentorship.reject', $mentorship->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                    Recusar
                                </button>
                            </form>
                        @else
                            <p class="text-gray-500">Ação já tomada.</p>
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
