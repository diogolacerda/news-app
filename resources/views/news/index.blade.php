{{-- resources/views/news/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notícias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('news.create') }}" class="text-black bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                        Criar Notícia
                    </a>
                    {{-- Formulário de Busca --}}
                    <form action="{{ route('news.index') }}" method="GET" class="mt-4">
                        <input type="text" name="search" placeholder="Buscar notícias..." value="{{ request('search') }}"
                               class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                            <select name="category_id" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Todas as Categorias</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $categoryId ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Buscar
                        </button>
                    </form>

                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr class="text-left bg-gray-100">
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Título</th>
                                <th class="px-4 py-2">Categoria</th>
                                <th class="px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->id }}</td>
                                    <td class="border px-4 py-2">{{ $item->title }}</td>
                                    <td class="border px-4 py-2">{{ $item->category->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('news.edit', $item) }}" class="text-blue-600 hover:underline">Editar</a>
                                        <form action="{{ route('news.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="text-red-600 hover:underline ml-2">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Paginação --}}
                    <div class="mt-4">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
