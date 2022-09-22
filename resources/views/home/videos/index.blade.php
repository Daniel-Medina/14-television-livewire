<x-app-layout nombre="Todos los videos">

    <section class="container mt-4 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <!-- Listar los videos sugeridos -->
            @forelse ($videos as $video)    
                <!-- Recorrer los videos -->
                <div class="px-8 pb-2 mt-4 lg:mt-0">
                    <div class="mb-4">
                        <!-- Solicitar la url con inertia -->
                        <a href="{{ route('videos.show', $video) }}">
                            <div class="flex flex-col">
                                <!-- Imagen del video video -->
                                <img src="{{ $video->imagen }}" class="w-full h-48 sm:h-72 md:h-48 lg:h-44 object-cover object-center"
                                    alt="">
                                <!-- Detalles del video -->
                                <div class="flex mt-2">
                                    <div>
                                        <!-- Imagen del autor del video -->
                                        <img src="{{ $video->foto_user }}"
                                            class="w-10 h-10 rounded-full shadow object-fit object-center" alt="">
                                    </div>

                                    <div class="flex flex-col ml-4">
                                        <!-- Nombre del video -->
                                        <h1 class="text-lg font-semibold text-gray-600">{{ $video->nombre }}</h1>
                                        <!-- Nombre del autor -->
                                        <small class="text-gray-400 font-bold mr-2">{{ $video->autor }}</small>
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
                </div>
                @empty 
                    <div class="px-4 mt-2 font-serif">
                        No se encuentran videos contacte a un administrador.
                    </div>
                @endforelse

        </div>
        
    </section>

</x-app-layout>
