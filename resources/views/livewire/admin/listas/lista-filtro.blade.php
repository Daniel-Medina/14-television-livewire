<div class="grid grid-cols-1 xl:grid-cols-3 gap-0 xl:gap-4">
    <div class="flex justify-between col-span-1 xl:col-span-3">
        <h6 class="text-gray-600 font-semibold text-xl">Agregar videos a la lista</h6>
    </div>
    {{-- Recorrer --}}
    @forelse ($videosDisponibles as $video)
        
    <div class="relative w-full mb-6 pl-2">
            <img src="{{ $video->imagen }}" class="w-full lg:h-64 xl:h-44 object-cover object-center" alt="">
            <div>
                <h2 class="text-left px-2 mt-2 font-bold text-gray-400 text-xl">{{ $video->nombre }}</h2>
            </div>
            {!! Form::checkbox('videos[]', $video->id, null, ['class' => 'absolute right-0 top-0 w-8 h-8']) !!}
        </div>

    @empty
    <h1 class="col-span-1 xl:col-span-3 text-center text-gray-600 font-semibold text-xl">La lista no contiene videos</h1>
    @endforelse
</div>