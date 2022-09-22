@php
$inputStyle = 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-2';
$labelStyle = 'block font-medium text-sm text-gray-700';
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <!-- Detalles de la lista -->
    <div class="h-auto rounded relative">
        <div class="flex flex-col bg-white p-4 rounded-lg shadow">
            <img src="{{ $lista->imagen }}" id="picture" class="w-full" alt="">

            <!-- Nombre de la lista -->
            <div class="mt-2">
                {!! Form::label('nombre', 'Nombre de la lista', ['class' => $labelStyle]) !!}

                {!! Form::text('nombre', null, ['class' => $inputStyle, 'placeholder' => 'Ingrese el nombre de la lista']) !!}

                @error('nombre')
                    <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
                @enderror
            </div>
            <!-- Descripcion de la lista -->
            <div class="mt-2">
                {!! Form::label('descripcion', 'Descripción de la lista', ['class' => $labelStyle]) !!}

                {!! Form::text('descripcion', null, [
                    'class' => $inputStyle,
                    'placeholder' => 'Ingrese la descripción de la lista',
                ]) !!}

                @error('descripcion')
                    <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
                @enderror
            </div>

            <!-- Marcar como disponible -->
            <!-- Asignar como lista a presentar -->
            <div class="mt-4 mb-2 flex items-center justify-between">
                {!! Form::label('disponible', 'Mostrar la lista', ['class' => $labelStyle]) !!}

                {!! Form::checkbox('disponible', 'si', $lista->disponible == 'si' ? true : false) !!}

            </div>
            @error('disponible')
                <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
            @enderror

            <!-- Asignar como lista a presentar -->
            <div class="mb-4 flex items-center justify-between">
                {!! Form::label('portada', 'Establecer como principal', ['class' => $labelStyle]) !!}
                {!! Form::checkbox('portada', 'si', $lista->portada == 'si' ? true : false) !!}
            </div>
            @error('portada')
                <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
            @enderror

            <!-- Imagen -->
            <div class="mt-2">
                {!! Form::label('imagen', 'Imagen de la lista', ['class' => $labelStyle]) !!}

                {!! Form::file('imagen', ['class' => $inputStyle, 'accept' => 'image/*', 'id' => 'file']) !!}

                @error('imagen')
                    <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
                @enderror

            </div>



            <div class="flex justify-between">
                <button onclick="eliminar()" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition mt-6" type="button" >Eliminar</button>
                <x-jet-button type="submit" class="mt-6">Actualizar</x-jet-button>
            </div>

        </div>
    </div>


    <!-- Videos contenidos -->
    <div class="col-span-1 xl:col-span-2 grid grid-cols-1 xl:grid-cols-3 gap-0 xl:gap-4">
        {{-- Recorrer --}}
        @forelse ($lista->videos as $video)
            
            <div class="relative w-full mb-6 pl-2">
                <img src="{{ $video->imagen }}" class="w-full lg:h-64 xl:h-44 object-cover object-center" alt="">
                <div>
                    <h2 class="text-left px-2 mt-2 font-bold text-gray-400 text-xl">{{ $video->nombre }}</h2>
                </div>
                {!! Form::checkbox('videos[]', $video->id, true, ['class' => 'absolute right-0 top-0 w-8 h-8']) !!}
            </div>

        @empty
            <h1 class="col-span-1 xl:col-span-3 text-center text-gray-600 font-semibold text-xl">La lista no contiene videos</h1>
        @endforelse
    </div>

    <script src="{{ asset('js/form-img.js') }}"></script>
</div>
