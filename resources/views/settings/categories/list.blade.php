<div>
    <div class="mx-auto container bg-white dark:bg-gray-800 dark:bg-gray-800 shadow rounded">

        <x-jet-confirmation-modal wire:model="confirmFullSync" id="sync-confirmation">
            <x-slot name="title">
                Sincronização em massa
            </x-slot>
            <x-slot name="content">
                <p>Você tem certeza que deseja sincronizar todas as categorias de uma vez?</p>
                <p>Isso pode levar alguns minutos.</p>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmFullSync')" wire:loading.attr="disabled">
                    Deixa pra lá
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:click="syncAll" wire:loading.attr="disabled">
                    Sincronizar
                </x-jet-button>
            </x-slot>
        </x-jet-confirmation-modal>

        <x-jet-dialog-modal id="edit-category" wire:model="editModal">
            <x-slot name="title">Configurar categoria</x-slot>
            <x-slot name="content">
                <label class="text-gray-700">
                    Categoria
                    <select wire:model="selectedFirstLevel" wire:key="selectedFirstLevel" class="w-full block w-52 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                        <option value="" selected disabled>Selecione a categoria</option>
                        @foreach($categoriesOptions as $category)
                            <option value="{{ $category->getId() }}" wire:key="{{ $category->getId() }}">{{ $category->getName() }}</option>
                        @endforeach
                    </select>
                </label>

                <hr class="my-3">

                @unless(is_null($selectedFirstLevel))
                    <label class="text-gray-700">
                        Sub-categoria de: {{ $selectedFirstLevel }}
                        <select wire:model="selectedSecondLevel" wire:key="selectedSecondLevel" class="w-full block w-52 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                            <option value="" selected disabled>Selecione a categoria</option>
                            @foreach($secondLevelOptions as $first)
                                <option value="{{ $first->getId() }}" wire:key="{{ $first->getId() }}">{{ $first->getName() }}</option>
                            @endforeach
                        </select>
                    </label>
                @endunless

                @unless(is_null($selectedSecondLevel))
                    <label class="text-gray-700">
                        Categoria
                        <select wire:model="selectedThirdLevel" wire:key="selectedThirdLevel" class="w-full block w-52 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                            <option value="" selected disabled>Selecione a categoria</option>
                            @foreach($thirdLevelChosen as $second)
                                <option value="{{ $second->getId() }}" wire:key="{{ $second->getId() }}">{{ $second->getName() }}</option>
                            @endforeach
                        </select>
                    </label>
                @endunless

                <div class="flex justify-center items-center">
                    <div class="h-8 w-8 text-cool-gray-300 space-x-2">
                        <svg class="animate-pulse text-cool-gray-300 text-lg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                        </svg>
                    </div>
                    <span class="font-medium py-5 text-cool-gray-500 text-xl">Aguarde...</span>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button>
                    Deixa pra lá
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>

        <x:notify-messages />

        <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
            <div class="w-full flex flex-col lg:flex-row items-start lg:items-center justify-end">
                <div class="flex items-center lg:border-l lg:border-r border-gray-300 py-3 lg:py-0 lg:px-6">
                    <p class="text-base text-gray-600 dark:text-gray-400" id="page-view">Viewing 1 - 20 of 60</p>
                    <a class="text-gray-600 dark:text-gray-400 ml-2 border-transparent border cursor-pointer rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <polyline points="15 6 9 12 15 18" />
                        </svg>
                    </a>
                    <a class="text-gray-600 dark:text-gray-400 border-transparent border rounded focus:outline-none cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <polyline points="9 6 15 12 9 18" />
                        </svg>
                    </a>
                </div>

                <div class="lg:ml-6 flex items-center">
                    <x-jet-button class="ml-2" wire:click="$toggle('confirmFullSync')" wire:loading.attr="disabled">
                        Sincronizar
                    </x-jet-button>
                    <a href="{{ Auth::user()->credential->store_url }}/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product" target="_blank" class="text-gray-600 dark:text-gray-400 mx-2 p-1.5 border-transparent border bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700 hover:bg-gray-200 cursor-pointer rounded focus:outline-none focus:border-gray-800 focus:shadow-outline-gray" href="javascript: void(0)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon cursor-pointer icon-tabler icon-tabler-settings" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full overflow-x-scroll xl:overflow-x-hidden">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead>
                <tr class="w-full h-16 border-gray-300 border-b py-8">
                    <th class="pl-8 text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">
                        <input type="checkbox" class="cursor-pointer relative w-5 h-5 border rounded border-gray-400 bg-white dark:bg-gray-800 outline-none" onclick="checkAll(this)" />
                    </th>
                    <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Identificador</th>
                    <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Categoria na loja</th>
                    <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Cartegoria no Lercado Livre</th>
                    <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Ultima atualização</th>
                    <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">
                        <div class="opacity-0 w-2 h-2 rounded-full bg-indigo-400"></div>
                    </th>
                    <td class="text-gray-600 dark:text-gray-400 font-normal pr-8 text-left text-sm tracking-normal leading-4"></td>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr class="h-24 border-gray-300 border-b">
                        <td class="pl-8 pr-6 text-left whitespace-no-wrap text-sm text-gray-800 dark:text-gray-100 tracking-normal leading-4">
                            <input type="checkbox" class="cursor-pointer relative w-5 h-5 border rounded border-gray-400 bg-white dark:bg-gray-800 outline-none" />
                        </td>
                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">#{{ $category->id }}</td>
                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">
                            <a class="hover:underline" target="_blank" href="{{ Auth::user()->credential->store_url }}/wp-admin/term.php?taxonomy=product_cat&tag_ID={{ $category->id_on_store }}&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct">
                                {{ $category->name }}
                            </a>
                        </td>
                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4 font-semibold">
                            {{ $category->meli_name ?? 'Não configurado' }}
                        </td>
                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{ $category->updated_at->format('d-m-Y H:m:s') }}</td>
                        <td class="pr-6">
                            <div class="w-2 h-2 rounded-full bg-{{ $category->name ? 'red' : 'green' }}-400"></div>
                        </td>
                        <td class="pr-8 relative">
                            <button class="text-gray-500 rounded cursor-pointer border border-transparent focus:outline-none" wire:click="$toggle('editModal')">
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
                        </td>
                    </tr>
                @empty
                    <tr class="h-24 border-gray-300 border-b">
                        <td colspan="5">
                            <div class="flex justify-center items-center">
                                <div class="h-8 w-8 text-cool-gray-300 space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>
                                <span class="font-medium py-5 text-cool-gray-500 text-xl">Sincronizando dados...</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
