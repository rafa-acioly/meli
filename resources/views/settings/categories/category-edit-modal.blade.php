<x-jet-dialog-modal id="edit-category" wire:model="category">
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
