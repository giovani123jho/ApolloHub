<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class SymplaService
{
    protected $apiUrl = 'https://api.sympla.com.br/public/v4/';

    /**
     * Obter eventos futuros do Sympla.
     */
    public function getEvents()
    {
        $response = Http::withHeaders([
            's_token' => env('SYMPLA_API_TOKEN'), // Cabeçalho correto
        ])->withoutVerifying() // Ignorar SSL temporariamente
          ->get($this->apiUrl . 'events');

        // Verificar se a requisição foi bem-sucedida
        if ($response->successful()) {
            $allEvents = $response->json()['data'] ?? [];

            // Filtrar apenas os eventos futuros
            $futureEvents = collect($allEvents)->filter(function ($event) {
                return isset($event['start_date']) &&
                       Carbon::parse($event['start_date'])->isAfter(now());
            });

            return $futureEvents->values()->toArray(); // Retornar apenas os eventos futuros
        }

        // Retornar um array vazio em caso de erro
        return [];
    }

    /**
     * Obter detalhes de um evento específico.
     */
    public function getEventDetails($eventId)
    {
        $response = Http::withHeaders([
            's_token' => env('SYMPLA_API_TOKEN'),
        ])->withoutVerifying() // Ignorar SSL temporariamente
          ->get($this->apiUrl . "events/{$eventId}");

        // Verificar se a requisição foi bem-sucedida
        if ($response->successful()) {
            return $response->json(); // Retornar os detalhes do evento
        }

        // Retornar null em caso de erro
        return null;
    }
}
