@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Mentorias Aceitas</h1>

    @if($mentorships->isEmpty())
        <p class="text-gray-500">Você ainda não aceitou nenhuma mentoria.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($mentorships as $mentorship)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">Empresa: {{ $mentorship->company->name }}</h3>
                    
                    <!-- Verificação e exibição do número de WhatsApp -->
                    @if($mentorship->company->whatsapp_number)
                        <p>
                            <strong>WhatsApp:</strong> 
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $mentorship->company->whatsapp_number) }}" 
                               target="_blank" 
                               class="text-blue-500 hover:underline">
                                {{ $mentorship->company->whatsapp_number }}
                            </a>
                        </p>
                    @else
                        <p class="text-gray-500"><strong>WhatsApp:</strong> Não informado</p>
                    @endif

                    <!-- Descrição da empresa -->
                    <p><strong>Descrição:</strong> {{ $mentorship->company->description ?? 'Descrição não disponível.' }}</p>
                    
                    <!-- Status da mentoria -->
                    <p class="mt-2">
                        <strong>Status:</strong> <span class="text-green-600">{{ ucfirst($mentorship->status) }}</span>
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
    