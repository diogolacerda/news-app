<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                @foreach ($news as $item)
                <x-card :title="$item->title" :category="$item->category->name" >
                        <p>{{ Str::limit($item->content, 100) }}</p>

                        <x-slot name="footer">
                            <a href="{{ route('home.show', $item) }}" class="text-blue-500 hover:underline">Acessar</a>
                        </x-slot>
                    </x-card>
                @endforeach
            </div>
        </div>
        {{-- Paginação --}}
        <div class="mt-4">
            {{ $news->links() }}
        </div>
    </div>
</x-app-layout>
