@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-black text-center">Editar Detalhes da Mentoria</h1>

    <form action="{{ route('mentorship.update.details', $mentorship->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-medium mb-2">Conteúdo</label>
            <textarea name="content" id="content" rows="4" 
                class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('content', $mentorship->detail->content ?? '') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="mentoring_date" class="block text-gray-700 font-medium mb-2">Data da Mentoria</label>
            <input type="date" name="mentoring_date" id="mentoring_date" value="{{ old('mentoring_date', $mentorship->detail->mentoring_date ?? '') }}" 
                class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('mentoring_date')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="meeting_link" class="block text-gray-700 font-medium mb-2">Link da Reunião</label>
            <input type="url" name="meeting_link" id="meeting_link" value="{{ old('meeting_link', $mentorship->detail->meeting_link ?? '') }}" 
                class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('meeting_link')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md shadow hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
@endsection
