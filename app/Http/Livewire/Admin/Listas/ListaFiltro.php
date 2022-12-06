<?php

namespace App\Http\Livewire\Admin\Listas;

use App\Models\Video;
use Livewire\Component;

class ListaFiltro extends Component
{
    public $search = '';

    public function render()
    {
        $videosDisponibles = Video::orderBy('id', 'desc')->where('disponible', 'si')->get();
        
        // if ($this->search) {
        //     $videosDisponibles = Video::orderBy('id', 'desc')->where('disponible', 'si')->where('nombre', 'like', '%' . $this->search . '%')->get();
        // } else {
        //     $videosDisponibles = Video::orderBy('id', 'desc')->where('disponible', 'si')->get();
        // }

        return view('livewire.admin.listas.lista-filtro', \compact('videosDisponibles'));
    }
}
