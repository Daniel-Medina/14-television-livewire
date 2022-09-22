<x-admin-layout nombre="Agregar nuevo video">

    <!-- Encabezado que permite ver el primer video de la lista -->
    <section class="mt-4 container mx-auto pb-8">
        <!-- Titulo de seccion -->
        <h1 class="font-bold text-gray-500 text-2xl">Detalles del video</h1>

        <!-- Tarjeta donde se muestran los detalles -->

        {{-- <form action="{{ route('admin.videos.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        </form> --}}

        {!! Form::open(['route' => 'admin.videos.store', 'method' => 'post', 'autocomplete' => 'off', 'files' => true]) !!}
            @csrf
            @include('admin.videos.form')
        {!! Form::close() !!}

    </section>

</x-admin-layout>
