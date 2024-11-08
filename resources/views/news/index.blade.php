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
                    <div class="flex items-center justify-between">
                        <a href="{{ route('news.create') }}" class="btn btn-sm">
                            Criar Notícia
                        </a>
                        {{-- Formulário de Busca --}}
                        <form action="{{ route('news.index') }}" method="GET" class="mt-4">
                            <input type="text" name="search" placeholder="Buscar notícias..." value="{{ request('search') }}"
                            class="input input-bordered input-sm w-24 md:w-auto">

                                <select name="category_id" class="input input-bordered input-sm w-24 md:w-auto text-xs">
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
                    </div>
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
                                    <td class="border px-4 py-2 display-flex">
                                        <a href="{{ route('news.edit', $item) }}" class="btn btn-xs ">Editar</a>
                                        <form action="{{ route('news.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn btn-xs btn-error">Excluir</button>
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
