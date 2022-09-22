<x-admin-layout nombre="Editar lista {{ $lista->nombre }}">

    <!-- Encabezado que permite ver la portada del primer video de la lista -->
    <section class="mt-4 container mx-auto">
        {!! Form::model($lista, [ 'route' => ['admin.listas.update', $lista], 'method' => 'put', 'autocomplete' => 'off', 'files' => true, 'id' => 'detalles']) !!}
        @csrf
        @include('admin.listas.form-edit')
        {!! Form::close() !!}

        <form action="{{ route('admin.listas.destroy', $lista) }}" id="delete" method="POST">
            @csrf
            @method('delete')
        </form>

        @push('js')
            <script>
                const form = document.getElementById('delete');

                function eliminar() {
                    if (confirm('¿Desea eliminar esta lista de reproducción?')) {
                        form.submit();
                    }
                }
            </script>
        @endpush

    </section>
</x-admin-layout>