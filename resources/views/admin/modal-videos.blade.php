<x-jet-dialog-modal wire:model="modal">
    <x-slot name="title">
        <span class="text-gray-400 text-2xl float-right font-bold cursor-pointer"
            wire:click.prevent="resetUI()">X</span>
        <h1>{{ $seccion }} | {{ $accion }} </h1>
    </x-slot>

    <x-slot name="content">
        <section>
            <div>
                <x-jet-label class="mb-2">Titulo del video</x-jet-label>
                <!-- Titulo de la tarjeta -->
                <x-jet-input wire:model.lazy="nombre" type="text" placeholder="Ingrese el nombre de la categoria"
                    class="w-full" />

            </div>

            <!-- Descripcion -->
            <div class="mt-4">
                <x-jet-label class="mb-2">Descripción</x-jet-label>
                <!-- Titulo de la tarjeta -->
                <textarea rows="4" wire:model.lazy="descripcion" placeholder="Ingrese la descrición del video"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                </textarea>
            </div>

            <!-- Iframe y la categoria -->
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="mt-2">
                    <x-jet-label class="mb-2">Enlace del video</x-jet-label>
                    <!-- Titulo de la tarjeta -->
                    <x-jet-input type="text" wire:model.lazy="url" placeholder="Ingrese el enlace del video"
                        class="w-full" />

                </div>
                <div class="mt-2">
                    <x-jet-label class="mb-2">Plataforma del video</x-jet-label>
                    <!-- Titulo de la tarjeta -->
                    <select wire:model="plataforma_id"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                        <option value="-1">Seleccione la plataforma</option>

                        @foreach ($plataformas as $plataforma)
                            <option value="{{ $plataforma->id }}">{{ $plataforma->nombre }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <!-- Visibilidad y Asignacion de la lista -->
            <div class="mt-6 grid grid-cols-2 gap-6">
                <div class="">
                    <x-jet-label class="mr-4">Colocar como portada</x-jet-label>

                    <select wire:model="portada"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                        <option value="si">Establecer Inicio</option>
                        <option value="no">No establecer</option>
                    </select>
                </div>
                <div class="">
                    <x-jet-label class="mr-4">Marcar como visible</x-jet-label>
                    <select wire:model="disponible"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                        <option value="si">Mostrar video</option>
                        <option value="no">Mantener oculto</option>
                    </select>
                </div>
            </div>

            <!-- Seleccionar las listas a utiizar -->
            <div class="mt-6">
                <x-jet-label>Listas de reproducción</x-jet-label>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($listas as $lista)
                        <div class="flex gap-2 mt-2 items-center py-2">
                            <input type="checkbox" wire:model="listasID[]"
                                class="rounded-md border-gray-300">
                            <x-jet-label class="font-bold">{{ $lista->nombre }}</x-jet-label>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- Imagen -->
            <div class="">
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <x-jet-input wire:model="imagen" type="file" class="w-full border border-gray-300 px-4 py-2"
                        accept="image/*" />

                    <!-- Indicador de carga -->
                    <div x-show="isUploading" class="flex items-center">
                        <progress max="100" x-bind:value="progress" class="w-full mt-4 text-blue-500 bg-blue-500"></progress>
                        <span class="text-gray-400 font-bold text-sm ml-2" x-text="progress">%</span>
                        <span class="text-gray-400 font-bold text-sm"> %</span>
                    </div>

                </div>
            </div>

            <x-jet-button type="submit" class="mt-6">Guadar cambios
            </x-jet-button>

        </section>
    </x-slot>

    <x-slot name="footer">
    </x-slot>

</x-jet-dialog-modal>
