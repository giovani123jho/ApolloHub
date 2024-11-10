<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard da Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Mentores Registrados') }}</h3>

                    @if($mentors->isEmpty())
                        <p>{{ __('Não há mentores registrados no momento.') }}</p>
                    @else
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left text-gray-700 dark:text-gray-300">{{ __('Nome') }}</th>
                                    <th class="py-2 px-4 border-b text-left text-gray-700 dark:text-gray-300">{{ __('E-mail') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mentors as $mentor)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $mentor->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $mentor->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>