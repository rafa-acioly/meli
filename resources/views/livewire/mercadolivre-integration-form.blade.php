<x-jet-action-section>
    <x-slot name="title">
        {{ __('Mercado livre') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Habilitar integração com Mercado livre.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            Você @if($enabled) <strong>já habilitou</strong> @else <strong>ainda não habilitou</strong> @endif a integração.
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                Esta opção habilita a integração com o mercado livre para que possamos
                sincronizar seus produtos e pedidos.
            </p>
        </div>

        <div class="mt-5">
            <a href="{{ $url  }}" class="inline-flex items-center px-4 py-2 bg-yellow-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Habilitar') }}
            </a>
        </div>
    </x-slot>
</x-jet-action-section>
