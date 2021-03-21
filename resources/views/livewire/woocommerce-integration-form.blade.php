<x-jet-form-section submit="save">
    <x-slot name="title">
        {{ __('Woocommerce') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Enable woocommerce integration.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="store_url" value="{{ __('Link da loja') }}" />
            <x-jet-input id="store_url" type="text" class="mt-1 block w-full" wire:model="store_url" required />
            <x-jet-input-error for="store_url" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="access_token" value="{{ __('Consumer key') }}" />
            <x-jet-input id="consumer_key" type="text" class="mt-1 block w-full" wire:model="consumer_key" required />
            <x-jet-input-error for="consumer_key" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="consumer_secret" value="{{ __('Consumer secret') }}" />
            <x-jet-input id="consumer_secret" type="text" class="mt-1 block w-full" wire:model="consumer_secret" required />
            <x-jet-input-error for="consumer_secret" class="mt-2" />
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
            {{ __('Salvar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
