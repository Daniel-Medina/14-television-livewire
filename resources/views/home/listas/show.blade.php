<x-app-layout nombre="{{ $lista->nombre }}">

    <!-- Encabezado que permite ver el primer video de la lista -->
    <section class="mt-4 container mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <!-- Imagen de la lista -->
            <div class="col-span-1 md:col-span-3 order-2 md:order-1">
                <img src="{{ $lista->imagen }}" class="w-full h-full lg:h-96 object-cover object-center" alt="">
            </div>

            <!-- Detalles de la lista -->
            <div class="px-4 col-span-1 md:col-span-2 order-1 md:order-2">
                <h1 class="text-4xl text-gray-600 font-semibold"> {{ $lista->nombre }} </h1>

                <p class="text-justify font-serif text-gray-600 mt-6">
                    {{ $lista->descripcion }}
                </p>

            </div>

        </div>

        <!-- Detalles de la lista -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-4 md:mt-6">

            <!-- Recorrer los videos -->
            @forelse ($lista->videos as $video)
                <div class="pb-2 mt-6">
                    <div class="">
                        <!-- Solicitar la url  -->
                        <a href="{{ route('listas.details', [$lista, $video]) }}">
                        <div class="flex flex-col">
                            <!-- Imagen del video video -->
                            <img src="{{ $video->imagen }}" class="w-full h-full lg:h-44 object-cover object-center" alt="">
                            <!-- Detalles del video -->
                            <div class="flex mt-2">
                                <div>
                                    <!-- Imagen del autor del video -->
                                    <img src="{{ $video->foto_user }}"
                                        class="w-10 h-10 rounded-full shadow object-contain object-center" alt="">
                                </div>

                                <div class="flex flex-col ml-4">
                                    <!-- Nombre del video -->
                                    <h1 class="text-lg font-semibold text-gray-600"> {{ $video->nombre }} </h1>
                                    <!-- Nombre del autor -->
                                    <small class="text-gray-400 font-bold mr-2"> {{ $video->autor }} </small>
                                    <div>
                                        <!-- Fecha del video -->
                                        <small class="text-gray-400 font-bold">
                                            {{ $video->fecha }} </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            @empty
                <h1 class="text-2xl font-semibold text-gray-500 col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                    Esta lista no contiene contenido contacte a un administrador.
                </h1>
            @endforelse
        </div>

    </section>

</x-app-layout>
