<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3 space-y-3">

                <div class="relative text-gray-600 focus-within:text-gray-400">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </span>
                    <x-jet-input type="search" name="search" wire:model="search"  placeholder="Procurar por nome" class="py-2 pl-10" autocomplete="off"/>
                </div>
                <a href="{{ route('products.add') }}">
                    <x-jet-button>Integrar novo</x-jet-button>
                </a>
            </div>
            <div class="flex flex-col space-y-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Produto
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Produto integrado
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipo de anúncio
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Preço
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ultima atualização
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($products as $product)
                                <tr wire:loading.class="opacity-75">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" loading="lazy" src="#" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a class="hover:underline" href="">{{ $product->name }}</a>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $product->sku }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $product->meli_sku }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                  {{ $product->buying_mode }}
                                                </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        R$ {{ $product->price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->updated_at->format('d-m-Y H:m:s') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="hover:text-green-600 text-gray-500 rounded cursor-pointer border border-transparent focus:outline-none" title="Editar {{ $product->name }}">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="icon cursor-pointer icon-tabler icon-tabler-edit"
                                                width="20" height="20" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                <line x1="16" y1="5" x2="19" y2="8" />
                                            </svg>
                                        </button>

                                        <button class="hover:text-green-600 text-gray-500 rounded cursor-pointer border border-transparent focus:outline-none" title="Sincronizar agora">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="icon cursor-pointer icon-tabler icon-tabler-edit"
                                                fill="none" width="20" height="20" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="flex justify-center items-center">
                                            <div class="h-8 w-8 text-cool-gray-300 m-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </div>
                                            <span class="font-medium py-5 text-cool-gray-500 text-xl">
                                                Nenhum produto encontrado, <a class="hover:underline text-indigo-400" href="{{ route('products.add') }}">integrar novo</a>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-3 space-y-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
