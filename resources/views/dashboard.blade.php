<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
                <a href="{{ route('persons.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold">{{ $stats['persons'] }}</div>
                    <div class="text-sm">{{ __('Persone') }}</div>
                </a>
                <a href="{{ route('associations.index') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold">{{ $stats['associations'] }}</div>
                    <div class="text-sm">{{ __('Associazioni') }}</div>
                </a>
                <a href="{{ route('groups.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold">{{ $stats['groups'] }}</div>
                    <div class="text-sm">{{ __('Gruppi') }}</div>
                </a>
                <a href="{{ route('dioceses.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold">{{ $stats['dioceses'] }}</div>
                    <div class="text-sm">{{ __('Diocesi') }}</div>
                </a>
                <a href="{{ route('media.index') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold">{{ $stats['media'] }}</div>
                    <div class="text-sm">{{ __('Media') }}</div>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Benvenuto nella dashboard') }}</h3>
                    <p>{{ __('Da qui puoi gestire tutte le risorse del sistema.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>