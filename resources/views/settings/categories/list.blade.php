<div class="mx-auto container bg-white dark:bg-gray-800 dark:bg-gray-800 shadow rounded">
    <div class="flex flex-col lg:flex-row p-4 lg:p-8 justify-between items-start lg:items-stretch w-full">
        <div class="w-full flex flex-col lg:flex-row items-start lg:items-center justify-end">
            <div class="flex items-center lg:border-l lg:border-r border-gray-300 py-3 lg:py-0 lg:px-6">
                <p class="text-base text-gray-600 dark:text-gray-400" id="page-view">Viewing 1 - {{ $categories->count() }} of 60</p>
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

            <x:notify-messages />

            <div class="lg:ml-6 flex items-center">
                <button
                    wire:loading.attr="disabled"
                    wire:click="$toggle('confirmFullSync')"
                    class="bg-gray-200 transition duration-150 ease-in-out focus:outline-none border border-transparent focus:border-gray-800 focus:shadow-outline-gray hover:bg-gray-300 rounded text-indigo-700 px-5 h-8 flex items-center text-sm">
                    {{ __('Sincronizar') }}
                </button>

                <x-jet-confirmation-modal wire:model="confirmFullSync">
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
            </div>
        </div>
    </div>

    <div class="w-full overflow-x-scroll xl:overflow-x-hidden">
        <table class="min-w-full bg-white dark:bg-gray-800">
            <thead>
            <tr class="w-full h-16 border-gray-300 border-b py-8">
                <th class="pl-8 text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">
                    <input type="checkbox" class="cursor-pointer relative w-5 h-5 border rounded border-gray-400 bg-white dark:bg-gray-800 outline-none" />
                </th>
                <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4"></th>
                <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Categoria na loja</th>
                <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Categoria no mercado livre</th>
                <th class="text-gray-600 dark:text-gray-400 font-normal pr-6 text-left text-sm tracking-normal leading-4">Útilma atualização</th>
                <td class="text-gray-600 dark:text-gray-400 font-normal pr-8 text-left text-sm tracking-normal leading-4">Editar</td>
            </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="h-24 border-gray-300 border-b">
                        <td class="pl-8 pr-6 text-left whitespace-no-wrap text-sm text-gray-800 dark:text-gray-100 tracking-normal leading-4">
                            <input type="checkbox" class="cursor-pointer relative w-5 h-5 border rounded border-gray-400 bg-white dark:bg-gray-800 outline-none" />
                        </td>
                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">
                            <div class="flex items-center w-10 text-gray-600 dark:text-gray-400">
                                <div class="h-8 w-8">
                                    <img src="https://ui-avatars.com/api/?name={{ $category->name }}&color=7F9CF5&background=EBF4FF" alt="" class="h-full w-full rounded-full overflow-hidden shadow" />
                                </div>
                            </div>
                        </td>
                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{ $category->name }}</td>
                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{ $category->meli_name }}</td>
                        <td class="text-sm pr-6 whitespace-no-wrap text-gray-800 dark:text-gray-100 tracking-normal leading-4">{{ $category->updated_at->format('d-m-Y H:m:s') }}</td>
                        <td class="pr-8 relative">
                            <div class="dropdown-content mt-8 absolute left-0 -ml-12 shadow-md z-10 hidden w-32">
                                <ul class="bg-white dark:bg-gray-800 shadow rounded py-1">
                                    <li class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-indigo-700 hover:text-white px-3 font-normal">Edit</li>
                                    <li class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-indigo-700 hover:text-white px-3 font-normal">Delete</li>
                                    <li class="cursor-pointer text-gray-600 dark:text-gray-400 text-sm leading-3 tracking-normal py-3 hover:bg-indigo-700 hover:text-white px-3 font-normal">Duplicate</li>
                                </ul>
                            </div>
                            <button class="text-gray-500 rounded cursor-pointer border border-transparent focus:outline-none">
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                            </button>
                        </td>
                    </tr>
                @empty
                    <td class="h-24 border-gray-300 border-b">
                        <td colspan="5" class="pl-8 pr-6 text-left whitespace-no-wrap text-sm text-gray-800 dark:text-gray-100 tracking-normal leading-4">Sincronizando...</td>
                    </td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

