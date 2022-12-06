@php
$inputStyle = 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full';
$labelStyle = 'block font-medium text-sm text-gray-700';
@endphp

<div class="bg-white w-full mt-4 rounded-lg shadow-lg py-4 px-6">
    <div>
        <div>
            {!! Form::label('nombre', 'Titulo del video', ['class' => $labelStyle]) !!}
            <!-- Titulo del video -->
            {!! Form::text('nombre', null, ['class' => $inputStyle, 'placeholder' => 'Ingrese el nombre de la categoria']) !!}
            @error('nombre')
                <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
            @enderror
        </div>

        <!-- Descripcion -->
        <div class="mt-4">
            {!! Form::label('descripcion', 'Descripción video', ['class' => $labelStyle]) !!}
            <!-- Titulo del video -->
            {!! Form::textarea('descripcion', null, [
                'class' => $inputStyle,
                'placeholder' => 'Ingrese la descripción del video',
            ]) !!}

            @error('descripcion')
                <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
            @enderror
        </div>

        <!-- Iframe y la categoria -->
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="mt-2">
                {!! Form::label('url', 'Enlace del video', ['class' => $labelStyle]) !!}

                <!-- Titulo de la tarjeta -->
                {!! Form::text('url', null, ['class' => $inputStyle, 'placeholder' => 'Ingrese la dirección del video']) !!}

                @error('url')
                    <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-2">
                {!! Form::label('plataforma_id', 'Plataforma del video', ['class' => $labelStyle]) !!}

                <!-- Titulo de la tarjeta -->
                {!! Form::select('plataforma_id', $plataformas, null, ['class' => $inputStyle]) !!}


                @error('plataforma')
                    <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
                @enderror

            </div>
        </div>

        <!-- Visibilidad y Asignacion de la lista -->
        <div class="mt-6 grid grid-cols-2 gap-6">
            <div class="">
                {!! Form::label('principal', 'Colocar como portada', ['class' => $labelStyle]) !!}

                {!! Form::select('principal', ['no' => 'No establecer principal', 'si' => 'Marcar como portada'], null, [
                    'class' => $inputStyle,
                ]) !!}

                @error('principal')
                    <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
                @enderror

            </div>

            <div class="">
                {!! Form::label('disponible', 'Marcar como visible', ['class' => $labelStyle]) !!}
                {!! Form::select('disponible', ['si' => 'Mostrar video', 'no' => 'Mantener oculto'], null, [
                    'class' => $inputStyle,
                ]) !!}

                @error('disponible')
                    <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Seleccionar las listas a utiizar -->
        <div class="mt-6">
            {!! Form::label('listas', 'Listas de reproducción', ['class' => $labelStyle]) !!}


            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">

                {{-- Recorrer las listas --}}
                @forelse ($listas as $lista)
                    <div class="flex gap-2 mt-2 items-center py-2">
                        {!! Form::checkbox('listas[]', $lista->id, null, ['class' => 'rounded-md border-gray-300']) !!}

                        <x-jet-label class="font-bold"> {{ $lista->nombre }} </x-jet-label>

                    </div>
                @empty
                    <span class="col-span-1 md:col-span-2 xl:col-span-3 text-gray-600 text-sm font-bold py-4">No se
                        encuentran listas disponibles</span>
                @endforelse

            </div>

            @error('listas')
                <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
            @enderror
        </div>

        <!-- Imagen -->
        <div class="grid grid-cols-5 mt-6 items-center">
            <div class="col-span-5 md:col-span-1">
                @isset($video)
                    <img src="{{ $video->imagen }}" id="picture" class="w-full" alt="">
                @else
                    <img src="{{ Storage::url('no-img.jpg') }}" id="picture" class="w-full" alt="">
                @endisset
            </div>
            <div class="col-span-5 md:col-span-4 px-0 mt-4 md:mt-0 md:px-6">
                {!! Form::file('imagen', [
                    'class' => 'w-full border border-gray-300 px-4 py-2',
                    'accept' => 'image/*',
                    'id' => 'file',
                ]) !!}

                @error('imagen')
                    <span class="text-red-600 font-bold mt-2">{{ $message }}</span>
                @enderror

            </div>
        </div>

        <x-jet-button type="submit" class="mt-6">
            Guadar cambios
        </x-jet-button>

        @if (Route::is('admin.videos.edit'))
            {{-- Funcion Elimnar el video que se encuentra actualmente --}}
            <button type="button" onclick="eliminar()" class="py-1 px-4 font-bold text-white bg-red-600 rounded">
                Eliminar
            </button>
        @endif

    </div>

    <script src="{{ asset('js/form-img.js') }}"></script>

</div>
