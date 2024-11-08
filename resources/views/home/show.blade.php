<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $news->title }}
            </h2>
            <p class="text-gray-500 text-sm">
                {{ $news->created_at->format('F d, Y') }}
            </p>
            <a href="{{ route('home.index', ['category_id' => $news->category->id]) }}" class="badge badge-ghost">{{ $news->category->name }}</a>
            <a href="{{ route('home.index') }}" class="text-blue-500 hover:underline">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="mt-4 text-gray-800">{{ $news->content }}</p> <!-- Conteúdo completo da notícia -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
