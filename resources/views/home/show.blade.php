<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $news->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-sm text-gray-500">{{ $news->category->name }}</p>
                    <p class="mt-4 text-gray-800">{{ $news->content }}</p> <!-- Conteúdo completo da notícia -->
                    <a href="{{ route('home.index') }}" class="inline-block mt-6 text-blue-500 hover:underline">
                        Voltar para as notícias
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
