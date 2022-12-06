<x-jet-dialog-modal wire:model="modal">

    <x-slot name="title">
        <h1 class="text-gray-600 font-bold text-2xl">Advertencia</h1>
    </x-slot>

    <x-slot name="content">
        <p>
            Estás opciones son solo para desarrollador el uso de ellas puede afectar
            al comportamiento de la aplicación. Si no esta seguro de lo que hace mejor
            regresa a otra ventana.

            Si esta de acuerdo con el riesgo puede continuar de lo contrario regrese a otra pagina.
        </p>
    </x-slot>

    <x-slot name="footer">
        <x-jet-button class="mx-4" wire:click="$set('modal', false)">Aceptar</x-jet-button>
        <x-jet-danger-button>
            <a href="{{ route('admin.dashboard') }}">Regresar</a>
        </x-jet-danger-button>
    </x-slot>

</x-jet-dialog-modal>
