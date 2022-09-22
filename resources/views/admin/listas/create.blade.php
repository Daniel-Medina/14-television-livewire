<x-admin-layout nombre="Nueva Lista de reproduccion">

    <!-- Encabezado que permite ver el primer video de la lista -->
    <section class="container mx-auto py-4">

        <h1 class="my-2 text-gray-600 font-bold px-6 text-2xl text-center">Nueva lista de reproducción</h1>

        {!! Form::open(['route' => 'admin.listas.store', 'files' => true, 'autocomplete' => 'off', 'method' => 'post']) !!}
            @include('admin.listas.form-create')
        {!! Form::close() !!}


    </section>

</x-admin-layout>