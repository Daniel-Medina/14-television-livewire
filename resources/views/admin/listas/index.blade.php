<x-admin-layout nombre="Todas las listas de Reproducción">

    <!-- Encabezado que permite ver el primer video de la lista -->
    <section class="mt-4 container mx-auto">

        <a href="{{ route('admin.listas.create') }}" class="float-none md:float-right px-4 md:px-0">
            <x-jet-button>
                Agregar
            </x-jet-button>
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pt-0 md:pt-16 mt-6 md:mt-0">
            <!-- Recorrer la lista -->
            @forelse ($listas as $lista)
                
                <div class="{{ $lista->portada == 'si' ? 'bg-zinc-200 rounded shadow' : '' }} pb-2 relative ">
                    <a href="{{ route('admin.listas.edit', $lista) }}">
                        <!-- Imagen de portada -->
                        <img src="{{ $lista->imagen }}" class="w-full h-64 md:h-36 object-cover object-center" alt="">
                        <!-- Mostrar la cantidad de videos almacenados -->
                        <div class="bg-blue-800 bg-opacity-90 text-white text-sm px-4 py-1 absolute right-0 top-0">
                           {{ $lista->videos_count }}
                        </div>

                        <!-- Detalles de la lista -->
                        <div class="flex mt-2 px-4 lg:px-1">
                            <div>
                                <!-- Imagen del autor del video -->
                                <img src="{{ $lista->foto_user }}"
                                    class="w-10 h-10 rounded-full shadow object-contain object-center" alt="">
                            </div>

                            <div class="flex flex-col ml-4">
                                <!-- Nombre del video -->
                                <h1 class="text-lg font-semibold text-gray-600">{{ $lista->nombre }}</h1>
                                <!-- Disponibilidad del  video -->
                                <small class="{{ $lista->disponible == 'si' ? 'text-green-600' : 'text-red-600' }} font-bold mr-2">{{ $lista->disponible == 'si' ? 'Disponible' : 'Oculto' }}</small>
                                <div>
                                    <!-- Fecha del video -->
                                    <small class="text-gray-400 font-bold">
                                       {{ $lista->fecha }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            @empty
                
                <!-- Si el contenido esta vacio -->
                <h1 class="mt-2 px-4 font-semibold text-gray-600 text-2xl text-center">
                    No hay datos registrados puede crear una nueva lista con el boton crear.
                </h1>

            @endforelse
        </div>


    </section>

</x-admin-layout>