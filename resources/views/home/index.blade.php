<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-card  >
                        <p>Conteúdo da noticia</p>

                        <x-slot name="footer">
                            <a href="" class="text-blue-500 hover:underline">Acessar</a>
                        </x-slot>
                    </x-card>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
