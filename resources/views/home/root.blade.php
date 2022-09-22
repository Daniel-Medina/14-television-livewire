<x-app-layout nombre="Videos recomendados">

    <!-- Encabezado que permite ver el primer video de la lista -->
    @if ($videoPortada)
        <section class="mt-4 container mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 items-center">
                <!-- Miniatura de la imagen -->
                <div class="lg:col-span-2">
                    <a href="{{ route('videos.show', $videoPortada) }}">
                        <img src="{{ $videoPortada->imagen }}" class="w-full object-center object-contain" alt="">
                    </a>
                </div>
                <!-- Detalles del video principal -->
                <div class="mx-4 mt-2 lg:mt-0">
                    <a href="{{ route('videos.show', $videoPortada) }}">
                        <!-- Titulo -->
                        <h1 class="text-3xl md:text-4xl font-semibold text-gray-600">
                            {{ $videoPortada->nombre }}
                        </h1>

                        <!-- Detalles del usuario propietario -->
                        <div class="flex justify-left my-2">
                            <div>
                                <!-- Imagen del autor -->
                                <img src="{{ $videoPortada->foto_user }}"
                                    class="w-10 h-10 rounded-full shadow object-contain object-center" alt="">
                            </div>
                            <div class="flex flex-col ml-4">
                                <!-- Autor del video -->
                                <small class="text-gray-400 font-bold mr-2">{{ $videoPortada->autor }}</small>
                                <!-- fecha del video -->
                                <small class="text-gray-400 font-bold">
                                    {{ $videoPortada->fecha }}</small>
                            </div>
                        </div>

                        <!-- Descripcion -->
                        <p class="text-gray-600 text-justify font-serif mt-2">
                            {{ $videoPortada->abstract }}
                        </p>
                    </a>
                </div>

            </div>
        </section>
    @endif


    <!-- Lista de videos recomendados -->
    <section class="container mx-auto mt-6 pb-12">

        <!-- Titulo de la seccion -->
        <h1 class="font-bold text-gray-600 px-4 text-2xl lg:text-4xl mb-10">
            Videos más populares
        </h1>

        <!-- Ciclar los videos disponibles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 px-4 lg:px-0 gap-6">
            @forelse ($videos as $video)
                <!-- Elemento individual -->
                <div>

                    <a href="{{ route('videos.show', $video) }}">
                        <!--- Miniatura del video --->
                        <img src="{{ $video->imagen }}" class="w-full h-48 sm:h-72 md:h-48 lg:h-44 object-cover object-center" alt="">
                        <!-- Detalles del video -->
                        <div class="flex mt-2 px-4 lg:px-0">
                            <div>
                                <!-- Imagen del autor -->
                                <img src="{{ $video->foto_user }}"
                                    class="w-10 h-10 rounded-full shadow object-contain object-center" alt="">
                            </div>

                            <div class="flex flex-col ml-4">
                                <!-- Titulo del video -->
                                <h1 class="text-lg font-semibold text-gray-600">
                                    {{ $video->nombre }}
                                </h1>
                                <!-- Nombre del autor -->
                                <small class="text-gray-400 font-bold mr-2">
                                    {{ $video->autor }}
                                </small>
                                <div>
                                    <!-- Fecha de publicacion -->
                                    <small class="text-gray-400 font-bold">
                                        {{ $video->fecha }}</small>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>

            @empty
                <h2 class="mt-6 px-4 font-serif">
                    Contenido no encontrado, comuniquese con el propietario.
                </h2>
            @endforelse
        </div>

    </section>

</x-app-layout>
