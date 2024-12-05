@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-orange-500 text-center">Detalhes da Mentoria</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mentorship.details.update', $mentorship->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <!-- Conteúdo Trabalhado -->
        <div class="mb-4">
            <label for="content" class="block text-blue-700 font-medium">Conteúdo Trabalhado</label>
            <textarea name="content" id="content" rows="4"
                class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">{{ old('content', $mentorship->detail->content ?? '') }}</textarea>
        </div>

        <!-- Data da Mentoria -->
        <div class="mb-4">
            <label for="mentoring_date" class="block text-blue-700 font-medium">Data da Mentoria</label>
            <input type="date" name="mentoring_date" id="mentoring_date" 
                value="{{ old('mentoring_date', $mentorship->detail->mentoring_date ?? '') }}"
                class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
        </div>

        <!-- Link de Reunião -->
        <div class="mb-4">
            <label for="meeting_link" class="block text-blue-700 font-medium">Link de Reunião</label>
            <input type="url" name="meeting_link" id="meeting_link" 
                value="{{ old('meeting_link', $mentorship->detail->meeting_link ?? '') }}"
                placeholder="https://teams.microsoft.com ou https://meet.google.com"
                class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
        </div>

        <!-- Botão Salvar -->
        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-700 text-white px-6 py-3 rounded-md shadow hover:bg-blue-800 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Salvar Detalhes
            </button>
        </div>
    </form>
</div>
@endsection
