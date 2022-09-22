<div class="container mx-auto mt-6">
    <div class="w-full lg:max-w-5xl mx-auto">
        <!-- Buscador -->
        <div class="flex px-4">
            <x-jet-input wire:model="search" name="search" type="text" class="w-full rounded-r-none" placeholder="Buscar Video" />
            <x-jet-button class="rounded-l-none">Buscar</x-jet-button>
        </div>

        <!-- Lista de videos disponibles -->
        <section class="mt-4 bg-white shadow rounded-lg py-4 px-6">
            {{-- Recorrer --}}
            @forelse ($videos as $video)
                <div class="grid grid-cols-1 md:grid-cols-3 pb-6 md:pb-2 pt-4 md:pt-2 border-b-2 hover:bg-gray-100">
                    <!-- Imagen del video -->
                    <div>
                        <a href="{{ route('videos.show', $video) }}">
                            <figure>
                                <img src="{{ $video->imagen }}" class="w-full rounded h-56 sm:h-64 md:h-40 lg:h-52 object-cover object-center" alt="">
                            </figure>
                        </a>
                    </div>
                    <!-- Detalles del video -->
                    <div class="col-span-1 md:col-span-2 px-4">
                        <a href="{{ route('videos.show', $video) }}">
                            <h1 class="font-bold text-gray-600 text-2xl">{{ $video->nombre }}</h1>
                            <!-- Detalles del autor y video -->
                            <div class="flex items-center justify-start">
                                <!-- Imagen del autor -->
                                <img src="{{ $video->foto_user }}" class="w-10 h-10 object-contain object-center rounded-full"
                                    alt="">
                                <!-- Nombre del autor -->
                                <small class="font-bold text-gray-500 ml-4">{{ $video->autor }}</small>
                                <!-- Fecha de subida -->
                                <small class="font-bold text-gray-500 ml-8">{{ $video->fecha }}</small>
                            </div>

                            <p class="mt-4 text-gray-500 font-serif">
                               {{ $video->abstract }}
                            </p>
                        </a>
                    </div>

                </div>

            @empty

                <!-- Si no hay resultados -->
                <h1 class="font-bold text-gray-600 text-center">No se encuentran
                    coincidencias</h1>

            @endforelse

            <div class="mt-4">
                {{ $videos->links() }}
            </div>

        </section>
    </div>
</div>
