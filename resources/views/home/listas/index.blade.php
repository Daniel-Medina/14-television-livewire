<x-app-layout nombre="Listas de reproducción">

    <!-- Encabezado que permite ver el primer video de la lista -->
    <section class="mt-4 container mx-auto">

        {{-- Recorrer las listas --}}
        @forelse ($listas as $lista)
            <div class="mt-4 px-2">

                <a href="{{ route('listas.show', $lista) }}">
                <small class="float-right text-gray-700 hover:text-blue-800 text-base cursor-pointer hidden md:inline">Ver
                    lista</small>
                </a>

                <a href="{{ route('listas.show', $lista) }}">
                <h1 class="text-gray-500 font-bold text-2xl cursor-pointer hover:text-indigo-600">{{ $lista->nombre }}</h1>
                </a>

                <div class="flex flex-nowrap mt-4 w-full overflow-x-scroll no-scroll overflow-y-hidden">
                    {{-- Recorrer los elementos --}}
                    @forelse ($lista->videos as $video)    
                        <div class="ml-4 w-64 h-44 flex flex-shrink-0">
                            <div>
                                <figure>
                                    <a href="{{ route('listas.details', [$lista, $video]) }}">
                                    <img src="{{ $video->imagen }}" class="w-64 h-36 rounded shadow object-cover object-center"
                                        alt="">
                                    </a>
                                </figure>
                                <a href="{{ route('listas.details', [$lista, $video]) }}">
                                <h1 class="font-semibold text-gray-600 mt-2 px-2">{{ $video->nombre }}</h1>
                                </a>
                            </div>
                        </div>
                    @empty
                        <span>No hay videos actualmente.</span>
                    @endforelse
                </div>

            </div>
        @empty    
            <div class="px-4 mt-2 font-serif">
                No se encuentran listas publicadas contacte a un administrador.
            </div>
        @endforelse


    </section>


    @push('css')
        <style>
            .no-scroll {
                overflow-x: auto;
            }

            .no-scroll::-webkit-scrollbar {
                display: none;
            }

            /* Por defecto */
            .no-scroll:hover::-webkit-scrollbar {
                display: none;
                height: 8px;
                width: 2px;
            }

            .no-scroll::-webkit-scrollbar-thumb {
                background-color: #00b1ff;
                border-radius: 100vh;
            }

            /* Pantalla lg */
            @media(min-width: 1024px) {
                .no-scroll:hover::-webkit-scrollbar {
                    display: inline;
                    height: 8px;
                    width: 2px;
                }
            }
        </style>
    @endpush

</x-app-layout>