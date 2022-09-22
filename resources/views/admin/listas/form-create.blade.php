@php
    $inputStyle = 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-2';
    $labelStyle = 'block font-medium text-sm text-gray-700';
@endphp

<div class="max-w-5xl mx-auto mt-2 p-6 bg-white mb-4 shadow rounded-lg">

    <div>
        <!-- Imagen de la lista -->
        <figure class="w-full flex justify-center">
            <img id="picture" src="{{ Storage::url('no-img.jpg') }}" class="w-1/2 rounded border-2 border-gray-400 border-opacity-40" alt="">
        </figure>
    </div>

    <!-- Nombre de la lista -->
    <div class="mt-6">
        
        {!! Form::label('nombre', 'Nombre de la lista', ['class' => $labelStyle]) !!}
        {!! Form::text('nombre', null, ['class' => $inputStyle, 'placeholder' => 'Nombre de la lista']) !!}

        @error('nombre')
            <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
        @enderror
    </div>

    <!-- Descripcion de la lista -->
    <div class="mt-6">

        {!! Form::label('descripcion', 'Descripción de la lista', ['class' => $labelStyle]) !!}
        {!! Form::textarea('descripcion', null, ['class' => $inputStyle, 'placeholder' => 'Descripción de la lista']) !!}

        @error('descripcion')
            <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
        @enderror
    </div>

    <!-- Miniatura de la lista -->
    <div class="mt-6">
        {!! Form::label('imagen', 'Imagen de la lista', ['class' => $labelStyle]) !!}
        {!! Form::file('imagen', ['class' => $inputStyle, 'accept' => 'image/*', 'id' => 'file']) !!}
        
        @error('imagen')
            <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
        @enderror

    </div>

    <x-jet-button class="mt-6">Crear lista</x-jet-button>

    
    <script src="{{ asset('js/form-img.js') }}"></script>

</div>
