<x-admin-layout nombre="Actualizar video: {{ $video->nombre }}">

    <!-- Encabezado que permite ver el primer video de la lista -->
    <section class="mt-4 container mx-auto pb-8">
        <!-- Titulo de seccion -->
        <h1 class="font-bold text-gray-500 text-2xl">Detalles del video</h1>

        <!-- Tarjeta donde se muestran los detalles -->
        {!! Form::model($video, [
            'route' => ['admin.videos.update', $video],
            'method' => 'put',
            'autocomplete' => 'off',
            'files' => true,
            'id' => 'detalles',
        ]) !!}
        @csrf
        @include('admin.videos.form')
        {!! Form::close() !!}

    </section>

    @if (Route::is('admin.videos.edit'))
        {{-- Funcion Elimnar el video que se encuentra actualmente --}}
        <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" id="delete">
            @csrf
            @method('delete')
        </form>


        @push('js')
            <script type="text/javascript">
                function eliminar() {
                    if (confirm('¿Desea eliminar el video seleccionada?')) {
                        document.getElementById('delete').submit();
                    }
                }
            </script>
        @endpush
    @endif

</x-admin-layout>
