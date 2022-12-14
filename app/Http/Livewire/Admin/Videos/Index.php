<?php

namespace App\Http\Livewire\Admin\Videos;

use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $buscar, $visibilidad, $orderBy, $orderType;

    public function mount()
    {
        $this->buscar = '';
        $this->visibilidad = 'none';
        $this->orderBy = 'nombre';
        $this->orderType = 'desc';
    }


    public function render()
    {
        if ($this->buscar == '' && $this->visibilidad == 'none' ) {
            $videos = Video::orderBy($this->orderBy, $this->orderType)
                    //Recuperar los videos del usuario que concuerden con el canal propio
                    ->where('canal_id', Auth::user()->canal->id)
                    ->get() ?? [];
        } else {
            if ($this->visibilidad != 'none') {
                $videos = Video::orderBy($this->orderBy, $this->orderType)
                    ->where('canal_id', Auth::user()->canal->id)
                    ->where('nombre', 'LIKE', '%' . $this->buscar . '%' )
                    ->where('disponible', $this->visibilidad)
                    ->get();
            } else {
                $videos = Video::orderBy($this->orderBy, $this->orderType)
                    ->where('canal_id', Auth::user()->canal->id)
                    ->where('nombre', 'LIKE', '%' . $this->buscar . '%' )
                    ->get();
            }
        }
        

        return view('livewire.admin.videos.index', \compact('videos'));
    }
}
