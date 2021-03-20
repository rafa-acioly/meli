<x-jet-action-section>
    <x-slot name="title">
        {{ __('Mercado livre') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Enable mercado livres\'s integration.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            {{ __('You have not enabled mercado livres integration') }}
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('lorem') }}
            </p>
        </div>

        <div class="mt-5">
            <a href="{{ $url  }}" class="inline-flex items-center px-4 py-2 bg-yellow-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Habilitar') }}
            </a>
        </div>
    </x-slot>
</x-jet-action-section>
