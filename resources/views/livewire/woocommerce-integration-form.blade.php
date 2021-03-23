<x-jet-form-section submit="save">
    <x-slot name="title">{{ __('Woocommerce') }}</x-slot>

    <x-slot name="description">Habilitar integração com Woocommerce.</x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="store_url" value="{{ __('Link da loja') }}" />
            <x-jet-input id="store_url" type="text" class="mt-1 block w-full" wire:model="store_url" required />
            <x-jet-input-error for="store_url" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Salvo com sucesso.') }}
        </x-jet-action-message>

        <x-jet-action-message class="mr-3" on="error">
            {{ __('Dados inválidos.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Habilitar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
