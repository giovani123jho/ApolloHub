@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Perfil de {{ auth()->user()->name }}</h1>
        <p>Email: {{ auth()->user()->email }}</p>
        <!-- Adicione mais informações de perfil aqui -->
    </div>
@endsection
