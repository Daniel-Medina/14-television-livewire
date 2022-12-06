<x-app-layout nombre="{{ $video->nombre }}">

    <section class="mt-4 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <!-- Detalles del video  -->
            <div class="md:col-span-2 lg:col-span-3 xl:col-span-2 pb-6 px-0 md:px-4">
                <!-- Iframe del video / Usando vue se inyecta el html -->
                <div class="video-responsivo">
                    {!! $video->iframe !!}
                </div>

                <!-- Detalles del video actual -->
                <div class="px-4 mt-4">
                    <h1 class="font-semibold text-2xl text-gray-600">{{ $video->nombre }}</h1>

                    <!-- Detalles del video -->
                    <div class="flex items-center">
                        <div class="mr-4">
                            <!-- Imagen del usuario -->
                            <img src="{{ $video->foto_user }}"
                                class="w-10 h-10 rounded-full shadow object-contain object-center" alt="">
                        </div>

                        <!-- Nombre del autor -->
                        <small class="text-gray-400 font-bold mr-2">
                            {{ $video->autor }}</small>
                        <!-- Fecha del video -->
                        <small class="text-gray-400 font-bold">-
                            {{ $video->fecha }}</small>

                    </div>

                    <p class="text-gray-600 text-justify mt-6">
                        <!-- Descripcion del video  -->
                        {{ $video->descripcion }}
                    </p>

                </div>


                <!-- Comentarios del video -->
                @if ($comentarios)
                    @livewire('videos.show', ['video' => $video])
                @endif

            </div>

            <div
                class="h-full items-start col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-1">
                <!-- Listar los videos sugeridos -->
                @forelse ($similares as $similar)
                    
                    <div class="px-8 pb-2 mt-12 lg:mt-0 w-full container mx-auto">
                        <!-- Recorrer los videos similares -->
                        <div class="mb-4 w-full">
                            <!-- Solicitar la url con inertia -->
                            <a href="{{ route('listas.details', [$lista, $similar]) }}">
                            <div class="flex flex-col">
                                <!-- Imagen del video similar -->
                                <img src="{{ $similar->imagen }}" class="w-full h-full lg:h-44 object-cover object-center"
                                    alt="">
                                <!-- Detalles del video -->
                                <div class="flex mt-2">
                                    <div>
                                        <!-- Imagen del autor del video -->
                                        <img src="{{ $similar->foto_user }}"
                                            class="w-10 h-10 rounded-full shadow object-contain object-center"
                                            alt="">
                                    </div>

                                    <div class="flex flex-col ml-4">
                                        <!-- Nombre del video -->
                                        <h1 class="text-lg font-semibold text-gray-600">{{ $similar->nombre }}</h1>
                                        <!-- Nombre del autor -->
                                        <small class="text-gray-400 font-bold mr-2">{{ $similar->autor }}</small>
                                        <div>
                                            <!-- Fecha del video -->
                                            <small class="text-gray-400 font-bold">
                                               {{ $similar->fecha }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>

                @empty
                    
                @endforelse

            </div>

        </div>
    </section>

</x-app-layout>
