<div class="container mx-auto pb-4">
    {{-- Advertencia inicial --}}
    @include('livewire.admin.pruebas.modal')

    {{-- Agregar el slug a los videos --}}
    <div class="bg-white rounded-lg shadow-lg mt-6">
        <div class="bg-gray-300 px-6 py-4 flex justify-between">
            <h4 class="text-xl text-gray-600 font-bold">Urls Amigables</h4>
            <span><i>></i></span>
        </div>
        <div class="py-6 px-4">
            <p>
                Permite crear una url más facil de recordar a los usuarios usando el nombre
                del video y de las listas. Por ejemplo si el video se llama <strong>Municipios de Yucatán</strong>
                el usuario puede escribir <strong>municipios-de-yucatan</strong> en la barra
                de direcciones.
            </p>

            @if ($config->urls_amigables == true)
                <x-jet-button class="mt-6 " class="mt-6" wire:click="generarSlug({{0}})" wire:loading.remove wire:target="generarSlug">Desactivar</x-jet-button>
                <x-jet-button class="mt-6 " class="mt-6" wire:loading wire:target="generarSlug">Procesando...</x-jet-button>
                
            @else
                <x-jet-danger-button class="mt-6" wire:click="generarSlug({{1}})" wire:loading.remove wire:target="generarSlug">Activar y crear</x-jet-danger-button>
                <x-jet-button class="mt-6" wire:loading wire:target="generarSlug">Procesando...</x-jet-button>
            @endif
        </div>
    </div>

    {{-- Permitir comentarios --}}
    <div class="bg-white rounded-lg shadow-lg mt-6">
        <div class="bg-gray-300 px-6 py-4 flex justify-between">
            <h4 class="text-xl text-gray-600 font-bold">Permitir Comentarios en videos</h4>
            <span><i>></i></span>
        </div>
        <div class="py-6 px-4">
            <p>
                Permite a los usuarios que tengan una cuenta dejar un comentario en un video que esten viendo.
            </p>

            @if ($config->comentarios)
                <x-jet-button class="mt-6" wire:loading.remove wire:click="permitirComentarios({{0}})">Desactivar</x-jet-button>
            @else
                <x-jet-danger-button class="mt-6" wire:loading.remove wire:click="permitirComentarios({{1}})">Activar</x-jet-danger-button>
            @endif

            <x-jet-button class="mt-6" wire:loading wire:taget="permitirComentarios">Cargando...</x-jet-button>
        </div>
    </div>

    {{-- Buscar por etiquetas --}}
    {{-- <div class="bg-white rounded-lg shadow-lg mt-6">
        <div class="bg-gray-300 px-6 py-4 flex justify-between">
            <h4 class="text-xl text-gray-600 font-bold">Permitir el uso de etiquetas</h4>
            <span><i>></i></span>
        </div>
        <div class="py-6 px-4">
            <p>
                Permitir a las videos y las listas usar etiquetas para la clasificación de los videos
                asi como para las busquedas. Las etiquetas permiten a los usuarios localizar videos relacionados
                sin usar listas de reproducción.
                <strong>Esto solo funciona si los video cuentan con etiquetas iguales.</strong>
            </p>

            <x-jet-danger-button class="mt-6">Crear</x-jet-danger-button>
        </div>
    </div> --}}

    {{-- Listas optimas --}}
    {{-- <div class="bg-white rounded-lg shadow-lg mt-6">
        <div class="bg-gray-300 px-6 py-4 flex justify-between">
            <h4 class="text-xl text-gray-600 font-bold">Permitir administración avanzada de las listas</h4>
            <span><i>></i></span>
        </div>
        <div class="py-6 px-4">
            <p>
                Activar la administración de videos que tengan las listas de una manera más sencilla, pudiendo agregar y
                quitar videos desde la propia lista en lugar de hacerlo pr video. Lo que facilita la administración de
                las mismas.
            </p>

            <x-jet-button disabled class="mt-6">Desactivar</x-jet-button>
        </div>
    </div> --}}

    {{-- Activar canal --}}
    <div class="bg-white rounded-lg shadow-lg mt-6">
        <div class="bg-gray-300 px-6 py-4 flex justify-between">
            <h4 class="text-xl text-gray-600 font-bold">Permitir a los usuarios ver el perfil del la aplicación</h4>
            <span><i>></i></span>
        </div>
        <div class="py-6 px-4">
            <p>
                Permite generar un perfil con la imagen y nombre del administrador para presentar el contenido al
                espectador de una manera más grafica.
            </p>

            <x-jet-danger-button class="mt-6">Crear</x-jet-danger-button>
        </div>
    </div>

    {{-- Activar canal --}}
    <div class="bg-white rounded-lg shadow-lg mt-6">
        <div class="bg-gray-300 px-6 py-4 flex justify-between">
            <h4 class="text-xl text-gray-600 font-bold">Opciones de desarrollador</h4>
            <span><i>></i></span>
        </div>
        <div class="py-6 px-4">
            <p>
                Ocultar las opciones de desarrollador del panel administrativo.
            </p>

            <x-jet-danger-button class="mt-6">Ocultar</x-jet-danger-button>
        </div>
    </div>

</div>
