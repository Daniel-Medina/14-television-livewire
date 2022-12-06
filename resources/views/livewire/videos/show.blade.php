<div class="mt-6">
    
    <h2 class="font-bold text-gray-500 text-2xl">Comentarios</h2>

    @auth
        <!-- Agregar comentario -->
        <div class="bg-white rounded-lg shadow-lg mt-2">
            <div class="px-4 py-2">
                <h6 class="py-2 font-semibold text-gray-500">Nuevo comentario</h6>
                @error('mensaje')
                    <span class="text-red-600 text-sm font-bold">{{ $message }}</span>
                @enderror
                <textarea wire:model="mensaje" rows="2" placeholder="Ingrese su comentario"
                    class="mt-2 w-full focus:border-indigo-300 {{ $errors->has('mensaje') ? 'border-red-600' : 'border-gray-300' }} focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <x-jet-button wire:click.prevent="store" wire:loading.remove class="mt-2">Enviar</x-jet-button>
                <x-jet-button wire:loading wire:target="store" class="mt-2">Enviando...</x-jet-button>
            </div>
        </div>

    @else
        <div class="bg-white rounded-lg shadow-lg mt-2">
            <div class="px-4 py-2">
                <h6 class="py-2 font-semibold text-gray-500">Nuevo comentario</h6>
                <textarea disabled rows="2" placeholder="Acceda para dejar un comentario"
                    class="border-gray-300 w-full focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
            </div>
        </div>
    @endauth
    <!-- Listar comentarios -->
    <div class="mt-4">

        @forelse ($comentarios as $comentario)
            <div class="mb-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-between bg-gray-300 py-2 px-4">
                    {{-- Nombre y fecha --}}
                    <div class="flex justify-start items-center">
                        <img src="{{ $comentario->foto_user }}"
                            class="w-10 h-10 object-contain object-center rounded-full" alt="">
                        <div class="flex flex-col">
                            <span class="text-gray-500 font-semibold ml-4">{{ $comentario->autor }}</span>
                            <span class="text-gray-500 font-semibold ml-4 text-sm">{{ $comentario->fecha }}</span>
                        </div>
                    </div>
                    @auth
                        @if (Auth::user()->id == $comentario->user_id)
                            {{-- Boton de eliminar --}}
                            <span class="font-bold text-gray-600 text-lg cursor-pointer hover:text-gray-800" onclick="eliminar('{{$comentario->id}}')">X</span>
                        @endif
                    @endauth
                </div>
                <div class="py-2 px-4">
                    {{ $comentario->mensaje }}
                </div>
            </div>
        @empty
            <h6 class="text-gray-500 font-semibold text-center">El video no tiene comentarios</h6>
        @endforelse

    </div>


    @push('js')
        <script>
            function eliminar(id) {
                if (confirm('¿Desea eliminar su comentario?')) {
                    livewire.emit('destroy', id);
                    alert('Comentario eliminado');
                }
            }    
        </script> 
    @endpush
</div>
