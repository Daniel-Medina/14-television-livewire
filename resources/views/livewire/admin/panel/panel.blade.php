<div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
    <!-- Grafico con las vistas diarias -->
    <div class="w-full border-2 p-2">
        <h1 class="my-2 font-semibold text-gray-600 text-2xl text-center">Vistas diarias</h1>
        <canvas id="accesos"></canvas>
    </div>

    <!-- Grafico con las vistas recibidas -->
    <div class="w-full border-2 p-2">
        <h1 class="my-2 font-semibold text-gray-600 text-2xl text-center">Vistas totales</h1>
        <canvas id="myChart"></canvas>
    </div>

    <!-- Tabla con los videos mas populares -->
    <div class="w-full border-2 p-2">
        <h1 class="my-2 font-semibold text-gray-600 text-2xl text-center">Videos más populares</h1>

        <div class="w-full">
            <table class="w-full table table-responsive text-left">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="p-2">Nombre</th>
                        <th class="p-2">Vistas</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Recorrer --}}
                    @forelse ($videosMas as $video)
                        <tr class="border-2 hover:bg-gray-300 odd:bg-gray-100 even:bg-gray-200">
                            <td class="p-2">
                                <a href="{{ route('admin.videos.edit', $video) }}">
                                    {{ $video->nombre }}
                                </a>
                            </td>
                            <td class="p-2">{{ $video->vistas }} </td>
                        </tr>

                    @empty

                        <tr class="bg-gray-100 text-center font-bold text-gray-700 border">
                            <td colspan="2" class="p-2">
                                No hay datos disponibles
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Videos menos populares -->
    <div class="w-full border-2 p-2">
        <h1 class="my-2 font-semibold text-gray-600 text-2xl text-center">Videos menos populares</h1>

        <div class="w-full">
            <table class="w-full table table-responsive text-left">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="p-2">Nombre</th>
                        <th class="p-2">Vistas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($videosMenos as $video)
                        <tr class="border-2 hover:bg-gray-300 odd:bg-gray-100 even:bg-gray-200">
                            <td class="p-2">
                                <a href="{{ route('admin.videos.edit', $video) }}">
                                    {{ $video->nombre }}
                                </a>
                            </td>
                            <td class="p-2"> {{ $video->vistas }} </td>
                        </tr>

                    @empty
                        <tr class="bg-gray-100 text-center font-bold text-gray-700 border">
                            <td colspan="2" class="p-2">
                                No hay datos disponibles
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ultimo video -->
    <div class="w-full border-2 p-2">
        <h1 class="my-2 font-semibold text-gray-600 text-2xl text-center">Detalles del último video</h1>

        @if ($last != null)
            <div class="bg-white w-full rounded py-4 px-4 shadow relative">
                <img src="{{ $last->imagen }}" class="w-full" alt="">

                <div class="absolute top-0 left-0 right-0 bottom-0 bg-gray-800 bg-opacity-50">
                    <h2 class="text-center mt-4 font-bold text-white text-2xl">{{ $last->nombre }} </h2>

                    <h3 class="mt-4 font-semibold text-white text-xl text-center">Vistas: {{ $last->vistas }}
                    </h3>

                    <h4 class="mt-4 font-semibold text-white text-md text-center">Publicación:
                        {{ $last->fecha }}
                    </h4>
                </div>
            </div>
        @else
            <div>
                <h2 class="mt-2 font-bold text-md text-center text-gray-600">No hay videos disponibles</h2>
            </div>
        @endif

    </div>


</div>
