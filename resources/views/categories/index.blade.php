
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">

                    <div class="flex items-center justify-between">
                        <a href="{{ route('categories.create') }}" class="btn btn-sm">
                            Nova Categoria
                        </a>
                        {{-- Formulário de Busca  --}}
                        <form action="{{ route('categories.index') }}" method="GET" class="mt-4">
                            <input type="text" name="search" placeholder="Buscar categorias..."
                                value="{{ $search }}"
                                class="input input-bordered input-sm w-24 md:w-auto">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                Buscar
                            </button>
                        </form>
                    </div>

                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr class="text-left bg-gray-100">
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nome</th>
                                <th class="px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="border px-4 py-2">{{ $category->id }}</td>
                                    <td class="border px-4 py-2">{{ $category->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-xs ">Editar</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza?')" class="btn btn-xs btn-error">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Paginação --}}
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
