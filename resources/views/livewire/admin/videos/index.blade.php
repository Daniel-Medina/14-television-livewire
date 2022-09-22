<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

    <!-- Filtros de la aplicacion -->
    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 bg-white rounded-lg shadow py-4 px-6">
        <div class="grid md:grid-cols-3 md:gap-3 lg:gap-6 items-center">
            <!-- Buscar por input -->
            <div>
                <x-jet-label>Buscar por nombre</x-jet-label>
                <x-jet-input wire:model="buscar" type="text" class="w-full" placeholder="Ingrese su termino de busqueda" />
            </div>
            <!-- Buscar de acuerdo a la disponibilidad -->
            <div>
                <x-jet-label>Visibilidad</x-jet-label>
                <select wire:model="visibilidad"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                    <option value="none" selected>Todo</option>
                    <option value="si">Disponible</option>
                    <option value="no">Oculto</option>
                </select>
            </div>
            <!-- Boton agregar nuevo regiistro -->
            <div class="text-right">
                <a href="{{ route('admin.videos.create') }}">
                    <x-jet-button>
                        Agregar video
                    </x-jet-button>
                </a>
            </div>
        </div>
    </div>

    {{-- Recorrer --}}
    @forelse ($videos as $video)
        <div class="mb-4">
            <a href="{{ route('admin.videos.edit', $video) }}">
                <div class="flex flex-col">
                    <!-- Imagen del video similar -->
                    <img src="{{ $video->imagen }}" class="w-full h-full lg:h-44 object-cover object-center"
                        alt="">
                    <!-- Detalles del video -->
                    <div class="flex mt-2 px-4 lg:px-1">
                        <div>
                            <!-- Imagen del autor del video -->
                            <img src="{{ $video->foto_user }}"
                                class="w-10 h-10 rounded-full shadow object-contain object-center" alt="">
                        </div>

                        <div class="flex flex-col ml-4">
                            <!-- Nombre del video -->
                            <h1 class="text-lg font-semibold text-gray-600">{{ $video->nombre }}</h1>
                            <!-- Disponibilidad del  video -->
                            <small
                                class="font-bold mr-2 {{ $video->disponible == 'si' ? 'text-green-600' : 'text-red-600' }} ">
                                {{ $video->disponible == 'si' ? 'Disponible' : 'No disponible' }}
                            </small>
                            <div>
                                <!-- Fecha del video -->
                                <small class="text-gray-400 font-bold">
                                    {{ $video->fecha }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    @empty

        <!-- Si el contenido esta vacio -->
        <h1
            class="mt-2 px-4 font-semibold text-gray-600 text-2xl text-center col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
            No hay datos registrados puede crear una nueva lista con el boton crear.
        </h1>
    @endforelse

</div>
